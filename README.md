# Twilavel #
Implementation of Laravel / Lumen Twilio

### 1. Install Service Provider

```php
<?php
// add directly from the app 
$app->register(\Kevupton\LaravelTwilio\Providers\LaravelTwilioServiceProvider::class);
```

OR

All service providers are registered in the `config/app.php` configuration file.
```php
<?php

'providers' => [
    // Other Service Providers

    \Kevupton\LaravelTwilio\Providers\LaravelTwilioServiceProvider::class,
],
```

### 2. Configure

`.env` configuration
```text
TWILIO_LOG_OVERRIDE=false
TWILIO_TOKEN=your_token
TWILIO_SID=your_sid
TWILIO_FROM=SwagApp
```

*Execute `php artisan vendor:publish` for the complete config file.*

Config: `coinpayments.php`
```php
<?php

return array(

    // set to true to prevent the
    'log_override' => env('TWILIO_LOG_OVERRIDE', false),

    // Your Account SID and Auth Token from twilio.com/console
    'sid' => env('TWILIO_SID'),
    'token' => env('TWILIO_TOKEN'),

    // the default from which messages will be sent from
    'from' => env('TWILIO_FROM', 'Laravel Twilio'),
);

```


### 3. Usage

Using the Facade
```php
<?php 

\Twilio::message(new \Kevupton\LaravelTwilio\Messages\BasicMessage('+61 123 456 789', 'Custom Body', 'From'));

```

Using the helper functions
```php
<?php 

send_basic_message('+61 123 456 789', 'Custom Body', 'From');
```

Custom Message Example:
```php
<?php

namespace App\Twilio\Messages;

use \Kevupton\LaravelTwilio\Messages\Message;
use App\Models\User;

class VerifyPhone extends Message {

    const FROM = '+61123456789';

    /** @var string custom verification code */
    private $code;

    public function __construct(User $user, $mobile = null)
    {
        // use mobile other use user mobile
        $number = $mobile?: $user->mobile;
        parent::__construct($number, self::FROM);
        
        // get a random code
        $this->code = $user->generateMobileVerificationCode($number);
    }

    public function getBody()
    {
        return 'Your verification code: ' . $this->code;
    }
}
```

Using Custom Message:
```php
<?php

send_message(new VerifyPhone($user, '+61123456789'));
```

### 5. Logging

You can choose to override sending API requests for development environment and just view them in the Log. 
Simply just set `TWILIO_LOG_OVERRIDE=true` in your `.env`.

### Contributing

Feel free to make a pull request at any time. Any help is appreciated (Y)