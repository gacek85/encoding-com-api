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
    
    protected $keyring = null;
    
    
    protected function setUp ()
    {
        $this->keyring = new AmazonKeyring(self::ACCESS_KEY, self::ACCESS_SIGNATURE);
    }
    
    
    public function testGetDestinationPath ()
    {
        $this->assertEquals(
            $this->getExpected() . 'acl=public-read', 
            (new S3Destination($this->keyring, self::BUCKET, $this->getInputPath()))->getDestinationPath()
        );
    }
    
    
    public function testGetDestinationPathWithOptions ()
    {
        $this->assertEquals(
            $this->getExpected() . 'acl=public-read-write&amp;content_type=mp4', 
            (new S3Destination($this->keyring, self::BUCKET, $this->getInputPath(), [
                'acl' => 'public-read-write',
                'content_type' => 'mp4'
            ]))->getDestinationPath()
        );
    }
    
    
    protected function getExpected ()
    {
        return 'http://this-is-an-access-key:this-is-a-signature@bucket.s3.amazonaws.com/destination/path/to.mp4?';
    }
    
    
    protected function getInputPath ()
    {
        return 'destination/path/to.mp4';
    }
}