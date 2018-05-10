<?php

namespace AppBundle\Rest\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use AppBundle\Rest\Error\Manager as ErrorManager;

/**
 * Class RestExceptionListener
 * @package AppBundle\Rest\EventListener
 */
class RestExceptionListener
{
    /**
     * @var ErrorManager
     */
    private $errorManager;

    /**
     * @var \AppBundle\Rest\Error\Model\Response
     */
    private $errorResponse;

    /**
     * @var string
     */
    private $format;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * RestExceptionListener constructor.
     * @param ErrorManager $errorManager
     * @param LoggerInterface $logger
     */
    public function __construct(ErrorManager $errorManager, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->errorManager = $errorManager;
        $this->errorResponse = $this->errorManager->errorResponse();
    }

    /**
     * @param GetResponseForExceptionEvent $event
     * @return null
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $this->logger->error($event->getException()->getMessage());
        $this->logger->error($event->getException()->getTraceAsString());

        $request = $event->getRequest();
        //first check if the api_rest_ name is in route and we are responsible for this request
        if(stripos($request->attributes->get('_route'), 'api_rest_') === false){
            return null;
        }
        $this->format = $request->attributes->get('_format', 'json');

        if($event->getException() instanceof AccessDeniedHttpException){
            $this->errorResponse->setCode(403);
            $error = $this->errorManager->error();
            $error->setCode(403);
            $error->setMessage('You are not allowed to do this request!');
            $this->errorResponse->addError($error);
        } else {
            $this->errorResponse->setCode(500);
        }

        if($this->format == 'xml'){
            $response =  $this->errorManager->xmlResponse($this->errorResponse);
        } else {
            $response = $this->errorManager->jsonResponse($this->errorResponse);
        }
        $event->setResponse($response);
    }
}
