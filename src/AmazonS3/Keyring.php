<?php
namespace Gacek85\EncodingCom\AmazonS3;

/**
 *  Keyring for Amazon S3
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class Keyring 
{
    
    protected $accessKeyId = null;
    
    protected $signature = null;
    
    public function __construct (string $accessKeyId, string $signature)
    {
        $this->accessKeyId = $accessKeyId;
        $this->signature = $signature;
    }
    
    /**
     * Provides stored access key ID
     * 
     * @return      string
     */
    public function getAccessKeyId (): string 
    {
        return $this->accessKeyId;
    }
    
    
    /**
     * Provides stored signature
     * 
     * @return      string
     */
    public function getSignature (): string
    {
        return $this->signature;
    }
}