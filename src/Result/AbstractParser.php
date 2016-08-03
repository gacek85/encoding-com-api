<?php
namespace Gacek85\EncodingCom\Result;

use Gacek85\EncodingCom\Result\ParserInterface;
use Gacek85\EncodingCom\Result\ResultInterface;
use Gacek85\EncodingCom\Result\Result;

/**
 *  Result parser
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
abstract class AbstractParser implements ParserInterface 
{
    
    /**
     * Provides key for format
     * 
     * @return      string
     */
    public function getFormatKey (): string
    {
        return static::CONTENT_TYPE;
    }
    
    /**
     * Filters response to array
     * 
     * @param       mixed       $result
     * 
     * @return      array
     */
    abstract protected function toArray ($result): array;
    
    
    /**
     * Parses given result to ResultInterface
     * 
     * @param       mixed               $result
     * @return      ResultInterface
     */
    public function parse ($result): ResultInterface
    {
        $resultArray = $this->toArray($result);
        
        return array_key_exists('response', $resultArray) 
                    ?   $this->doParse($resultArray['response']) 
                    :   $this->getError()
        ;
    }
    
    
    private function doParse (array $response): ResultInterface
    {
        return !array_key_exists('errors', $response) 
                    ?       new Result($response) 
                    :       $this->getError(array_map(function ($errorArray) {
                        return $errorArray['error'];
                    }, $response['errors']))
        ;
    }
    
    
    private function getError (array $errors = null): ResultInterface
    {
        return new Result(null, $errors ?: [
            'Encoding.com error occured'
        ]);
    }
}