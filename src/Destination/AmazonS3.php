<?php
namespace Gacek85\EncodingCom\Destination;

use Gacek85\EncodingCom\Destination\DestinationInterface;
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
    
    const DESTINATION_PLACEHOLDER = 'http://%s:%s@%ss3.amazonaws.com/%s';
    
    const PUBLIC_PLACEHOLDER = '//%ss3.amazonaws.com/%s';

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
    
    
    /**
     * Returns the public URI to the destination
     * 
     * @return      string
     */
    public function getPublicUri (): string 
    {
        return sprintf(
            self::PUBLIC_PLACEHOLDER,
            ($bucket = $this->keyring->getBucket()) ? sprintf('%s.', $bucket) : '',
            $this->fixPath($this->destinationPath)
        );
    }
    
    
    protected function buildDestinationPath (): string
    {
        return sprintf(
            self::DESTINATION_PLACEHOLDER,
            urlencode($this->keyring->getAccessKeyId()),
            urlencode($this->keyring->getSignature()),
            ($bucket = $this->keyring->getBucket()) ? sprintf('%s.', $bucket) : '',
            $this->fixPath($this->destinationPath)
        );
    }
    
    
    protected function fixPath (string $destinationPath)
    {
        return parse_url($destinationPath, PHP_URL_PATH);
    }
    
    
    protected function buildParams (): string 
    {
        return http_build_query($this->params, null, self::QUERY_SEPARATOR);
    }
}