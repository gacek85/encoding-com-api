<?php
namespace Gacek85\EncodingCom;

use Gacek85\EncodingCom\Formatter\FormatterInterface;
use Gacek85\EncodingCom\Formatter\XMLFormatter;
use Gacek85\EncodingCom\Request\RequestCallInterface;
use Gacek85\EncodingCom\Request\RequestInterface;
use Gacek85\EncodingCom\Result\ParserInterface as ResultParserInterface;
use Gacek85\EncodingCom\Result\ResultInterface;
use Gacek85\EncodingCom\Validation\Exception as ValidationException;
use JsonSchema\Validator;
use RuntimeException;

/**
 *  Manager class for encoding.com
 *  calls
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class Encoding
{

    const URI = 'http://manage.encoding.com/';

    protected $initialQuery = [
        'query' => [
            'userid' => null,
            'userkey' => null
        ]
    ];
    
    
    /**
     *
     * @var FormatterInterface
     */
    protected $formatter = null;


    /**
     *
     * @var ResultInterface
     */
    protected $result = null;
    

    protected $requestArray = [];
    
    
    /**
     *
     * @var Validator
     */
    protected $validator = null;
    
    
    /**
     *
     * @var RequestCallInterface
     */
    protected $requestCall = null;
    
    
    /**
     *
     * @var ResultParserInterface 
     */
    protected $resultParser = null;
    
    
    public function __construct (
        string $userId, 
        string $userKey, 
        RequestCallInterface $requestCall,
        ResultParserInterface $resultParser
    )
    {
        $this->requestCall = $requestCall;
        $this->resultParser = $resultParser;
        $this->initialQuery['query']['userid'] = $userId;
        $this->initialQuery['query']['userkey'] = $userKey;
        $this->reset();
    }
    
    
    /**
     * Resets the object to free the request schema
     * 
     * @return      Encoding    This instance
     */
    public function reset (): Encoding
    {
        $this->requestArray = $this->initialQuery;
        $this->result = null;
        return $this;
    }
    
    
    /**
     * Makes the request to the Encoding.com
     * 
     * @param       RequestInterface        $request
     * @return      Encoding
     */
    public function request (RequestInterface $request): Encoding
    {
        try {
            $response = $this
                                ->validate($request)
                                ->call($request)             
            ;
            $this->result = $this->resultParser->parse($response);
        } catch (ValidationException $ex) {
            $this->result = $ex->getResult();
        }
        
        return $this;
    }
    
    
    protected function call (RequestInterface $request)
    {
        $this->requestArray['query'] = array_merge(
            $this->requestArray['query'], 
            $request->getData()
        );
        
        return $this
                    ->requestCall
                    ->call(self::URI, $this->requestArray, $this->getFormatter())
        ;
    }
    
    
    /**
     * 
     * @param       RequestInterface        $request
     * @return      Encoding
     */
    protected function validate (RequestInterface $request): Encoding
    {
        $this
            ->getValidator()
            ->check($request->getData(), $request->getJsonSchemaArray())
        ;
        if ($this->validator->isValid()) {
            return $this;
        }
        
        throw new ValidationException($this->validator->getErrors());
    }
    
    
    /**
     * Returns result of given chain of calls
     * 
     * @return      ResultInterface
     */
    public function getResult (): ResultInterface
    {
        if (!$this->result) {
            throw new RuntimeException('No result is present!');
        }
        return $this->result;
    }
    
    
    /**
     * Returns JsonSchema validator
     * 
     * @return      Validator
     */
    protected function getValidator (): Validator
    {
        return $this->validator ?: $this->doGetValidator();
    }
    
    private function doGetValidator (): Validator 
    {
        return $this->validator = new Validator();
    }




    /**
     * Sets custom formatter
     * 
     * @param       FormatterInterface      $formatter
     * @return      Encoding                This instance
     */
    public function setFormatter (FormatterInterface $formatter): Encoding
    {
        $this->formatter = $formatter;
        return $this;
    }
    
    
    /**
     * Provides formatter, if none present, returns default Json formatter
     * 
     * @return      FormatterInterface
     */
    protected function getFormatter (): FormatterInterface 
    {
        return $this->formatter ?: $this->getDefaultFormatter();
    }
    
    
    protected function getDefaultFormatter (): FormatterInterface 
    {
        return new XMLFormatter();
    }
}