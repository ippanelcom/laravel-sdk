<?php

namespace Ippanel\Facades;

use Illuminate\Support\Facades\Facade;
use Ippanel\Client;

/**
 * @method static \Ippanel\Responses\SendResponse sendWebservice(string $message, string $sender, array $recipients)
 * @method static \Ippanel\Responses\SendResponse sendPattern(string $patternCode, string $sender, string $recipient, array $params = [])
 * @method static \Ippanel\Responses\SendResponse sendVOTP(int $code, string $recipient)
 *
 * @see \Ippanel\Client
 */
class IPPanel extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Client::class;
    }
}
