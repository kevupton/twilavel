<?php

namespace Kevupton\Twilavel\Messages;

class BasicMessage extends Message {

    /** @var string|null the body content message */
    public $body;

    /**
     * BasicMessage constructor.
     * @param null|string $to who the message is to
     * @param null|string $body the body content message
     * @param null|string $from who the message is from. Can be string or number
     */
    public function __construct($to = null, $body = null, $from = null)
    {
        parent::__construct($to, $from);
        $this->body = $body;
    }

    /**
     * Gets the body content of the message
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }
}