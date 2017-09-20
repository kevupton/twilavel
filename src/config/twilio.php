<?php

return array(

    // set to true to prevent the
    'log_override' => env('TWILIO_LOG_OVERRIDE', false),

    // Your Account SID and Auth Token from twilio.com/console
    'sid' => env('TWILIO_SID'),
    'token' => env('TWILIO_TOKEN'),

    // the default from which messages will be sent from
    'from' => env('TWILIO_FROM', 'Twilavel'),

);
