<?php

namespace Ippanel;

use GuzzleHttp\Client as HttpClient;
use Ippanel\Requests\PatternRequest;
use Ippanel\Requests\WebserviceRequest;
use Ippanel\Requests\VOTPRequest;
use Ippanel\Responses\SendResponse;

class Client
{
    /**
     * API Key for authentication
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Base URL for the API
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * HTTP Client
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * Default base URL for the API
     */
    const DEFAULT_BASE_URL = 'https://edge.ippanel.com/v1/api';

    /**
     * Create a new IPPanel Client instance.
     *
     * @param string $apiKey
     * @param string|null $baseUrl
     */
    public function __construct(string $apiKey, ?string $baseUrl = null)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl ?: self::DEFAULT_BASE_URL;
        $this->httpClient = new HttpClient([
            'timeout' => 10,
            'headers' => [
                'Authorization' => $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);
    }

    /**
     * Send a webservice SMS
     *
     * @param string $message The message content
     * @param string $sender Sender number
     * @param array $recipients List of recipient phone numbers
     * @return \Ippanel\Responses\SendResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendWebservice(string $message, string $sender, array $recipients): SendResponse
    {
        $request = new WebserviceRequest($message, $sender, $recipients);
        return $this->post('/send', $request->toArray());
    }

    /**
     * Send a pattern SMS
     *
     * @param string $patternCode The pattern code
     * @param string $sender Sender number
     * @param string $recipient Recipient phone number
     * @param array $params Pattern parameters
     * @return \Ippanel\Responses\SendResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendPattern(string $patternCode, string $sender, string $recipient, array $params = []): SendResponse
    {
        $request = new PatternRequest($patternCode, $sender, $recipient, $params);
        return $this->post('/send', $request->toArray());
    }

    /**
     * Send a Voice OTP message
     *
     * @param int $code The OTP code
     * @param string $recipient Recipient phone number
     * @return \Ippanel\Responses\SendResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendVOTP(int $code, string $recipient): SendResponse
    {
        $request = new VOTPRequest($code, $recipient);
        return $this->post('/send', $request->toArray());
    }

    /**
     * Send a POST request to the API
     *
     * @param string $path
     * @param array $payload
     * @return \Ippanel\Responses\SendResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function post(string $path, array $payload): SendResponse
    {
        $url = $this->baseUrl . $path;

        $response = $this->httpClient->post($url, [
            'json' => $payload
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        return new SendResponse($data);
    }
}

