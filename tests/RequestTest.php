<?php

use Hubtel\USSD\Request;

class RequestTest extends PHPUnit\Framework\TestCase{
  /** @test **/
  public function it_default_constructs_all_parameters_to_null_when_none_is_passed() {
      $request = new Request();
      $this->assertNull($request->getMobile());
      $this->assertNull($request->getType());
      $this->assertNull($request->getClientState());
      $this->assertNull($request->getOperator());
      $this->assertNull($request->getSequence());
      $this->assertNull($request->getServiceCode());
      $this->assertNull($request->getSessionId());
      $this->assertNull($request->getMessage());
  }

  /** @test **/
  public function it_can_construct_using_parameters_passed_to_its_constructor() {
       $HubtelRequest = new Request("2331234567","8883ba8b1e7348b8b566b4b3396575c2",
          "712","Initiation","1","mtn","1","hello Norris");

        $this->assertEquals($HubtelRequest->getMobile(),"2331234567");
        $this->assertEquals($HubtelRequest->getSessionId(),"8883ba8b1e7348b8b566b4b3396575c2");
        $this->assertEquals($HubtelRequest->getServiceCode(),"712");
        $this->assertEquals($HubtelRequest->getType(),"Initiation");
        $this->assertEquals($HubtelRequest->getMessage(),"1");
        $this->assertEquals($HubtelRequest->getOperator(),"mtn");
        $this->assertEquals($HubtelRequest->getSequence(),"1");
        $this->assertEquals($HubtelRequest->getClientState(),"hello Norris");
  }

  /** @test **/
  public function it_can_set_methods_using_the_setters() {
      $HubtelRequest = new Request();

      $HubtelRequest->setMobile("2331234567");
      $HubtelRequest->setSessionId("8883ba8b1e7348b8b566b4b3396575c2");
      $HubtelRequest->setServiceCode("712");
      $HubtelRequest->setType("Initiation");
      $HubtelRequest->setMessage("1");
      $HubtelRequest->setOperator("mtn");
      $HubtelRequest->setSequence("1");
      $HubtelRequest->setClientState("hello Norris");

      $this->assertEquals($HubtelRequest->getMobile(),"2331234567");
      $this->assertEquals($HubtelRequest->getSessionId(),"8883ba8b1e7348b8b566b4b3396575c2");
      $this->assertEquals($HubtelRequest->getServiceCode(),"712");
      $this->assertEquals($HubtelRequest->getType(),"Initiation");
      $this->assertEquals($HubtelRequest->getMessage(),"1");
      $this->assertEquals($HubtelRequest->getOperator(),"mtn");
      $this->assertEquals($HubtelRequest->getSequence(),"1");
      $this->assertEquals($HubtelRequest->getClientState(),"hello Norris");
  }
}