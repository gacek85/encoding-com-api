<?php
namespace Gacek85\EncodingCom\Request;

use Gacek85\EncodingCom\Formatter\FormatterInterface;
use Gacek85\EncodingCom\Request\RequestCallInterface;

/**
 *  cURL based implementation for RequestCallInterface
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class CurlRequestCall implements RequestCallInterface
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
	    $ch = curl_init();  
	    curl_setopt($ch, CURLOPT_URL, $uri);  
	    curl_setopt($ch, CURLOPT_POSTFIELDS, sprintf(
            '%s=%s', 
            $formatter->getFormatKey(), 
            urlencode($formatter->formatData($requestArray))
        ));  
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
	    curl_setopt($ch, CURLOPT_HEADER, 0);  
	    $xml_response = curl_exec($ch); 
        
        return $xml_response;
    }
    
    
}