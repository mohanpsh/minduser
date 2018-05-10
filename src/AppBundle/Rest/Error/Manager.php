<?php

namespace AppBundle\Rest\Error;

use AppBundle\Rest\Error\Model\Response as ErrorResponseModel;
use AppBundle\Rest\Error\Model\Error as ErrorModel;
use JMS\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Events\Listener\PerformanceListener;

/**
 * Class Manager
 * @package AppBundle\Rest\Error
 */
class Manager
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var PerformanceListener
     */
    private $performanceListener;

    /**
     * Manager constructor.
     * @param Serializer $serializer
     * @param PerformanceListener $performanceListener
     */
    public function __construct(Serializer $serializer, PerformanceListener $performanceListener)
    {
        $this->serializer = $serializer;
        $this->performanceListener = $performanceListener;
    }

    /**
     * @param ErrorResponseModel $errorResponse
     * @param string $format
     * @return JsonResponse|Response
     */
    public function buildResponse(ErrorResponseModel $errorResponse, $format = 'json')
    {
        if ($format == "xml") {
            return $this->xmlResponse($errorResponse);
        }
        return $this->jsonResponse($errorResponse);
    }


    /**
     * @param ErrorResponseModel $errorResponse
     * @return JsonResponse
     */
    public function jsonResponse(ErrorResponseModel $errorResponse): JsonResponse
    {

        $jsonResponse = new JsonResponse();
        $jsonResponse->setStatusCode($errorResponse->getCode());
        //add time
        $errorResponse->setScriptTimeSeconds($this->performanceListener->getScriptSeconds());
        $jsonContent = $this->serializer->serialize($errorResponse, 'json');
        $jsonResponse->setContent($jsonContent);
        return $jsonResponse;
    }

    /**
     * @param ErrorResponseModel $errorResponse
     * @return Response
     */
    public function xmlResponse(ErrorResponseModel $errorResponse): Response
    {

        $xmlResponse = new Response();
        $xmlResponse->setStatusCode($errorResponse->getCode());
        $xmlResponse->headers->set('Content-Type', 'text/xml');
        //add time
        $errorResponse->setScriptTimeSeconds($this->performanceListener->getScriptSeconds());
        $xmlContent = $this->serializer->serialize($errorResponse, 'xml');
        $xmlResponse->setContent($xmlContent);

        return $xmlResponse;
    }

    /**
     * @return ErrorResponseModel
     */
    public function errorResponse()
    {
        return new ErrorResponseModel();
    }

    /**
     * @return ErrorModel
     */
    public function error()
    {
        return new ErrorModel();
    }
}
