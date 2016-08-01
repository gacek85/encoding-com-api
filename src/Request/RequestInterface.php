<?php
namespace Gacek85\EncodingCom\Request;


/**
 *  Defines request
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
interface RequestInterface 
{
    /**
     * Returns an array that represents JsonSchema
     * 
     * @return      array
     */
    public function getJsonSchemaArray (): array;
    
    
    /**
     * Returns the related data
     * 
     * @return      array
     */
    public function getData (): array;
    
    
    /**
     * Returns a name of the action
     * 
     * @return      string
     */
    public function getAction (): string;
}