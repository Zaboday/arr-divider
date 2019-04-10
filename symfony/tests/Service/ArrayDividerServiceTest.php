<?php

class ArrayDividerServiceTest extends \PHPUnit\Framework\TestCase
{
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new \App\Service\ArrayDivider\ArrayDividerService();
    }

    public function testResultSuccess()
    {
        $this->assertEquals($this->service->divide(5, [5, 5, 1, 7, 2, 3, 5]), 4);
    }

    public function testResultImpossible()
    {
        $this->assertEquals($this->service->divide(5, []), -1);
    }
}