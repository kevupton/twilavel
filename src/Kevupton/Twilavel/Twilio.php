<?php

namespace Kevupton\Twilavel;

use Kevupton\Twilavel\Messages\Message;
use Twilio\Rest\Client;

class Twilio {

    /**
     * @var Client
     */
    private $client;

    /**
     * Gets the client or sets a new client
     *
     * @return Client
     */
    public function client () {
        return $this->client?: $this->client = new Client(lt_sid(), lt_token());
    }

    /**
     * Sends the message
     * @param Message $message
     * @return \Twilio\Rest\Api\V2010\Account\MessageInstance
     */
    public function message (Message $message) {
        $data = [
            'from' => $message->from,
            'body' => $message->getBody(),
            'to' => $message->to
        ];

        // log if we are overriding sending messages
        if (lt_log_override()) {
            lt_log($data);
            return null;
        }

        // make sure we have all the data
        \Validator::validate($data, [
           'from' => 'required|string|min:1',
           'to' => 'required|string|min:1'
        ]);

        // sends the message using the twilio service
        return $this->client()->messages->create($message->to, [
            'from' => $message->from,
            'body' => $message->getBody()
        ]);
    }
}