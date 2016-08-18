<?php
namespace Gacek85\EncodingCom\Result;

use Gacek85\EncodingCom\Result\ParserInterface;

/**
 *  Result parser
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class XMLParser extends AbstractParser implements ParserInterface 
{
    const CONTENT_TYPE = 'xml';
    
    /**
     * Filters response to array
     * 
     * @param       mixed       $result
     * 
     * @return      array
     */
    public function toArray ($result): array
    {
        $xmlObject = @simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);
        $json = $xmlObject ? json_encode($xmlObject) : null;
        
        return $json ? [
            'response' => json_decode($json, true)
        ] : [];
    }
    
}