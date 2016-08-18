<?php
namespace Gacek85\EncodingCom\Result;

use Gacek85\EncodingCom\Result\ResultInterface;
use LogicException;

/**
 *  Default implementation of ResultInterface 
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class Result implements ResultInterface 
{
    
    protected $errors = null;
    
    protected $response = null;
    
    
    public function __construct ($response = null, array $errors = null)
    {
        $this->response = $response;
        $this->errors = $errors;
    }
    
    /**
     * Returns true if the result is valid
     * 
     * @return      bool
     */
    public function isValid (): bool
    {
        return !(bool)$this->errors;
    }
    
    
    /**
     * Provides errors array
     * 
     * @return      array
     * 
     * @throws      LogicException     Triggered when is valid and this 
     *                                  method was called
     */
    public function getErrors (): array
    {
        if ($this->isValid()) {
            throw new LogicException('The result contains no errors');
        }
        
        return $this->errors;
    }
    
    
    /**
     * Returns response
     * 
     * @return      mixed
     * 
     * @throws      LogicException     Triggered when is not valid and this 
     *                                  method was called
     */
    public function getResponse ()
    {
        if (!$this->isValid()) {
            throw new LogicException('The result contains errors');
        }
        
        return $this->response;
    }
    
}