<?php

use Hubtel\USSD\RequestTypes;
use Hubtel\USSD\Response;

class ResponseTest extends PHPUnit\Framework\TestCase
{

    /** @test * */
    public function it_default_constructs_all_parameters_to_null()
    {
        $HubtelResponse = new Response();

        $this->assertEquals($HubtelResponse->getMessage(), null);
        $this->assertEquals($HubtelResponse->getType(), null);
        $this->assertEquals($HubtelResponse->getClientState(), null);
    }

    /** @test */
    public function it_can_construct_using_parameters_passed_to_its_constructor()
    {
        $HubtelResponse = new Response("Welcome JabClari", RequestTypes::RESPONSE, "JabClari");

        $this->assertEquals($HubtelResponse->getMessage(), "Welcome JabClari");
        $this->assertEquals($HubtelResponse->getType(), RequestTypes::RESPONSE);
        $this->assertEquals($HubtelResponse->getClientState(), "JabClari");
    }

    /** @test * */
    public function it_can_set_methods_using_the_setters()
    {
        $HubtelResponse = new Response();
        $HubtelResponse->setMessage("Welcome JabClari");
        $HubtelResponse->setType(RequestTypes::RESPONSE);
        $HubtelResponse->setClientState("JabClari");

        $this->assertEquals($HubtelResponse->getMessage(),"Welcome JabClari");
        $this->assertEquals($HubtelResponse->getType(),RequestTypes::RESPONSE);
        $this->assertEquals($HubtelResponse->getClientState(),"JabClari");
    }
}