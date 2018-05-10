<?php

namespace AppBundle\Rest\Api\Response;

use AppBundle\Events\Listener\PerformanceListener;
use JMS\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Index
 * @package AppBundle\Rest\Api\Response
 */
class Index
{
    /**
     * @var PerformanceListener
     */
    private $performanceListener;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * Index constructor.
     * @param Serializer $serializer
     * @param PerformanceListener $performanceListener
     */
    public function __construct(Serializer $serializer, PerformanceListener $performanceListener)
    {
        $this->performanceListener = $performanceListener;
        $this->serializer = $serializer;
    }

    /**
     * @param ResponseInterface $restResponse
     * @param string $format
     * @return JsonResponse|Response
     */
    public function buildResponse(ResponseInterface $restResponse, $format = 'json'){

        if ($format == "xml") {
            return $this->xmlResponse($restResponse);
        } else {
            return $this->jsonResponse($restResponse);
        }
    }

    /**
     * @param ResponseInterface $restResponse
     * @return JsonResponse
     */
    public function jsonResponse(ResponseInterface $restResponse): JsonResponse
    {
        $jsonResponse = new JsonResponse();
        $jsonResponse->setStatusCode($restResponse->getCode());
        //add time
        $restResponse->setScriptTimeSeconds($this->performanceListener->getScriptSeconds());
        $jsonContent = $this->serializer->serialize($restResponse, 'json');
        $jsonResponse->setContent($jsonContent);

        return $jsonResponse;
    }

    /**
     * @param ResponseInterface $restResponse
     * @return Response
     */
    public function xmlResponse(ResponseInterface $restResponse): Response
    {
        $xmlResponse = new Response();
        $xmlResponse->setStatusCode($restResponse->getCode());
        $xmlResponse->headers->set('Content-Type', 'text/xml');
        //add time
        $restResponse->setScriptTimeSeconds($this->performanceListener->getScriptSeconds());
        $xmlContent = $this->serializer->serialize($restResponse, 'xml');
        $xmlResponse->setContent($xmlContent);

        return $xmlResponse;
    }
}
