<?php
namespace Gacek85\EncodingCom\Request;

use Gacek85\EncodingCom\Request\RequestInterface;
use Gacek85\EncodingCom\Formatter\FormatterInterface;

/**
 *  Makes external call
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
interface RequestCallInterface 
{
    /**
     * Makes external call
     * 
     * @param       string                  $uri
     * @param       array                   $request
     * @param       FormatterInterface      $formatter
     * 
     * @return      mixed
     */
    public function call (string $uri, array $requestArray, FormatterInterface $formatter);
}