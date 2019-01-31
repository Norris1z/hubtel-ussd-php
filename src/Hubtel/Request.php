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

    public function __construct($options = ["Mobile"=>null,"SessionId"=>null,"ServiceCode"=>null,"Type"=>null,"Message"=>null,"Operator"=>null,"Sequence"=>null,"ClientState"=>null])
    {
        $this->mobile = $options['Mobile'];
        $this->sessionId = $options['SessionId'];
        $this->serviceCode = $options['ServiceCode'];
        $this->type = $options['Type'];
        $this->message = $options['Message'];
        $this->operator = $options['Operator'];
        $this->sequence = $options['Sequence'];
        $this->clientState = $options['ClientState'];
    }

    public static function createInstance($options)
    {
        return new self($options);
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
