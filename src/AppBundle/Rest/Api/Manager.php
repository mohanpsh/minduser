<?php

namespace AppBundle\Rest\Api;

use AppBundle\Rest\Error\Manager as ErrorManager;
use JMS\Serializer\Serializer;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use AppBundle\Events\Listener\PerformanceListener;

/**
 * Class Manager
 * @package Pim\ProductBundle\Api
 */
class Manager
{
    /**
     * @var array
     */
    private $setter;

    /**
     * @var ErrorManager
     */
    private $errorManager;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var PerformanceListener
     */
    private $performanceListener;

    /**
     * Manager constructor.
     * @param ErrorManager $errorManager
     * @param LoggerInterface $logger
     * @param Serializer $serializer
     * @param ValidatorInterface $validator
     * @param PerformanceListener $performanceListener
     */
    public function __construct(
        ErrorManager $errorManager,
        LoggerInterface $logger,
        Serializer $serializer,
        ValidatorInterface $validator,
        PerformanceListener $performanceListener
    ) {
        $this->errorManager = $errorManager;
        $this->logger = $logger;
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->performanceListener = $performanceListener;
    }

    /**
     * @return ErrorManager
     */
    public function errorManager()
    {
        return $this->errorManager;
    }

    /**
     * @return LoggerInterface
     */
    public function logger()
    {
        return $this->logger;
    }

    /**
     * @return Serializer
     */
    public function serializer()
    {
        return $this->serializer;
    }

    /**
     * @return Response\Index
     */
    public function response(){
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = new Response\Index($this->serializer, $this->performanceListener);
        }
        return $this->setter[__FUNCTION__];
    }

    /**
     * @return Format\Index
     */
    public function format(){
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = new Format\Index();
        }
        return $this->setter[__FUNCTION__];
    }

    /**
     * @return Validator\Index
     */
    public function validator()
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = new Validator\Index($this->validator);
        }
        return $this->setter[__FUNCTION__];
    }

    /**
     * @return Mapper\Index
     */
    public function mapper()
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = new Mapper\Index();
        }
        return $this->setter[__FUNCTION__];
    }
}
