<?php

namespace Pop\Pdf\Test\Document;

use Pop\Pdf\Document\Font;

class FontTest extends \PHPUnit_Framework_TestCase
{

    public function testSetFontException()
    {
        $this->setExpectedException('Pop\Pdf\Document\Exception');
        $font = new Font('BAD_FONT');
    }

    public function testGetFont()
    {
        $font = new Font('Arial');
        $this->assertEquals('Arial', $font->getFont());
    }

    public function testGetStandardFonts()
    {
        $font = new Font('Arial');
        $this->assertEquals(26, count($font->getStandardFonts()));
    }

}