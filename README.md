# Text
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

### Environment variables
<p>If the env method is available from your application you can set the env variables below...</p>

```
// TWILIO SPECIFIC SETTINGS
TWILIO_SID={sid_from_twilio}
TWILIO_TOKEN={token_from_twilio}
// may want to set the inbound number
TWILIO_INBOUND_NUMBER={number_that_captures_inbound_sms}
```

<p>If the env method is not available then the variables can be set, see example below:</p>

```
$text = Text::getDriver("twilio");
$text->setSid(***********);
$text->setToken(************);
// may want to set the inbound number
$text->setInboundNumber(************);
```

### Sending a SMS
<p>The following example shows how you can send a simple SMS</p>

```
$text = Text::getDriver("twilio");
$text->setBody('Lorem ipsum dolor sit amet, mnesarchum interpretaris vis eu.');
$text->setTo('+447*********');
$text->setFrom(env('TWILIO_NUMBER'));
$text->send();
```

### Sending a MMS
<p>The following example shows how you can can send a simple MMS</p>

```
$text = Text::getDriver("twilio");
$text->setBody('Lorem ipsum dolor sit amet, mnesarchum interpretaris vis eu.');
$text->setMedia('url_to_media');
$text->setTo('+447*********');
$text->setFrom(env('TWILIO_NUMBER'));
$text->send();
```

### Getting the inbound SMS
<p>To get all of the inbound texts sent to the twilio number</p>

```
$text = Text::getDriver("twilio");
$text->setBody('Lorem ipsum dolor sit amet, mnesarchum interpretaris vis eu.');
$text->setTo('+447*********');
$text->setFrom(env('TWILIO_NUMBER'));
$text->send();
```

## Built With
<ul>
    <li>PHP 7</li>
</ul>

## Versioning
<p>We use <a href="https://semver.org/spec/v1.0.0.html">Semantic Versioning 1.0.0</a>, for example v1.0.0.</p>

## Authors
<ul>
    <li>Sam Oliveri - Software Engineer</li>
</ul>

### License

Text is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).