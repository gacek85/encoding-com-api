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
class JsonParser extends AbstractParser implements ParserInterface 
{
    
    const CONTENT_TYPE = 'json';
    
    /**
     * Filters response to array
     * 
     * @param       mixed       $result
     * 
     * @return      array
     */
    public function toArray ($result): array
    {
        return json_decode($result, true) ?: [];
    }
}