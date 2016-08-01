<?php
namespace Gacek85\EncodingCom\Formatter;

/**
 *  Formats the response data to proper serialized
 *  format
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
interface FormatterInterface 
{
    
    /**
     * Returns formatted data
     * 
     * @param       array   $data
     */
    public function formatData (array $data) : string;
    
    
    /**
     * Provides key for format
     * 
     * @return      string
     */
    public function getFormatKey (): string;
}