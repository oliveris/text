<?php

namespace Text;

use Text\Driver\Twilio;

abstract class Text
{
    protected $sid;

    protected $token;

    protected $settings;

    protected $to;

    protected $body;

    protected $from;

    protected $media;

    const DEFAULT_DRIVER = 'twilio';

    /**
     * - <b>getDriver()</b>
     * -----------------------------------------------------------
     *
     * This method returns the driver dependant on $driver it checks the driver is allowed and return the class
     *
     * @param string $driver The name of the driver for the sending the mail
     *
     * @return Text The text class of the correct driver
     * @throws Exception\Notify
     */
    public static function getDriver(string $driver = self::DEFAULT_DRIVER): Text
    {
        $driver = strtolower((string)$driver);
        switch ($driver) {
            case 'twilio':
                return new Twilio();
            default:
                throw new Exception\Notify("The mail driver {$driver} is not authorised");
        }
    }

    /**
     * - <b>setID()</b>
     * -----------------------------------------------------------
     *
     * This method sets the $sid and returns the $sid
     *
     * @param string $value
     *
     * @return string
     * @throws Exception\Notify
     */
    public function setSid(string $value): string
    {
        if (!empty($value)) {
            $this->sid = $value;
            return $this->sid;
        } else {
            throw new Exception\Notify("The sid has not been set");
        }
    }

    /**
     * - <b>setToken()</b>
     * -----------------------------------------------------------
     *
     * This method sets the token and returns the $token
     *
     * @param string $value
     *
     * @return string
     * @throws Exception\Notify
     */
    public function setToken(string $value): string
    {
        if (!empty($value)) {
            $this->token = $value;
            return $this->token;
        } else {
            throw new Exception\Notify("The token has not been set");
        }
    }

    /**
     * - <b>getDriverSettings()</b>
     * -----------------------------------------------------------
     *
     * This method is used to obtain the driver settings
     * Use case is if the method env is not available then
     * these settings can be manually set
     *
     * @param string $driver
     * @return array $settings
     */
    public function getDriverSettings(string $driver): array
    {
        $this->driver_settings = [];

        switch ($driver) {
            case 'twilio':
                $this->settings['sid']   = $this->sid;
                $this->settings['token'] = $this->token;
                break;
            default:
                throw new Exception\Notify("Cannot get the settings for {$driver} driver");
        }

        return $this->settings;
    }

    /**
     * - <b>setBody()</b>
     * -----------------------------------------------------------
     *
     * This method sets $body and returns $body
     *
     * @param string $value The message body
     *
     * @return string The message body
     * @throws Exception\Notify
     */
    public function setBody(string $value = ""): string
    {
        if (!empty($value)) {
            $this->body = nl2br($value);
            return $this->body;
        } else {
            throw new Exception\Notify("The message has not been set");
        }
    }

    /**
     * - <b>setFrom()</b>
     * -----------------------------------------------------------
     *
     * This method sets $from and returns $from
     *
     * @param string $value The message body
     *
     * @return string The $from number
     * @throws Exception\Notify
     */
    public function setFrom(string $value = ""): string
    {
        if (preg_match("/^\+?\d{1,15}$/Ui", $value)) {
            $this->from = $value;
            return $this->from;
        } else {
            throw new Exception\Notify("The from number {$value} is not a valid from number");
        }
    }

    /**
     * - <b>setTo()</b>
     * -----------------------------------------------------------
     *
     * This method sets $to and returns $to
     *
     * @param string $value The to number
     *
     * @return string The to number
     * @throws Exception\Notify
     */
    public function setTo(string $value = ""): string
    {
        if (preg_match("/^\+?\d{1,15}$/Ui", $value)) {
            $this->to = $value;
            return $this->to;
        } else {
            throw new Exception\Notify("The to number {$value} is not a valid mobile number");
        }
    }

    /**
     * - <b>setMedia()</b>
     * -----------------------------------------------------------
     *
     * This method sets $media and returns $media
     *
     * @param string $value
     * @return string The Media URL
     * @throws Exception\Notify
     */
    public function setMedia(string $value = ""): string
    {
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            $this->media = $value;
            return $this->media;
        } else {
            throw new Exception\Notify("The Media has not been set");
        }
    }

    /**
     * - <b>compose()</b>
     * -----------------------------------------------------------
     *
     * This method sets composes the sms from all the setters and returns an array of the
     * items needed to send the message
     *
     * @return array The message
     * @throws Exception\Notify
     */
    public function compose(): array
    {
        if (isset($this->to, $this->body, $this->from)) {
            return [
                'from'   => $this->from,
                'to'     => $this->to,
                'body'   => $this->body,
                'media'  => $this->media
            ];
        } else {
            throw new Exception\Notify("To send a Text to, body and from must be set");
        }
    }

    abstract public function send(): bool;

    abstract public function getInboundTexts(): array;
}
