<?php

namespace Kevupton\Twilavel\Messages;

abstract class Message {

    /** @var string the phone number to send the address to */
    public $to;
    /** @var string who the message will be from */
    public $from;

    /**
     * Message constructor.
     * @param null|string $to who the message is to
     * @param null|string $from who the message is from. Can be string or number
     */
    public function __construct($to = null, $from = null)
    {
        $this->to = $to;
        $this->from = lt_from($from);
    }

    /**
     * Gets the body content of the message
     * @return string
     */
    public abstract function getBody();
}