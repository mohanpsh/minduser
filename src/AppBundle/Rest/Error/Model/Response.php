<?php

namespace AppBundle\Rest\Error\Model;

use JMS\Serializer\Annotation as Serializer;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Response
 * @package AppBundle\Rest\ErrorModel
 */
class Response
{
    /**
     * @var integer
     * @Serializer\SerializedName("code")
     * @Serializer\Type("integer")
     */
    private $code = 400;

    /**
     * @var string
     * @Serializer\SerializedName("status")
     * @Serializer\Type("string")
     */
    private $status;

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
     * @Serializer\Type("ArrayCollection<AppBundle\Rest\Error\Model\Error>")
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
        401 => 'Unauthorized',
        403 => 'Access Denied',
        500 => 'Internal Server Error'
    ];

    /**
     * @Serializer\Exclude()
     * @var bool
     */
    private $hasErrors = false;

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return Response
     */
    public function setCode(int $code): Response
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
     * @return Response
     */
    private function setStatus(string $status): Response
    {
        $this->status = $status;
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
     * @return Response
     */
    public function setDate(\DateTime $date): Response
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
     * @return Response
     */
    public function setScriptTimeSeconds(float $scriptTimeSeconds): Response
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
     * @return Response
     */
    public function addError(Error $error): Response
    {
        if((int)$this->getCode() < (int)$error->getCode()){
            $this->setCode($error->getCode());
        }

        $this->hasErrors = true;

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
    public function getCurrentDate(): \DateTime
    {
        if (null === $this->date) {
            return new \DateTime();
        }
        return $this->date;
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return $this->hasErrors;
    }
}
