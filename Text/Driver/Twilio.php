<?php

namespace Text\Driver;

use Text\Text;
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
        $sid = env('TWILIO_SID');

        $token = env('TWILIO_TOKEN');

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
            throw new \Exception("Twilio Error:" . $e->getMessage());
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
        $sid = env('TWILIO_SID');

        $token = env('TWILIO_TOKEN');

        $client = new Client($sid, $token);

        try {
            $messages = $client->messages->read(array(
                'To' => env('TWILIO_NUMBER'),
            ));
            return $messages;
        } catch (Exception $e) {
            throw new \Exception("Twilio Error:" . $e->getMessage());
        }
    }
}