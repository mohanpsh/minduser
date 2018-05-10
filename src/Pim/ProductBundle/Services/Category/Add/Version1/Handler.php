<?php

/**
 * all code by me
 *
 * @copyright  Stefan H.G. Buchhofer
 * @version    Release: 1.0.0
 * @link       www.ilenvo-media.de
 * @email      ilenvo@me.com
 * @year       2017
 */

namespace Pim\ProductBundle\Services\Category\Add\Version1;

use Pim\ProductBundle\Exception\ProcessorException;
use Pim\ProductBundle\Services\HandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Rest\Api\Manager as ApiManager;
use Pim\ProductBundle\Services\Product\Add\Version1\Request\Request as RequestModel;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Handler
 * @package Pim\ProductBundle\Services\AddProduct\Version1
 */
class Handler implements HandlerInterface
{
    /**
     * @var ApiManager
     */
    private $apiM;

    /**
     * @var string
     */
    private $format;

    /**
     * @var \AppBundle\Rest\Error\Manager
     */
    private $errorManager;

    /**
     * @var \AppBundle\Rest\Error\Model\Response
     */
    private $errorResponse;

    /**
     * @var RequestModel
     */
    private $requestModel;

    /**
     * @var Processor\Index
     */
    private $processor;

    /**
     * @var \JMS\Serializer\Serializer
     */
    private $serializer;

    /**
     * Handler constructor.
     * @param ApiManager $apiM
     * @param Processor\Index $processor
     */
    public function __construct(ApiManager $apiM, Processor\Index $processor)
    {
        $this->apiM = $apiM;
        $this->errorManager = $this->apiM->errorManager();
        $this->errorResponse = $this->errorManager->errorResponse();
        $this->serializer = $this->apiM->serializer();
        $this->processor = $processor;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function handleRestRequest(Request $request): Response
    {
        $this->validateRequest($request);

        if ($this->errorResponse->hasErrors()) {
            return $this->errorManager->buildResponse($this->errorResponse, $this->format);
        }

        try {
            $response = $this->apiM->response()->buildResponse(
                $this->processor->handleRequestModel($this->requestModel),
                $this->format
            );
        } catch (ProcessorException $exc) {
            $this->apiM->logger()->error($exc->getMessage());
            $response = $this->errorManager->buildResponse(
                $this->errorResponse,
                $this->format
            );
        }

        return $response;
    }

    /**
     * @param Request $request
     */
    private function validateRequest(Request $request)
    {
        $this->format = $this->apiM->format()->requestFormat($request);

        $requestContent = $request->getContent();
        if (empty($requestContent)) {
            $error = $this->errorManager->error();
            $error->setCode(400)->setMessage('No request body found');
            $this->errorResponse->addError($error);
            return;
        }

        //no validate the content
        if ($this->format == "xml") {
            $formatErrors = $this->apiM->validator()->validateXML($requestContent);
        } else {
            $formatErrors = $this->apiM->validator()->validateJson($requestContent);
        }

        // collect errors
        foreach ($formatErrors as $errorHit) {
            $error = $this->errorManager->error();
            $error->setCode(400)->setMessage($errorHit);
            $this->errorResponse->setCode(400);
            $this->errorResponse->addError($error);
            return;
        }

        //now build request model
        $this->requestModel = $this->serializer->deserialize($requestContent, RequestModel::class, $this->format);

        $validationErrors = $this->apiM->validator()->symfonyValidator()->validate($this->requestModel);

        if (count($validationErrors) > 0) {
            foreach ($validationErrors as $error) {
                $message = $error->getPropertyPath() . ": " . $error->getMessage();
                $error = $this->errorManager->error();
                $error->setCode(400)->setMessage($message);
                $this->errorResponse->setCode(400);
                $this->errorResponse->addError($error);
            }
        }
    }

    /**
     * @return Processor\Index
     */
    public function getProcessor(): Processor\Index
    {
        return $this->processor;
    }
}
