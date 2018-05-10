<?php

namespace Tests\AppBundle\Rest\Api\Mapper;

/**
 * Class ModelOut
 * @package Tests\AppBundle\Rest\Api\Mapper
 */
class ModelOut
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
     * @return ModelOut
     */
    public function setCheckBool(bool $checkBool): ModelOut
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
     * @return ModelOut
     */
    public function setCheckArray(array $checkArray): ModelOut
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
     * @return ModelOut
     */
    public function setCheckString(string $checkString): ModelOut
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
     * @return ModelOut
     */
    public function setCheckInteger(int $checkInteger): ModelOut
    {
        $this->checkInteger = $checkInteger;
        return $this;
    }
}
