<?php

class ArrayDividerServiceTest extends \PHPUnit\Framework\TestCase
{
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new \App\Service\ArrayDivider\ArrayDividerService();
    }

    public function testSuccessResult()
    {
        $this->assertEquals($this->service->divide(5, [5, 5, 1, 7, 2, 3, 5]), 4);
        $this->assertEquals($this->service->divide(3, [3, 3, 1, 7, 2, 1, 3]), 4);
        $this->assertEquals($this->service->divide(3, [2, 2, 3, 1, 2]), 4);
        $this->assertEquals($this->service->divide(2, [2, 2, 3, 1, 2]), 2);
        $this->assertEquals($this->service->divide(1, [1, 0]), 1);
    }

    public function testErrorEmptyHaystack()
    {
        $this->assertEquals($this->service->divide(1, []), -1);
    }

    public function testErrorHaystackNotContainNeedle()
    {
        $this->assertEquals($this->service->divide(2, [5, 5]), -1);
    }

    public function testErrorHaystackNotContainNeedleInRightSide()
    {
        $this->assertEquals($this->service->divide(4, [1, 4]), -1);
    }

    public function testErrorHaystackNotFull()
    {
        $this->assertEquals($this->service->divide(2, [1]), -1);
    }
}