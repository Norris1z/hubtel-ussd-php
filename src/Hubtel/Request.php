<?php

namespace Hubtel\USSD;

class Request
{
    protected $mobile;
    protected $sessionId;
    protected $serviceCode;
    protected $type;
    protected $message;
    protected $operator;
    protected $sequence;
    protected $clientState;

    public function __construct($mobile = null, $sessionId = null, $serviceCode = null, $type = null, $message = null, $operator = null, $sequence = null, $clientState = null)
    {
        $this->mobile = $mobile;
        $this->sessionId = $sessionId;
        $this->serviceCode = $serviceCode;
        $this->type = $type;
        $this->message = $message;
        $this->operator = $operator;
        $this->sequence = $sequence;
        $this->clientState = $clientState;
    }

    public static function createInstance($mobile = null, $sessionId = null, $serviceCode = null, $type = null, $message = null, $operator = null, $sequence = null, $clientState = null)
    {
        return new self($mobile, $sessionId, $serviceCode, $type, $message, $operator, $sequence, $clientState);
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    public function getServiceCode()
    {
        return $this->serviceCode;
    }

    public function setServiceCode($serviceCode)
    {
        $this->serviceCode = $serviceCode;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getOperator()
    {
        return $this->operator;
    }

    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    public function getSequence()
    {
        return $this->sequence;
    }

    public function setSequence($sequence)
    {
        $this->sequence = $sequence;
    }

    public function getClientState()
    {
        return $this->clientState;
    }

    public function setClientState($clientState)
    {
        $this->clientState = $clientState;
    }
}
