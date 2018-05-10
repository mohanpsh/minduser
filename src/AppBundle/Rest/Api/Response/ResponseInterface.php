<?php

namespace AppBundle\Rest\Api\Response;

/**
 * Interface ResponseInterface
 * @package AppBundle\Rest\Api\Response
 */
interface ResponseInterface{

    /**
     * @return integer
     */
    public function getCode();

    /**
     * @param float $time
     * @return self
     */
    public function setScriptTimeSeconds(float $time);
}
