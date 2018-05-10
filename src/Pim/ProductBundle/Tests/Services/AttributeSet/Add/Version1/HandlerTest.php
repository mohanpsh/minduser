<?php

namespace Pim\ProductBundle\Tests\Services\AttributeSet\Add\Version1;

use PHPUnit\Framework\TestCase;
use AppBundle\Rest\Api\Manager as ApiManager;
use Pim\ProductBundle\Database\Manager as DbM;
use Pim\ProductBundle\Services\AttributeSet\Add\Version1\Processor\Index as IndexProcessor;
use Pim\ProductBundle\Services\AttributeSet\Add\Version1\Handler;
use AppBundle\Rest\Error\Manager as ErrorManager;
use Pim\ProductBundle\Database\Entity\Factory as EntityFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;
use AppBundle\Events\Listener\PerformanceListener;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Psr\Log\LoggerInterface;
use Pim\ProductBundle\Exception\ProcessorException;
use Symfony\Component\Validator\Validation;

/**
 * Class HandlerTest
 * @package Pim\ProductBundle\Tests\Services\AttributeSet\Add\Version1
 */
class HandlerTest extends TestCase
{
    /**
     * @var ApiManager
     */
    private $apiM;

    /**
     * @var DbM
     */
    private $dbM;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var PerformanceListener
     */
    private $performanceListener;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var ErrorManager
     */
    private $errorManager;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function setUp()
    {
        $this->serializer = SerializerBuilder::create()->build();

        $this->logger = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->performanceListener = $this->getMockBuilder(PerformanceListener::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->performanceListener->method('getScriptSeconds')
            ->willReturn(1.00);

        $this->errorManager = new ErrorManager($this->serializer, $this->performanceListener);

        $this->validator = Validation::createValidatorBuilder()->getValidator();

        $this->apiM = new ApiManager($this->errorManager, $this->logger, $this->serializer, $this->validator,
            $this->performanceListener);

        $this->dbM = $this->getMockBuilder(DbM::class)->disableOriginalConstructor()->getMock();

        $this->dbM->method('entity')
            ->willReturn(new EntityFactory());
    }

    public function testHandlerOne()
    {
        $processor = new IndexProcessor($this->apiM, $this->dbM);
        $handler = new Handler($this->apiM, $processor);

        $request = new Request();

        $response = $handler->handleRestRequest($request);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testHandlerTwo()
    {
        $processor = new IndexProcessor($this->apiM, $this->dbM);
        $handler = new Handler($this->apiM, $processor);

        $uri = '/hello-world';
        $method = 'GET';
        $parameters = array();
        $cookies = array();
        $files = array();
        $server = array();
        $content = '{
                       "name" : "Bücher",
                       "attributes" : [
                         "ISBN",
                         "Seiten",
                         "Autor"
                       ]
                    }';

        $request = Request::create(
            $uri,
            $method,
            $parameters,
            $cookies,
            $files,
            $server,
            $content
        );

        $response = $handler->handleRestRequest($request);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testHandlerErrors()
    {
        $processor = new IndexProcessor($this->apiM, $this->dbM);
        $handler = new Handler($this->apiM, $processor);

        $uri = '/hello-world';
        $method = 'GET';
        $parameters = array();
        $cookies = array();
        $files = array();
        $server = array();
        $content = '{not valid}';

        $request = Request::create(
            $uri,
            $method,
            $parameters,
            $cookies,
            $files,
            $server,
            $content
        );

        $response = $handler->handleRestRequest($request);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertInstanceOf(IndexProcessor::class, $handler->getProcessor());
    }

    public function testHandlerException()
    {
        $processor = $this->getMockBuilder(IndexProcessor::class)->disableOriginalConstructor()->getMock();
        $processor->method('run')
            ->willThrowException(new ProcessorException);

        $handler = new Handler($this->apiM, $processor);

        $uri = '/hello-world';
        $method = 'GET';
        $parameters = array();
        $cookies = array();
        $files = array();
        $server = array();
        $content = '{
                       "name" : "Bücher",
                       "attributes" : [
                         "ISBN",
                         "Seiten",
                         "Autor"
                       ]
                    }';

        $request = Request::create(
            $uri,
            $method,
            $parameters,
            $cookies,
            $files,
            $server,
            $content
        );

        $response = $handler->handleRestRequest($request);
        $this->assertInstanceOf(Response::class, $response);
    }
}
