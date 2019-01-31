<?php

namespace Hubtel\USSD;

class Response
{
    protected $message;
    protected $type;
    protected $clientState;
    protected $maskNextRoute;

    public function __construct($message = null, $type = null, $clientState = null, $maskNextRoute=false)
    {
        $this->message = $message;
        $this->type = $type;
        $this->clientState = $clientState;
        $this->maskNextRoute = $maskNextRoute;
    }

    public static function createInstance($message = null, $type = null, $clientState = null, $maskNextRoute=false)
    {
        return new self($message, $type, $clientState, $maskNextRoute);
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getClientState()
    {
        return $this->clientState;
    }

    public function setClientState($clientState)
    {
        $this->clientState = $clientState;
    }

    public function getMaskNextRoute()
    {
        return $this->maskNextRoute;
    }

    public function setMaskNextRoute($maskNextRoute)
    {
        $this->maskNextRoute = $maskNextRoute;
    }

    public function toJson()
    {
        return json_encode(["Message"=>$this->message,"Type"=>$this->type,"ClientState"=>$this->clientState,"MaskNextRoute"=>$this->maskNextRoute]);
    }

    public function toArray()
    {
        return ["Message"=>$this->message,"Type"=>$this->type,"ClientState"=>$this->clientState,"MaskNextRoute"=>$this->maskNextRoute];
    }
}
