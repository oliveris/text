<?php

namespace Text\Driver;

use Text\Text;
use Text\Exception;
use Twilio\Rest\Client;

class Twilio extends Text
{
    /**
     * - <b>sendSms()</b>
     * -----------------------------------------------------------
     *
     * This method attempts to send the sms message
     *
     * @throws Exception
     */
    public function send(): bool
    {
        if (!function_exists('env')) {
            $settings = $this->getDriverSettings('twilio');
        }

        $sid    = function_exists('env') ? env('TWILIO_SID') : $settings['sid'];
        $token  = function_exists('env') ? env('TWILIO_TOKEN') : $settings['token'];
        $client = new Client($sid, $token);

        $text = $this->compose();

        $send = [
            'from' => $text['from'],
            'body' => $text['body']
        ];

        if ($text['media'] != '') {
            $send['mediaURL'] = $text['media'];
        }

        try {
            $client->messages->create(
                $text['to'],
                $send
            );
            return true;
        } catch (Exception $e) {
            throw new Exception\Notify("Twilio Error:" . $e->getMessage());
        }
    }

    /**
     * - <b>getInboundTexts()</b>
     * -----------------------------------------------------------
     *
     * This method attempts to receive texts sent to a number on Twilio
     *
     * @return array
     * @throws Exception
     */
    public function getInboundTexts(): array
    {
        if (!function_exists('env')) {
            $settings = $this->getDriverSettings('twilio');
        }

        $sid    = function_exists('env') ? env('TWILIO_SID') : $settings['sid'];
        $token  = function_exists('env') ? env('TWILIO_TOKEN') : $settings['token'];
        $client = new Client($sid, $token);

        try {
            $messages = $client->messages->read([
                'To' => function_exists('env') ? env('TWILIO_INBOUND_NUMBER') : $settings['inbound_number'],
            ]);
            return $messages;
        } catch (Exception $e) {
            throw new Exception\Notify("Twilio Error:" . $e->getMessage());
        }
    }
}