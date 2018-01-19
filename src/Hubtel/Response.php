<?php

namespace Hubtel\USSD;

class Response
{
    protected $message;
    protected $type;
    protected $clientState;

    public function __construct($message = null, $type = null, $clientState = null)
    {
        $this->message = $message;
        $this->type = $type;
        $this->clientState = $clientState;
    }

    public static function createInstance($message = null, $type = null, $clientState = null)
    {
        return new self($message, $type, $clientState);
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

    public function toJson()
    {
        return json_encode(["Message"=>$this->message,"Type"=>$this->type,"ClientState"=>$this->clientState]);
    }

    public function toArray()
    {
        return ["Message"=>$this->message,"Type"=>$this->type,"ClientState"=>$this->clientState];
    }
}
