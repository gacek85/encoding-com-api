<?php
namespace Gacek85\EncodingCom\Destination;

use Gacek85\EncodingCom\DestinationInterface;
use Gacek85\EncodingCom\AmazonS3\Keyring as AmazonKeyring;

/**
 *  Destination wrapper for Amazon S3 storage
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class AmazonS3 implements DestinationInterface 
{

    const QUERY_SEPARATOR = '&amp;';

    /**
     *
     * @var AmazonKeyring
     */
    protected $keyring = null;
    
    
    protected $destinationPath = null;
    
    
    protected $params = [];
    
    
    /**
     * Constructor.
     * 
     * @param       AmazonKeyring       $keyring            Keyring containing S3 details
     * @param       string              $destinationPath    Destination path
     * @param       array               $params             Further access parrams
     */
    public function __construct (
        AmazonKeyring $keyring, 
        string $destinationPath, 
        array $params = [
            'acl' => 'public-read'
        ]
    )
    {
        $this->keyring = $keyring;
        $this->destinationPath = $destinationPath;
        $this->params = $params;
    }
    
    /**
     * Returns destination path
     * 
     * @return      string
     */
    public function getDestinationPath (): string
    {
        
        return sprintf(
            '%s?%s',
            $this->buildDestinationPath(),
            $this->buildParams()
        );
    }
    
    
    protected function buildDestinationPath (): string
    {
        return substr_replace(
            $this->destinationPath,
            sprintf(
                '%s:%s@',
                urlencode($this->keyring->getAccessKeyId()),
                urlencode($this->keyring->getSignature())
            ), 7, 0
        );
    }
    
    
    protected function buildParams (): string 
    {
        return http_build_query($this->params, null, self::QUERY_SEPARATOR);
    }
}