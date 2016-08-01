<?php
namespace Gacek85\EncodingCom\Request;

use Gacek85\EncodingCom\Request\RequestInterface;
use Gacek85\EncodingCom\Request\AbstractRequest;
use Gacek85\EncodingCom\Request\Format;

/**
 *  AddMedia request
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class AddMedia extends AbstractRequest implements RequestInterface
{
    
    const ACTION_NAME = 'addMedia';
    
    
    /**
     * Constructor for AddMedia.
     * 
     * @param       array       $values
     */
    public function __construct (array $values)
    {
        $this
            ->setSource($this->getArrayParam('source', $values))
            ->addChild('format', new Format())
            ->setFormats($this->getArrayParam('formats', $values))
        ;
    }
    
    
    /**
     * Adds formats
     * 
     * @param       array       $formats
     * @return      AddMedia
     */
    public function setFormats (array $formats): AddMedia
    {
        array_map(function (array $formatArray) {
            $this->addFormat($formatArray);
        }, $formats);
        
        return $this;
    }
    
    
    /**
     * 
     * @param array $formatArray
     * @return AddMedia
     */
    public function addFormat (array $formatArray): AddMedia
    {
        return $this->addFieldValue('format', $this->ensureFormats($formatArray));
    }
    
    
    protected function ensureFormats (array $formatArray)
    {
        if (!isset($this->requestArray['format'])) {
            $this->requestArray['format'] = [];
        }
        
        return array_merge($this->requestArray['format'], [
            (new Format($formatArray))->getData()
        ]);
    }
            
    
    /**
     * Adds the source string parameter
     * 
     * @param       string      $source
     */
    public function setSource (string $source): AddMedia 
    {
        return $this->addFieldValue('source', $source);
    }
    
    /**
     * Adds the notify string parameter
     * 
     * @param       string      $notify
     */
    public function setNotify (string $notify): AddMedia 
    {
        return $this->addFieldValue('notify', $notify);
    }
    
    
    /**
     * Returns a anme of the action
     */
    public function getAction (): string
    {
        return self::ACTION_NAME;
    }
    
    
    /**
     * Returns an array of scalar values for given request
     * 
     * @return      array
     */
    public function getScalarJsonSchemaArray (): array
    {
        return [
            'notify' => ['type' => 'string']
        ];
    }

}