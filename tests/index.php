<?php

include "../vendor/autoload.php";

use Text\Text;

$text = Text::getDriver("twilio");

$text->setSid('');
$text->setToken('');

$text->setBody('Lorem ipsum dolor sit amet, mnesarchum interpretaris vis eu.');
$text->setTo('');
$text->setFrom('');
$text->send();

echo 'Your SMS should be sent.';

echo '<br><hr><br>';

$text->setInboundNumber('');
echo 'Your inbound SMS messages are displayed below.';
echo '<pre>';
print_r($text->getInboundTexts());
echo '</pre>';