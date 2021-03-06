<?php
namespace Gacek85\EncodingCom\Request;

use Gacek85\EncodingCom\Formatter\FormatterInterface;
use Gacek85\EncodingCom\Request\RequestCallInterface;
use GuzzleHttp\Client;

/**
 *  Guzzle based implementation for RequestCallInterface
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class GuzzleRequestCall implements RequestCallInterface
{
    
    /**
     * Makes external call
     * 
     * @param       string                  $uri
     * @param       RequestInterface        $requestArray
     * @param       FormatterInterface      $formatter
     * 
     * @return      mixed
     */
    public function call (string $uri, array $requestArray, FormatterInterface $formatter)
    {   
        return (new Client())->request('POST', $uri, [
            'body' => sprintf(
                '%s=%s', 
                $formatter->getFormatKey(), 
                urlencode($formatter->formatData($requestArray))
            )
        ])->getBody();
    }
    
    
}