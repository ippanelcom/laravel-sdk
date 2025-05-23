<?php

namespace Ippanel\Requests;

class PatternRequest
{
    /**
     * The pattern code
     *
     * @var string
     */
    protected $patternCode;

    /**
     * The sender number
     *
     * @var string
     */
    protected $sender;

    /**
     * The recipient number
     *
     * @var string
     */
    protected $recipient;

    /**
     * The pattern parameters
     *
     * @var array
     */
    protected $params;

    /**
     * Create a new PatternRequest instance
     *
     * @param string $patternCode
     * @param string $sender
     * @param string $recipient
     * @param array $params
     */
    public function __construct(string $patternCode, string $sender, string $recipient, array $params = [])
    {
        $this->patternCode = $patternCode;
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->params = $params;
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
            'recipients' => [$this->recipient],
            'code' => $this->patternCode,
            'params' => $this->params,
            'sending_type' => 'pattern'
        ];
    }
}

