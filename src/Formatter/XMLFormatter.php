<?php
namespace Gacek85\EncodingCom\Formatter;

use Gacek85\EncodingCom\Formatter\FormatterInterface;
use SimpleXMLElement;

/**
 *  Formats the data to XML format
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class XMLFormatter extends AbstractFormatter implements FormatterInterface 
{
    
    /**
     * Returns xml formatted data
     * 
     * @param   array   $data
     */
    public function formatData (array $data) : string
    {
        $xml = new SimpleXMLElement(sprintf(
            '<%s></%s>', 
            $rootString = $this->validateGetRoot($data), 
            $rootString
        ));
        
        return $this->processData($xml, $data[$rootString]);
    }
    
    
    protected function processData (SimpleXMLElement $xml, array $data)
    {
        array_map(function ($key, $element) use ($xml) {
            !is_array($element) 
                ?   $xml->addChild($key, $element)
                :   $this->formatArray($xml, $key, $element)
            ;
        }, array_keys($data), $data);
        
        return $xml->asXML();
    }
    
    
    protected function formatArray (SimpleXMLElement $xml, $key, array $element)
    {
        isset($element[0]) 
            ?   $this->doFormatArray($xml, $key, $element)
            :   $this->processData($xml->addChild($key), $element)
        ;
    }
    
    
    protected function doFormatArray (SimpleXMLElement $xml, $key, array $element)
    {
        array_map(function ($elementItem) use ($xml, $key) {
            $elementNode = $xml->addChild($key);
            $this->processData($elementNode, $elementItem);
        }, $element);
    }
    

    /**
     * Provides key for format
     * 
     * @return      string
     */
    public function getFormatKey (): string
    {
        return 'xml';
    }
    
}