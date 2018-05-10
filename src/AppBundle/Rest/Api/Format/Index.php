<?php

namespace AppBundle\Rest\Api\Format;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class Index
 * @package AppBundle\Rest\Api\Format
 */
class Index
{
    /**
     * @param Request $request
     * @return string
     */
    public function requestFormat(Request $request) : string{
        return preg_match('/\.xml/i', $request->getUri()) ? 'xml' : 'json';
    }
}
