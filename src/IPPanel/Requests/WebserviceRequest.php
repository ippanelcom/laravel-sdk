<?php

namespace Ippanel\Requests;

class WebserviceRequest
{
    /**
     * The message content
     *
     * @var string
     */
    protected $message;

    /**
     * The sender number
     *
     * @var string
     */
    protected $sender;

    /**
     * The recipients
     *
     * @var array
     */
    protected $recipients;

    /**
     * Create a new WebserviceRequest instance
     *
     * @param string $message
     * @param string $sender
     * @param array $recipients
     */
    public function __construct(string $message, string $sender, array $recipients)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->recipients = $recipients;
    }

    /**
     * Convert the request to array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'from_number' => $this->sender,
            'message' => $this->message,
            'sending_type' => 'webservice',
            'params' => [
                'recipients' => $this->recipients
            ]
        ];
    }
}

