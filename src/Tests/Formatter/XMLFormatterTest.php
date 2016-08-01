<?php
namespace Gacek85\EncodingCom\Tests\Formatter;

use Gacek85\EncodingCom\Formatter\XMLFormatter;

/**
 *  Test suite for XMLFormatter
 *
 *  @author Maciej Garycki <maciej@neverbland.com>
 *  @company Neverbland
 *  @copyrights Neverbland 2015
 */
class XMLFormatterTest extends \PHPUnit_Framework_TestCase 
{
    protected $formatter = null;
    
    protected function setUp ()
    {
        $this->formatter = new XMLFormatter();
    }
    
    
    public function testGetFormatKey ()
    {
        $this->assertEquals('xml', $this->formatter->getFormatKey());
    }
    
    
    public function testFormatData ()
    {
        $this->assertXmlStringEqualsXmlString(
            $this->getOutputXML(), 
            $this
                ->formatter
                ->formatData(
                    $this->getInputData()
                )
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



    protected function getOutputXML (): string
    {
        return 
            '<?xml version="1.0"?>
            <query>
                <action>TestAction</action>
                <userid>testuserid</userid>
                <format>
                    <output>mp4</output>
                    <destination>/path/to/1.mp4</destination>
                </format>
                <format>
                    <output>webm</output>
                    <destination>/path/to/1.webm</destination>
                </format>
                <arrayValue>
                    <some1>value1</some1>
                    <some2>value2</some2>
                </arrayValue>
            </query>'
        ;
    }
}