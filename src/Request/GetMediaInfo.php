<?php
namespace Gacek85\EncodingCom\Request;

use Gacek85\EncodingCom\Request\RequestInterface;
use Gacek85\EncodingCom\Request\AbstractRequest;
use Gacek85\EncodingCom\Request\Format;

/**
 *  GetMediaInfo request
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class GetMediaInfo extends AbstractRequest implements RequestInterface
{
    
    const ACTION_NAME = 'getMediaInfo';
    
    
    /**
     * Constructor for AddMedia.
     * 
     * @param       array       $values
     */
    public function __construct (array $values)
    {
        $this
            ->setMediaId($this->getArrayParam($values, 'mediaid'))
        ;
    }
    
    
    /**
     * Adds the notify string parameter
     * 
     * @param       string      $mediaId
     */
    public function setMediaId (string $mediaId): GetMediaInfo 
    {
        return $this->addFieldValue('mediaid', $mediaId);
    }
    
    
    /**
     * Returns an array of scalar values for given request
     * 
     * @return      array
     */
    public function getScalarJsonSchemaArray (): array
    {
        return [
            'mediaid' => ['type' => 'string']
        ];
    }

    
    /**
     * Returns a name of the action
     * 
     * @return      string
     */
    public function getAction (): string
    {
        return self::ACTION_NAME;
    }

}