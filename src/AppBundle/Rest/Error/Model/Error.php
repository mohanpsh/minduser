<?php

namespace AppBundle\Rest\Error\Model;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Error
 * @package AppBundle\Rest\ErrorModel
 */
class Error
{
    /**
     * @var integer
     * @Serializer\SerializedName("code")
     * @Serializer\Type("integer")
     */
    private $code;

    /**
     * @var string
     * @Serializer\SerializedName("status")
     * @Serializer\Type("string")
     */
    private $status;

    /**
     * @var string
     * @Serializer\SerializedName("message")
     * @Serializer\Type("string")
     */
    private $message;

    /**
     * @Serializer\Exclude()
     * @var array
     */
    private $codeToStatus = [
        200 => 'OK',
        201 => 'Created',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Access Denied'
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
    public function setCode(int $code): Error
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
     * @param string $status
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
}