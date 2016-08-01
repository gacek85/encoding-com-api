<?php
namespace Gacek85\EncodingCom\Formatter;

use Gacek85\EncodingCom\Formatter\FormatterInterface;

/**
 *  Formats the data to Json format
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class JsonFormatter extends AbstractFormatter implements FormatterInterface 
{
    
    /**
     * Returns json formatted data
     * 
     * @param   array   $data
     */
    public function formatData (array $data) : string
    {
        $this->validateGetRoot($data);
        return json_encode ($data);
    }
    
    
    /**
     * Provides key for format
     * 
     * @return      string
     */
    public function getFormatKey (): string
    {
        return 'json';
    }
    
}