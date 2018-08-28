# Messaging
Sends text messages to a provider specified.

The default driver is set to Twilio which will expand eventually to pull in other services.

### Usage
<p>Pull in the composer package by running the command below:</p>

```
composer require oliveris/text
```

<p>Import the Text namespace into the class (autoloading)</p>

```
use Text\Text;
```

## Examples
<p>The following example shows how you can send a simple SMS.</p>

```
$text = Text::getDriver("twilio");
$text->setBody('Lorem ipsum dolor sit amet, mnesarchum interpretaris vis eu.');
$text->setTo('+447*********');
$text->setFrom(env('TWILIO_NUMBER'));
$text->send();
```

<p>To get all of the inbound texts sent to the twilio number</p>

```
$text = Text::getDriver("twilio");
$text->setBody('Lorem ipsum dolor sit amet, mnesarchum interpretaris vis eu.');
$text->setTo('+447*********');
$text->setFrom(env('TWILIO_NUMBER'));
$text->send();
```