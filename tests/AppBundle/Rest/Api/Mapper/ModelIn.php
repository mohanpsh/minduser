<?php

namespace Tests\AppBundle\Rest\Api\Mapper;

/**
 * Class ModelIn
 * @package Tests\AppBundle\Rest\Api\Mapper
 */
class ModelIn
{
    /**
     * @var boolean
     */
    private $checkBool = true;

    /**
     * @var array
     */
    private $checkArray = [];

    /**
     * @var string
     */
    private $checkString = "";

    /**
     * @var integer
     */
    private $checkInteger = 0;

    /**
     * @return bool
     */
    public function isCheckBool(): bool
    {
        return $this->checkBool;
    }

    /**
     * @param bool $checkBool
     * @return ModelIn
     */
    public function setCheckBool(bool $checkBool): ModelIn
    {
        $this->checkBool = $checkBool;
        return $this;
    }

    /**
     * @return array
     */
    public function getCheckArray(): array
    {
        return $this->checkArray;
    }

    /**
     * @param array $checkArray
     * @return ModelIn
     */
    public function setCheckArray(array $checkArray): ModelIn
    {
        $this->checkArray = $checkArray;
        return $this;
    }

    /**
     * @return string
     */
    public function getCheckString(): string
    {
        return $this->checkString;
    }

    /**
     * @param string $checkString
     * @return ModelIn
     */
    public function setCheckString(string $checkString): ModelIn
    {
        $this->checkString = $checkString;
        return $this;
    }

    /**
     * @return int
     */
    public function getCheckInteger(): int
    {
        return $this->checkInteger;
    }

    /**
     * @param int $checkInteger
     * @return ModelIn
     */
    public function setCheckInteger(int $checkInteger): ModelIn
    {
        $this->checkInteger = $checkInteger;
        return $this;
    }
}
