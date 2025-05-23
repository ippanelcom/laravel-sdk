<?php

namespace Ippanel\Requests;

class VOTPRequest
{
    /**
     * The OTP code
     *
     * @var int
     */
    protected $code;

    /**
     * The recipient number
     *
     * @var string
     */
    protected $recipient;

    /**
     * Create a new VOTPRequest instance
     *
     * @param int $code
     * @param string $recipient
     */
    public function __construct(int $code, string $recipient)
    {
        $this->code = $code;
        $this->recipient = $recipient;
    }

    /**
     * Convert the request to array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'message' => (string) $this->code,
            'sending_type' => 'votp',
            'params' => [
                'recipients' => [$this->recipient]
            ]
        ];
    }
}

