<?php
namespace Gacek85\EncodingCom\Destination;

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
    
    
    /**
     * Returns the public URI to the destination
     * 
     * @return      string
     */
    public function getPublicUri (): string;
    
}