<?php

class ConverterTest extends \PHPUnit\Framework\TestCase
{
    public function testHaystackNullInput()
    {
        $this->assertEquals(\App\Converter\FormatConverter::stringHaystackToArray(null), []);
    }

    public function testHaystackEmptyString()
    {
        $this->assertEquals(\App\Converter\FormatConverter::stringHaystackToArray(''), []);
    }

    public function testSuccessOne()
    {
        $this->assertEquals(\App\Converter\FormatConverter::stringHaystackToArray('0'), [0]);
    }

    public function testSuccessMany()
    {
        $this->assertEquals(\App\Converter\FormatConverter::stringHaystackToArray('0,1,3,4'), [0, 1, 3, 4]);
    }

    public function testExtraSpaces()
    {
        $this->assertEquals(\App\Converter\FormatConverter::stringHaystackToArray(' 0,1,3,4 '), [0, 1, 3, 4]);
    }

    public function testExtraExtraSpaces()
    {
        $this->assertEquals(\App\Converter\FormatConverter::stringHaystackToArray(' 0,  1, 3,     4 '), [0, 1, 3, 4]);
    }

    public function testDelemeter()
    {
        $this->assertEquals(\App\Converter\FormatConverter::stringHaystackToArray('0|1|3|4', '|'), [0, 1, 3, 4]);
    }
}