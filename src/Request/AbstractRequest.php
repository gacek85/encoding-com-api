<?php
namespace Gacek85\EncodingCom\Request;

use Gacek85\EncodingCom\Request\RequestInterface;

/**
 *  Abstraction for requests
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
abstract class AbstractRequest implements RequestInterface
{
    
    protected $requestArray = [];
    
    
    protected $children = [];
    
    
    /**
     * Returns the related data
     * 
     * @return      array
     */
    public function getData (): array
    {
        return array_merge([
            'action' => $this->getAction()
        ],$this->requestArray);
    }
    
    
    /**
     * 
     * @param   string                  $fieldName
     * @param   RequestInterface        $request
     * @return  AbstractRequest         Implementation of this class
     */
    protected function addChild (string $fieldName, RequestInterface $request): AbstractRequest
    {
        $this->children[$fieldName] = $request;
        return $this;
    }
    
    
    /**
     * Adds value for given field map
     * 
     * @param   string          $field
     * @param   string          $value
     * @return  AbstractRequest         Implementation of this class
     */
    public function addFieldValue (string $field, string $value): AbstractRequest
    {
        $keyMap = explode('.', $field);
        if (!count($keyMap)) {
            throw new \InvalidArgumentException(sprintf(
                'The field string must not be empty, `%s` given', 
                $field
            ));
        }
        
        $arrayPointer = &$this->requestArray;
        
        while (count($keyMap) > 1) {
            $key = array_shift($keyMap);
            if (!isset($arrayPointer[$key])) {
                $arrayPointer[$key] = [];
            }
            $arrayPointer = &$arrayPointer[$key];
        }
        
        $arrayPointer[array_shift($keyMap)] = $value;
        
        return $this;
    }
    
    
    /**
     * Tries to provice value from given array stored under given key.
     * If value is not present, provides a default
     * 
     * @param       array       $params
     * @param       string      $key
     * @param       mixed       $default
     */
    protected function getArrayParam (array $params, string $key, $default = null)
    {
        return array_key_exists($key, $params) ? $params[$key] : $default;
    }


    
    /**
     * Returns an array that represents JsonSchema
     * 
     * @return      array
     */
    public function getJsonSchemaArray (): array
    {
        return [
            '$schema' => 'http://json-schema.org/draft-04/schema#',
            'type' => 'object',
            'properties' => array_merge(
                $this->getScalarJsonSchemaArray(),
                $this->getChildrenJsonSchemaArray()
            )
        ];
    }
    
    
    protected function getChildrenJsonSchemaArray (): array 
    {
        $results = [];
        array_map(function (string $key, RequestInterface $request) use (&$results) {
            $results[$key] = [
                'type' => 'array',
                'items' => $request->getJsonSchemaArray()
            ];
        }, array_keys($this->children), $this->children);
        
        return $results;
    }
    
    
    /**
     * Returns an array of scalar values for given request
     * 
     * @return      array
     */
    abstract public function getScalarJsonSchemaArray (): array;
}