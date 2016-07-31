<?php
namespace Gacek85\EncodingCom;

/**
 *  Defines destination provider behavior
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
interface DestinationInterface 
{
    /**
     * Returns destination path
     * 
     * @return      string
     */
    public function getDestinationPath (): string;
    
}