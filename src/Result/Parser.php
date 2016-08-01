<?php
namespace Gacek85\EncodingCom\Result;

use Gacek85\EncodingCom\Result\ParserInterface;
use Gacek85\EncodingCom\Result\ResultInterface;

/**
 *  Result parser
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class Parser implements ParserInterface 
{
    /**
     * Parses given result to ResultInterface
     * 
     * @param       mixed               $result
     * @return      ResultInterface
     */
    public function parse ($result): ResultInterface
    {
        
    }
}