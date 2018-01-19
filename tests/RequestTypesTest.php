<?php

use Hubtel\USSD\RequestTypes;

class RequestTypesTest extends PHPUnit\Framework\TestCase{

    /** @test **/
    public function it_returns_a_response_string() {
        $this->assertEquals(RequestTypes::RESPONSE,'Response');
    }

    /** @test **/
    public function it_returns_an_initiation_string() {
        $this->assertEquals(RequestTypes::INITIATION,'Initiation');
    }

    /** @test **/
    public function it_returns_a_release_string() {
        $this->assertEquals(RequestTypes::RELEASE,'Release');
    }
}