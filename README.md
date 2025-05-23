# IPPanel Laravel SDK

A Laravel package for integrating with the IPPanel SMS API.

## Installation

You can install the package via composer:

```bash
composer require ippanel/laravel-sdk
```

### Laravel without auto-discovery

If you're using Laravel without auto-discovery, add the service provider to your `config/app.php` file:

```php
'providers' => [
    // ...
    Ippanel\IppanelServiceProvider::class,
],

'aliases' => [
    // ...
    'IPPanel' => Ippanel\Facades\IPPanel::class,
],
```

### Publish the configuration

Publish the configuration file using the following command:

```bash
php artisan vendor:publish --provider="Ippanel\IppanelServiceProvider" --tag="config"
```

This will create a `config/ippanel.php` file in your project where you can modify the configuration.

## Configuration

Add your IPPanel credentials to your `.env` file:

```
IPPANEL_API_KEY=your-api-key
```

Optionally, you can override the base URL:

```
IPPANEL_BASE_URL=https://custom-url.com/v1/api
```

## Usage

### Send a simple message (Webservice)

```php
use Ippanel\Client;

public function sendSMS(Client $ippanel)
{
    $response = $ippanel->sendWebservice(
        'Your message content', 
        '+981000xxxx', // Sender number
        ['+989123456789', '+989987654321'] // Recipients
    );

    if ($response->isSuccessful()) {
        // Message sent successfully
        $data = $response->getData();
        // Process data...
    } else {
        // Handle error
        $error = $response->getMessage();
    }
}
```

### Send a pattern message

```php
use Ippanel\Client;

public function sendPattern(Client $ippanel)
{
    $response = $ippanel->sendPattern(
        'pattern-code',  // Your pattern code
        '+981000xxxx',   // Sender number
        '+989123456789', // Recipient
        ['name' => 'John', 'code' => '12345'] // Pattern parameters
    );

    if ($response->isSuccessful()) {
        // Pattern message sent successfully
        $data = $response->getData();
        // Process data...
    } else {
        // Handle error
    }
}
```

### Send a Voice OTP

```php
use Ippanel\Client;

public function sendVoiceOTP(Client $ippanel)
{
    $response = $ippanel->sendVOTP(
        12345, // OTP code
        '+989123456789' // Recipient
    );

    if ($response->isSuccessful()) {
        // Voice OTP sent successfully
        $data = $response->getData();
        // Process data...
    } else {
        // Handle error
    }
}
```

## Response Structure

Each API call returns a `SendResponse` object with the following methods:

- `isSuccessful()`: Returns whether the request was successful.
- `getData()`: Returns the data part of the response.
- `getMeta()`: Returns the meta information of the response.
- `getMessage()`: Returns the message part of the meta.
- `getMessageCode()`: Returns the message code.
- `getMessageParameters()`: Returns the message parameters.

## License

MIT

