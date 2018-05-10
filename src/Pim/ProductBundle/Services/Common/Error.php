<?php

namespace Pim\ProductBundle\Services\Common;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Error
 * @package Pim\ProductBundle\Common
 */
final class Error
{
    /**
     * @Serializer\SerializedName("code")
     * @Serializer\Type("integer")
     * @var integer
     */
    private $code;

    /**
     * @Serializer\SerializedName("status")
     * @Serializer\Type("string")
     * @var string
     */
    private $status = "";

    /**
     * @Serializer\SerializedName("message")
     * @Serializer\Type("string")
     * @var string
     */
    private $message = "";

    /**
     * @Serializer\SerializedName("type")
     * @Serializer\Type("string")
     * @var string
     */
    private $type = "";

    /**
     * @Serializer\SerializedName("exception")
     * @Serializer\Type("string")
     * @var string
     */
    private $exception = "";

    /**
     * @Serializer\Exclude()
     * @var array
     */
    private $codeToStatus = [
        200 => 'OK',
        201 => 'Created',
        400 => 'Bad Request',
        404 => 'Not Found'
    ];

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return Error
     */
    public function setCode(int $code): self
    {
        $this->code = $code;
        if (array_key_exists($code, $this->codeToStatus)) {
            $this->setStatus($this->codeToStatus[$code]);
        } else {
            $this->setStatus('CodeNotFound');
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return Error
     */
    public function setStatus(string $status): Error
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Error
     */
    public function setMessage(string $message): Error
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Error
     */
    public function setType(string $type): Error
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getException(): string
    {
        return $this->exception;
    }

    /**
     * @param string $exception
     * @return Error
     */
    public function setException(string $exception): Error
    {
        $this->exception = $exception;
        return $this;
    }
}
