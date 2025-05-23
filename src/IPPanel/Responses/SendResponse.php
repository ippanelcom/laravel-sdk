<?php

namespace Ippanel\Responses;

class SendResponse
{
    /**
     * Response data
     *
     * @var array|null
     */
    protected $data;

    /**
     * Meta information
     *
     * @var array
     */
    protected $meta;

    /**
     * Create a new SendResponse instance
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->data = $response['data'] ?? null;
        $this->meta = $response['meta'] ?? [];
    }

    /**
     * Get the response data
     *
     * @return array|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get the meta information
     *
     * @return array
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * Check if the request was successful
     *
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return isset($this->meta['status']) && $this->meta['status'] === true;
    }

    /**
     * Get the error message
     *
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->meta['message'] ?? null;
    }

    /**
     * Get the message code
     *
     * @return string|null
     */
    public function getMessageCode(): ?string
    {
        return $this->meta['message_code'] ?? null;
    }

    /**
     * Get the message parameters
     *
     * @return array
     */
    public function getMessageParameters(): array
    {
        return $this->meta['message_parameters'] ?? [];
    }
}

