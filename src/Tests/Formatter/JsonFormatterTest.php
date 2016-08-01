<?php
namespace Gacek85\EncodingCom\Tests\Formatter;

use Gacek85\EncodingCom\Formatter\JsonFormatter;

/**
 *  Test suite for XMLFormatter
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class JsonFormatterTest extends \PHPUnit_Framework_TestCase 
{
    protected $formatter = null;
    
    protected function setUp ()
    {
        $this->formatter = new JsonFormatter();
    }
    
    
    public function testGetFormatKey ()
    {
        $this->assertEquals('json', $this->formatter->getFormatKey());
    }
    
    
    public function testFormatData ()
    {
        $this->assertJsonStringEqualsJsonString(
            json_encode($data = $this->getInputData()), 
            $this->formatter->formatData($data)
        );
    }
    
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testFormatDataExceptionThrownEmpty ()
    {
        $this->formatter->formatData([]);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testFormatDataExceptionThrownDoubleRoot ()
    {
        $this->formatter->formatData([
            'root1' => [
                'some' => 'value'
            ],
            'root2' => [
                'some' => 'value'
            ]
        ]);
    }
    
    
    protected function getInputData (): array 
    {
        return [
            'query' => [
                'action' => 'TestAction',
                'userid' => 'testuserid',
                'format' => [
                    0 => [
                        'output' => 'mp4',
                        'destination' => '/path/to/1.mp4'
                    ],
                    1 => [
                        'output' => 'webm',
                        'destination' => '/path/to/1.webm'
                    ]
                ],
                'arrayValue' => [
                    'some1' => 'value1',
                    'some2' => 'value2'
                ]
            ]
        ];
    }
}