<?php
namespace Gacek85\EncodingCom\Validation;

use Gacek85\EncodingCom\Result\Result;
use Gacek85\EncodingCom\Result\ResultInterface;
use RuntimeException;
use Throwable;

/**
 *  Exception thrown when the call schema is not valid
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class Exception extends RuntimeException 
{
    protected $errors = [];


    public function __construct(array $errors = null, string $message = "", int $code = 0, Throwable $previous = null)
    {
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }
    
    
    public function getResult (): ResultInterface
    {
        return new Result(null, $this->errors);
    }
}