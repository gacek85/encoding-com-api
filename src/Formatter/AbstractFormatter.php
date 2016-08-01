<?php
namespace Gacek85\EncodingCom\Formatter;

use InvalidArgumentException;

/**
 *  Abstract base for formatters
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
abstract class AbstractFormatter
{
    
    protected function validateGetRoot (array $data): string 
    {
        if ((count($data) > 1) || !count($data) || !is_array(reset($data))) {
            throw new InvalidArgumentException(
                'The data needs to contian one root and it\'s value needs to be array!'
            );
        }
        return key($data);
    }
}