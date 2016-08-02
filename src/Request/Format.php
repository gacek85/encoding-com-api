<?php
namespace Gacek85\EncodingCom\Request;

use Gacek85\EncodingCom\Destination\DestinationInterface;
use Gacek85\EncodingCom\Request\AbstractRequest;
use Gacek85\EncodingCom\Request\RequestInterface;

/**
 *  Format request
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class Format extends AbstractRequest implements RequestInterface
{
        
    
    public function __construct (array $values)
    {
        $this
            ->setOutput($this->getArrayParam($values, 'output'))
            ->setVideoCodec($this->getArrayParam($values, 'video_codec'))
            ->setBitrate($this->getArrayParam($values, 'bitrate'))
            ->setSize($this->getArrayParam($values, 'size'))
            ->setAudioBitrate($this->getArrayParam($values, 'audio_bitrate'))
            ->setAudioSampleRate($this->getArrayParam($values, 'audio_sample_rate'))
            ->setAudioChannelsNumber($this->getArrayParam($values, 'audio_channels_number'))
            ->setFramerate($this->getArrayParam($values, 'framerate'))
            ->setDestination($this->getArrayParam($values, 'destination'))
            ->setKeepAspectRatio($this->getArrayParam($values, 'keep_aspect_ratio'))
            ->setProfile($this->getArrayParam($values, 'profile'))
        ;
    }
    
    
    /**
     * Sets the output name
     * 
     * @param       string      $output
     * @return      Format
     */
    public function setOutput (string $output = null): Format
    {
        $this->addFieldValue('output', $output);
        return $this;
    }
    
    /**
     * Sets the video codec
     * 
     * @param       string      $videoCodec
     * @return      Format
     */
    public function setVideoCodec (string $videoCodec = null): Format
    {
        $this->addFieldValue('video_codec', $videoCodec);
        return $this;
    }
    
    
    /**
     * Sets the bitrate
     * 
     * @param       string      $bitrate
     * @return      Format
     */
    public function setBitrate (string $bitrate = null): Format
    {
        $this->addFieldValue('bitrate', $bitrate);
        return $this;
    }
    
    
    /**
     * Sets the size
     * 
     * @param       string      $size
     * @return      Format
     */
    public function setSize (string $size = null): Format
    {
        $this->addFieldValue('size', $size);
        return $this;
    }
    
    
    /**
     * Sets the audio bitrate
     * 
     * @param       string      $audioBitrate
     * @return      Format
     */
    public function setAudioBitrate (string $audioBitrate = null): Format
    {
        $this->addFieldValue('audio_bitrate', $audioBitrate);
        return $this;
    }
    
    
    /**
     * Sets the audio bitrate
     * 
     * @param       string      $audioBitrate
     * @return      Format
     */
    public function setAudioSampleRate (string $audioBitrate = null): Format
    {
        $this->addFieldValue('audio_bitrate', $audioBitrate);
        return $this;
    }
    
    
    /**
     * Sets the framerate
     * 
     * @param       string      $framerate
     * @return      Format
     */
    public function setFramerate (string $framerate = null): Format
    {
        $this->addFieldValue('framerate', $framerate);
        return $this;
    }
    
    
    /**
     * Sets the audio channels number
     * 
     * @param       string      $audioChannelsNumber
     * @return      Format
     */
    public function setAudioChannelsNumber (string $audioChannelsNumber = null): Format
    {
        $this->addFieldValue('audio_channels_number', $audioChannelsNumber);
        return $this;
    }
   
    
    /**
     * Sets the audio channels number
     * 
     * @param       DestinationInterface      $destination
     * @return      Format
     */
    public function setDestination (DestinationInterface $destination = null): Format
    {
        if (!$destination) {
            return $this;
        }
        $this->addFieldValue('audio_channels_number', $destination->getDestinationPath());
        return $this;
    }
    
    
    /**
     * Sets the keep aspect ration flag - allowed values: yes/no
     * 
     * @param       string      $keepAspectRatio
     * @return      Format
     */
    public function setKeepAspectRatio (string $keepAspectRatio = null): Format
    {
        $this->addFieldValue('keep_aspect_ratio', $keepAspectRatio);
        return $this;
    }
    
    
    /**
     * Sets the profile - allowed: 'high', 'main', 'baseline'
     * 
     * @param       string      $profile
     * @return      Format
     */
    public function setProfile (string $profile = null): Format
    {
        $this->addFieldValue('profile', $profile);
        return $this;
    }
    
    
    /**
     * Returns a anme of the action
     * 
     * @return      string
     */
    public function getAction (): string
    {
        return '';
    }
    
    
    
    /**
     * Returns an array of scalar values for given request
     * 
     * @return      array
     */
    public function getScalarJsonSchemaArray (): array
    {
        return [
            'type' => 'object',
            'properties' => [
                'output' => ['type' => 'string'],
                'video_codec' => ['type' => 'string'],
                'bitrate' => ['type' => 'string'],
                'size' => ['type' => 'string'],
                'audio_bitrate' => ['type' => 'string'],
                'audio_sample_rate' => ['type' => 'string'],
                'audio_channels_number' => ['type' => 'string'],
                'framerate' => ['type' => 'string'],
                'destination' => ['type' => 'string'],
                'keep_aspect_ratio' => [
                    'type' => [
                        'enum' => ['yes', 'no']
                    ],
                ],
                'profile' => [
                    'type' => [
                        'enum' => [
                            'high', 
                            'main', 
                            'baseline'
                        ]
                    ]
                ]
            ],
            'required' => ['output', 'video_codec']
        ];
    }

}