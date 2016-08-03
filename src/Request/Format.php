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
                
            ->setTwoPass($this->getArrayParam($values, 'two_pass'))
            ->setTurbo($this->getArrayParam($values, 'turbo'))
            ->setTwinTurbo($this->getArrayParam($values, 'twin_turbo'))
            ->setCbr($this->getArrayParam($values, 'cbr'))
            ->setDeinterlacing($this->getArrayParam($values, 'deinterlacing'))
            ->setKeyframe($this->getArrayParam($values, 'keyframe'))
            ->setAudioVolume($this->getArrayParam($values, 'audio_volume'))
            ->setMetadataCopy($this->getArrayParam($values, 'metadata_copy'))
            ->setStripChapters($this->getArrayParam($values, 'strip_chapters'))
            ->setPreset($this->getArrayParam($values, 'preset'))
            ->setAcbr($this->getArrayParam($values, 'acbr'))
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
        $this->addFieldValue('audio_sample_rate', $audioBitrate);
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
        $this->addFieldValue('destination', $destination->getDestinationPath());
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
     * Sets the two pass - allowed: 'yes', 'no'
     * 
     * @param       string      $twoPass
     * @return      Format
     */
    public function setTwoPass (string $twoPass = null): Format
    {
        $this->addFieldValue('two_pass', $twoPass);
        return $this;
    }
    
    
    /**
     * Sets the turbo - allowed: 'yes', 'no'
     * 
     * @param       string      $turbo
     * @return      Format
     */
    public function setTurbo (string $turbo = null): Format
    {
        $this->addFieldValue('turbo', $turbo);
        return $this;
    }
    
    
    /**
     * Sets the twin turbo - allowed: 'yes', 'no'
     * 
     * @param       string      $twinTurbo
     * @return      Format
     */
    public function setTwinTurbo (string $twinTurbo = null): Format
    {
        $this->addFieldValue('twin_turbo', $twinTurbo);
        return $this;
    }
    
    
    /**
     * Sets the cbr - allowed: 'yes', 'no'
     * 
     * @param       string      $cbr
     * @return      Format
     */
    public function setCbr (string $cbr = null): Format
    {
        $this->addFieldValue('cbr', $cbr);
        return $this;
    }
    
    
    /**
     * Sets the deinterlacing - allowed: 'yes', 'no'
     * 
     * @param       string      $deinterlacing
     * @return      Format
     */
    public function setDeinterlacing (string $deinterlacing = null): Format
    {
        $this->addFieldValue('deinterlacing', $deinterlacing);
        return $this;
    }
    
    
    /**
     * Sets the keyframe - integer string
     * 
     * @param       string      $keyframe
     * @return      Format
     */
    public function setKeyframe (string $keyframe = null): Format
    {
        $this->addFieldValue('keyframe', $keyframe);
        return $this;
    }
    
    
    /**
     * Sets the audio volume - integer string from 0 to 100
     * 
     * @param       string      $audioVolume
     * @return      Format
     */
    public function setAudioVolume (string $audioVolume = null): Format
    {
        $this->addFieldValue('audio_volume', $audioVolume);
        return $this;
    }
    
    
    /**
     * Sets the metadata copy - allowed: 'yes', 'no'
     * 
     * @param       string      $metadataCopy
     * @return      Format
     */
    public function setMetadataCopy (string $metadataCopy = null): Format
    {
        $this->addFieldValue('metadata_copy', $metadataCopy);
        return $this;
    }
    
    
    /**
     * Sets the strip chapters - allowed: 'yes', 'no'
     * 
     * @param       string      $stripChapters
     * @return      Format
     */
    public function setStripChapters (string $stripChapters = null): Format
    {
        $this->addFieldValue('strip_chapters', $stripChapters);
        return $this;
    }
    
    
    /**
     * Sets the preset - integer value
     * 
     * @param       string      $preset
     * @return      Format
     */
    public function setPreset (string $preset = null): Format
    {
        $this->addFieldValue('preset', $preset);
        return $this;
    }
    
    
    /**
     * Sets the acbr - allowed: 'yes', 'no'
     * 
     * @param       string      $acbr
     * @return      Format
     */
    public function setAcbr (string $acbr = null): Format
    {
        $this->addFieldValue('acbr', $acbr);
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
     * Returns the related data
     * 
     * @return      array
     */
    public function getData (): array
    {
        return $this->requestArray;
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
            "additionalProperties" => false,
            'properties' => [
                'output' => ['type' => 'string'],
                'video_codec' => ['type' => 'string'],
                'bitrate' => ['type' => 'string'],
                'size' => ['type' => 'string'],
                'audio_bitrate' => ['type' => 'string'],
                'audio_sample_rate' => ['type' => 'integer'],
                'audio_channels_number' => ['type' => 'integer'],
                'framerate' => ['type' => 'string'],
                'destination' => ['type' => 'string'],
                'deinterlacing' => ['type' => 'string'],
                'keyframe' => ['type' => 'integer'],
                'preset' => [
                    'type' => 'integer',
                    'minimum' => 1
                ],
                'audio_volume' => [
                    'type' => 'integer',
                    'minimum' => 0,
                    'maximum' => 100
                ],
                'keep_aspect_ratio' => [
                    'type' => [
                        'enum' => ['yes', 'no']
                    ],
                ],
                'acbr' => [
                    'type' => [
                        'enum' => ['yes', 'no']
                    ],
                ],
                'metadata_copy' => [
                    'type' => [
                        'enum' => ['yes', 'no']
                    ],
                ],
                'strip_chapters' => [
                    'type' => [
                        'enum' => ['yes', 'no']
                    ],
                ],
                'two_pass' => [
                    'type' => [
                        'enum' => ['yes', 'no']
                    ],
                ],
                'turbo' => [
                    'type' => [
                        'enum' => ['yes', 'no']
                    ],
                ],
                'twin_turbo' => [
                    'type' => [
                        'enum' => ['yes', 'no']
                    ],
                ],
                'cbr' => [
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