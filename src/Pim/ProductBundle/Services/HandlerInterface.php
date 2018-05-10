<?php

namespace Pim\ProductBundle\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface HandlerInterface
 * @package Pim\ProductBundle\Services
 */
interface HandlerInterface
{
    /**
     * @param Request $request
     * @return Response
     */
    public function handleRestRequest(Request $request);
}
