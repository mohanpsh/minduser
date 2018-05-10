<?php

namespace Pim\ProductBundle\Services\Common;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class ResponseHead
 * @Serializer\AccessorOrder("custom", custom={"code","status","message","date","scriptTimeSeconds","errors"})
 * @package Pim\ProductBundle\Common
 */
trait ResponseTrait
{
    /**
     * @var integer
     * @Serializer\SerializedName("code")
     * @Serializer\Type("integer")
     */
    private $code = 200;

    /**
     * @var string
     * @Serializer\SerializedName("status")
     * @Serializer\Type("string")
     */
    private $status = 'OK';

    /**
     * @var string
     * @Serializer\SerializedName("message")
     * @Serializer\Type("string")
     */
    private $message;

    /**
     * @var \DateTime
     * @Serializer\SerializedName("dateTime")
     * @Serializer\Type("DateTime")
     * @Serializer\Accessor(getter="getCurrentDate")
     */
    private $date;

    /**
     * @var double
     * @Serializer\SerializedName("scriptTimeSeconds")
     * @Serializer\Type("double")
     */
    private $scriptTimeSeconds;

    /**
     * @Serializer\SerializedName("errors")
     * @Serializer\Type("ArrayCollection<Pim\ProductBundle\Services\Common\Error>")
     * @Serializer\XmlList(entry="error")
     *
     * @var Error[]|ArrayCollection
     */
    private $errors;

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
     * @return ResponseTrait
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
     * @param string $status
     * @return ResponseTrait
     */
    private function setStatus(string $status): self
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
     * @return ResponseTrait
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return ResponseTrait
     */
    public function setDate(\DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return float
     */
    public function getScriptTimeSeconds(): float
    {
        return $this->scriptTimeSeconds;
    }

    /**
     * @param float $scriptTimeSeconds
     * @return ResponseTrait
     */
    public function setScriptTimeSeconds(float $scriptTimeSeconds): self
    {
        $this->scriptTimeSeconds = $scriptTimeSeconds;
        return $this;
    }

    /**
     * @return Error[]|ArrayCollection
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param Error $error
     * @return ResponseTrait
     */
    public function setError(Error $error): self
    {
        if (!$this->errors) {
            $this->errors = new ArrayCollection();
        }

        if (!$this->errors->contains($error)) {
            $this->errors->add($error);
        }

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCurrentDate()
    {
        if (null === $this->date) {
            return new \DateTime();
        }
        return $this->date;
    }
}
