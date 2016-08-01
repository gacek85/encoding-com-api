<?php
namespace Gacek85\EncodingCom;

use Gacek85\EncodingCom\Formatter\FormatterInterface;
use Gacek85\EncodingCom\Formatter\JsonFormatter;
use Gacek85\EncodingCom\Request\RequestInterface;
use Gacek85\EncodingCom\Result\ResultInterface;
use Gacek85\EncodingCom\Validation\Exception as ValidationException;
use GuzzleHttp\Client;
use JsonSchema\Validator;
use Psr\Http\Message\ResponseInterface;
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
    
    
    
    protected $resultParser = null;
    
    
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
    
    
    public function __construct (string $userId, string $userKey)
    {
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
        $this->requestArray = clone $this->initialQuery;
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
            $this
                ->validate($request)
                ->call($request)
            ;
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
        
        return $this->doCall($this->requestArray, $this->getFormatter());
    }
    
    
    private function doCall (array $requestArray, FormatterInterface $formatter)
    {
        $response = (new Client())->post(self::URI, [
            'form_params' => [
                $formatter->getFormatKey() => urlencode($formatter->formatData($requestArray))
            ]
        ]);
        
        return $this->processResponse($response);
    }
    
    
    protected function processResponse (ResponseInterface $response)
    {
        
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
        return $this->validator ?: new Validator();
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
        return new JsonFormatter();
    }
}