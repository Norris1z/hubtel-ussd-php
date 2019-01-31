<?php

use Hubtel\USSD\Request;
use Hubtel\USSD\USSD;

class USSDTest extends PHPUnit\Framework\TestCase{

    public $request;

    public function setUp()
    {
        $this->request = new Request(["Mobile"=>"2331234567","SessionId"=>"8883ba8b1e7348b8b566b4b3396575c2",
          "ServiceCode"=>"712","Type"=>"Initiation","Message"=>"1","Operator"=>"mtn","Sequence"=>"1","ClientState"=>"hello Norris"]);

        parent::setUp();
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     **/
    public function it_throws_an_exception_when_an_empty_array_of_seqeunces_is_passed_as_a_second_parameter_to_process() {
        USSD::process($this->request,[]);
    }

    /**
     * @test
     * @expectedException UnexpectedValueException
     **/
    public function it_throws_an_exception_when_the_values_in_the_array_do_not_implement_the_sequence_interface() {
        USSD::process($this->request,[new stdClass()]);
    }

    /**
     * @test
     * @expectedException UnexpectedValueException
     **/
    public function it_throws_an_exception_when_the_sequence_does_not_return_an_instance_of_response() {
        USSD::process($this->request,[
           new class implements \Hubtel\USSD\SequenceInterface {
               public function handle(Request $request)
               {
                   return "I would cause an exception to be thrown";
               }
           }
        ]);
    }
    
    /** @test **/
    public function it_returns_a_valid_response() {
        $response = USSD::process($this->request,[
           new class implements \Hubtel\USSD\SequenceInterface{

               public function handle(Request $request)
               {
                   return \Hubtel\USSD\Response::createInstance("Welcome to Volatile",\Hubtel\USSD\RequestTypes::RESPONSE,"Some Info");
               }
           }
        ]);

        $this->assertEquals($response->getMessage(),"Welcome to Volatile");
        $this->assertEquals($response->getType(),\Hubtel\USSD\RequestTypes::RESPONSE);
        $this->assertEquals($response->getClientState(),"Some Info");
    }

    /** @test **/
    public function it_can_return_the_response_as_an_array() {
        $response = USSD::process($this->request,[
            new class implements \Hubtel\USSD\SequenceInterface{

                public function handle(Request $request)
                {
                    return \Hubtel\USSD\Response::createInstance("Welcome to Volatile",\Hubtel\USSD\RequestTypes::RESPONSE,"Some Info");
                }
            }
        ]);

        $this->assertTrue(is_array($response->toArray()));
    }

    /** @test **/
    public function it_can_return_the_response_as_json() {
        $response = USSD::process($this->request,[
            new class implements \Hubtel\USSD\SequenceInterface{

                public function handle(Request $request)
                {
                    return \Hubtel\USSD\Response::createInstance("Welcome to Volatile",\Hubtel\USSD\RequestTypes::RESPONSE,"Some Info");
                }
            }
        ]);

        $this->assertTrue($this->is_json($response->toJson()));
    }

    public function is_json($value = null) {
        $ret = true;

        if(null === @json_decode($value)){
            $ret = false;
        }

        return $ret;
    }

    /** @test */
    public function it_returns_a_something_went_wrong_response_if_the_sequence_from_the_request_is_not_numeric() {
        $this->request->setSequence("some string sequence");
        $response = USSD::process($this->request,[
            new class implements \Hubtel\USSD\SequenceInterface{

                public function handle(Request $request)
                {
                    return \Hubtel\USSD\Response::createInstance("Welcome to Volatile",\Hubtel\USSD\RequestTypes::RESPONSE,"Some Info");
                }
            }
        ]);
        $this->assertEquals($response->getMessage(),"Sorry!. Something went wrong");
        $this->assertEquals($response->getType(),\Hubtel\USSD\RequestTypes::RELEASE);
    }

    /** @test */
    public function it_returns_a_something_went_wrong_response_if_the_sequence_is_not_in_the_array() {
        $this->request->setSequence("some invalid sequence");
        $response = USSD::process($this->request,[
            new class implements \Hubtel\USSD\SequenceInterface{

                public function handle(Request $request)
                {
                    return \Hubtel\USSD\Response::createInstance("Welcome to Volatile",\Hubtel\USSD\RequestTypes::RESPONSE,"Some Info");
                }
            }
        ]);
        $this->assertEquals($response->getMessage(),"Sorry!. Something went wrong");
        $this->assertEquals($response->getType(),\Hubtel\USSD\RequestTypes::RELEASE);
    }
}