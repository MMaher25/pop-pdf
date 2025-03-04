<?php

namespace Pop\Pdf\Test\Document\Page;

use Pop\Pdf\Document\Page\Color;
use Pop\Pdf\Document\Page\Text;
use PHPUnit\Framework\TestCase;

class TextTest extends TestCase
{

    public function testGetSize()
    {
        $text = new Text('Hello World', 12);
        $this->assertEquals(12, $text->getSize());
    }

    public function testSetMbString()
    {
        $text = new Text("mb string åèä test", 12);
        $this->assertEquals(18, strlen($text->getString()));
    }

    public function testAddStringWithOffset()
    {
        $text = new Text('', 12);
        $text->addStringWithOffset('Hello', 10);
        $text->addStringWithOffset("mb string åèä test", 10);
        $this->assertEquals(2, count($text->getStringsWithOffset()));
    }

    public function testSetFillColor()
    {
        $text = new Text('Hello World', 12);
        $text->setFillColor(new Color\Rgb(255, 0, 0));
        $this->assertInstanceOf('Pop\Pdf\Document\Page\Color\Rgb', $text->getFillColor());
    }

    public function testSetStrokeColor()
    {
        $text = new Text('Hello World', 12);
        $text->setStrokeColor(new Color\Rgb(255, 0, 0));
        $this->assertInstanceOf('Pop\Pdf\Document\Page\Color\Rgb', $text->getStrokeColor());
    }

    public function testSetStroke()
    {
        $text = new Text('Hello World', 12);
        $text->setStroke(5, 10, 15);
        $this->assertEquals(5, $text->getStroke()['width']);
        $this->assertEquals(10, $text->getStroke()['dashLength']);
        $this->assertEquals(15, $text->getStroke()['dashGap']);
    }

    public function testSetRotation()
    {
        $text = new Text('Hello World', 12);
        $text->setRotation(45);
        $this->assertEquals(45, $text->getRotation());
    }

    public function testSetRotationException()
    {
        $this->expectException('OutOfRangeException');
        $text = new Text('Hello World', 12);
        $text->setRotation(120);
    }

    public function testSetTextParams()
    {
        $text = new Text('Hello World', 12);
        $text->setTextParams(10, 10, 10, 10, -45, 1);
        $this->assertInstanceOf('Pop\Pdf\Document\Page\Text', $text);
    }

    public function testSetTextParamsException1()
    {
        $this->expectException('OutOfRangeException');
        $text = new Text('Hello World', 12);
        $text->setTextParams(10, 10, 10, 10, -120, 1);
    }

    public function testSetTextParamsException2()
    {
        $this->expectException('OutOfRangeException');
        $text = new Text('Hello World', 12);
        $text->setTextParams(10, 10, 10, 10, -45, 10);
    }

    public function testGetStream()
    {
        $text = new Text('Hello World', 12);
        $text->setFillColor(new Color\Rgb(255, 0, 0));
        $text->setStrokeColor(new Color\Rgb(255, 0, 0));
        $text->setStroke(5, 10, 15);
        $text->setTextParams(10, 10, 10, 10, -45, 1);
        $this->assertContains('MF1', $text->getStream('MF1 1 0 R', 20, 200));
    }

    public function testGetStreamCmyk()
    {
        $text = new Text('Hello World', 12);
        $text->setFillColor(new Color\Cmyk(100, 0, 0, 0));
        $text->setStrokeColor(new Color\Cmyk(100, 0, 0, 0));
        $text->setStroke(5, 10, 15);
        $text->setTextParams(10, 10, 10, 10, -45, 1);
        $this->assertContains('MF1', $text->getStream('MF1 1 0 R', 20, 200));
    }

    public function testGetStreamGray()
    {
        $text = new Text('Hello World', 12);
        $text->setFillColor(new Color\Gray(50));
        $text->setStrokeColor(new Color\Gray(50));
        $text->setStroke(5, 10, 15);
        $text->setTextParams(10, 10, 10, 10, -45, 1);
        $this->assertContains('MF1', $text->getStream('MF1 1 0 R', 20, 200));
    }

    public function testSetAndGetCharWrap()
    {
        $text = new Text('Hello World', 12);
        $text->setCharWrap(10, 10);
        $this->assertEquals(10, $text->getCharWrap());
        $this->assertEquals(10, $text->getLeading());
        $this->assertTrue($text->hasCharWrap());
    }

    public function testSetAndGetLeading()
    {
        $text = new Text('Hello World', 12);
        $text->setLeading(10);
        $this->assertEquals(10, $text->getLeading());
        $this->assertTrue($text->hasLeading());
    }

    public function testSetAndGetAlignment()
    {
        $text = new Text('Hello World', 12);
        $text->setAlignment(Text\Alignment::createLeft(50, 550));
        $this->assertTrue($text->hasAlignment());
    }

    public function testSetAndGetWrap()
    {
        $text = new Text('Hello World', 12);
        $text->setWrap(Text\Wrap::createLeft(50, 550));
        $this->assertTrue($text->hasWrap());
    }

    public function testGetStreamWithRotation1()
    {
        $text = new Text('Hello World', 12);
        $text->setRotation(40);
        $this->assertContains('MF1', $text->getStream('MF1 1 0 R', 20, 200));
    }

    public function testGetStreamWithRotation2()
    {
        $text = new Text('Hello World', 12);
        $text->setRotation(80);
        $this->assertContains('MF1', $text->getStream('MF1 1 0 R', 20, 200));
    }

    public function testGetStreamWithRotation3()
    {
        $text = new Text('Hello World', 12);
        $text->setRotation(-80);
        $this->assertContains('MF1', $text->getStream('MF1 1 0 R', 20, 200));
    }

}