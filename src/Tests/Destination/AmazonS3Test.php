<?php
namespace Gacek85\EncodingCom\Tests\Destination;

use Gacek85\EncodingCom\AmazonS3\Keyring as AmazonKeyring;
use Gacek85\EncodingCom\Destination\AmazonS3 as S3Destination;

/**
 *  Test suite for AmazonS3 destination
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class AmazonS3Test extends \PHPUnit_Framework_TestCase 
{
    const ACCESS_KEY = 'this-is-an-access-key';
    
    const ACCESS_SIGNATURE = 'this-is-a-signature';
    
    const BUCKET = 'bucket';
    
    /**
     *
     * @var AmazonKeyring 
     */
    protected $keyring = null;
    
    
    protected function setUp ()
    {
        $this->keyring = $this->getKeyRing();
    }
    
    
    protected function getKeyRing (bool $addBucket = true): AmazonKeyring
    {
        return new AmazonKeyring(
                self::ACCESS_KEY, 
                self::ACCESS_SIGNATURE,
                $addBucket ? self::BUCKET : null
        );
    }
    
    
    public function testGetDestinationPath ()
    {
        $this->assertEquals(
            $this->getExpected() . 'acl=public-read', 
            (new S3Destination($this->keyring, $this->getInputPath()))->getDestinationPath()
        );
    }
    
    public function testGetDestinationPathNoBucket ()
    {
        $this->assertEquals(
            $this->getExpected(false) . 'acl=public-read', 
            (new S3Destination($this->getKeyRing(false), $this->getInputPath()))->getDestinationPath()
        );
    }
    
    
    public function testGetDestinationPathWithOptions ()
    {
        $this->assertEquals(
            $this->getExpected() . 'acl=public-read-write&amp;content_type=mp4', 
            (new S3Destination($this->keyring, $this->getInputPath(), [
                'acl' => 'public-read-write',
                'content_type' => 'mp4'
            ]))->getDestinationPath()
        );
    }
    
    
    protected function getExpected (bool $addBucket = true): string
    {
        $result = 'http://this-is-an-access-key:this-is-a-signature@bucket.s3.amazonaws.com/destination/path/to.mp4?';
        return $addBucket ? $result : str_replace('@bucket.', '@', $result);
    }
    
    
    protected function getInputPath (): string
    {
        return 'destination/path/to.mp4';
    }
}