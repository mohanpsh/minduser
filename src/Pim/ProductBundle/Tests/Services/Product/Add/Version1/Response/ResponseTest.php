<?php

namespace Pim\ProductBundle\Tests\Services\AddProduct\Version1\Response;

use PHPUnit\Framework\TestCase;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;
use Pim\ProductBundle\Services\Product\Add\Version1\Response\Response as ResponseModel;

/**
 * Class ResponseTest
 * @package Pim\ProductBundle\Tests\Services\AddProduct\Response\Version1
 */
class ResponseTest extends TestCase
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var ResponseModel
     */
    private $responseModel;

    public function setUp()
    {
        $this->serializer = SerializerBuilder::create()->build();
        $this->responseModel = new ResponseModel();

        parent::setUp();
    }

    public function testRequestSetterSuccess()
    {
        $this->responseModel->setCode(200);
        $this->responseModel->setMessage('TestMessage');
        $this->responseModel->setDate(new \DateTime('1976-04-23 00:05:00'));
        $this->responseModel->setScriptTimeSeconds(1.05);

        $jsonContent = $this->serializer->serialize($this->responseModel, 'json');
        $this->assertJsonStringEqualsJsonString($this->jsonDataSuccess(), $jsonContent);
    }

    public function jsonDataSuccess()
    {
        return '{
                "code" : 200,
                "status" : "OK",
                "message" : "TestMessage",
                "dateTime" : "1976-04-23T00:05:00+0100",
                "scriptTimeSeconds" : 1.05
            }';
    }
}