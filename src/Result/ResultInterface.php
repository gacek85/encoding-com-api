<?php
namespace Gacek85\EncodingCom\Result;

use LogicException;

/**
 *  Provides result interface
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
interface ResultInterface
{
    /**
     * Returns true if the result is valid
     * 
     * @return      bool
     */
    public function isValid (): bool;
    
    
    /**
     * Provides errors array
     * 
     * @return      array
     * 
     * @throws      LogicException     Triggered when is valid and this 
     *                                  method was called
     */
    public function getErrors (): array;
    
    
    /**
     * Returns response
     * 
     * @return      mixed
     * 
     * @throws      LogicException     Triggered when is not valid and this 
     *                                  method was called
     */
    public function getResponse ();
}