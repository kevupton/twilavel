<?php

define('LARAVEL_TWILIO_CONFIG', 'twilio');

if (!function_exists('lt_log_override')) {
    function lt_log_override () {
        return trim(strtolower("" . lt_conf('log_override'))) === 'true';
    }
}

if (!function_exists('lt_conf')) {
    /**
     * Gets a config value from the config file.
     *
     * @param string $prop the key property
     * @param string $default the default response
     *
     * @return mixed
     */
    function lt_conf($prop, $default = '') {
        return config(LARAVEL_TWILIO_CONFIG . '.' . $prop, $default);
    }
}

if (!function_exists('lt_from')) {
    /**
     * Gets a config value from the config file.
     *
     * @param string $override the default response
     *
     * @return mixed
     */
    function lt_from($override = null) {
        return is_null($override) ? lt_conf('from') : $override;
    }
}

if (!function_exists('lt_sid')) {
    /**
     * Gets the token from the config file
     *
     * @param null $default
     * @return mixed
     */
    function lt_sid($default = null) {
        return lt_conf('sid', $default);
    }
}

if (!function_exists('lt_token')) {
    /**
     * Gets the token from the config file
     *
     * @param null $default
     * @return mixed
     */
    function lt_token($default = null) {
        return lt_conf('token', $default);
    }
}

if (!function_exists('lt_log')) {
    /**
     * Logs the request in the database
     *
     * @param mixed $message the message that is to be logged
     * @param string $level the level to log: emergency, alert, critical, error, warning, notice, info, debug
     */
    function lt_log($message, $level = 'info') {
        if (is_array($message) || is_object($message)) $message = json_encode($message, JSON_PRETTY_PRINT);
        \Log::$level("LARAVEL-TWILIO: $message");
    }
}

if (!function_exists('send_message')) {
    /**
     * Sends a message using the twilio service.
     *
     * @param \Kevupton\Twilavel\Messages\Message $message the message that is to be logged
     */
    function send_message(\Kevupton\Twilavel\Messages\Message $message) {
        \Twilio::message($message);
    }
}

if (!function_exists('send_basic_message')) {
    /**
     * Sends a message using the twilio service.
     *
     * @param $to
     * @param null|string $body
     * @param null|string $from
     */
    function send_basic_message($to, $body = null, $from = null) {
        return \Twilio::message(new \Kevupton\Twilavel\Messages\BasicMessage($to, $body, $from));
    }
}
