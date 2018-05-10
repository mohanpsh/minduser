<?php

namespace Pim\ProductBundle\Tests\Services\AttributeSet\Add\Version1\Response;

use PHPUnit\Framework\TestCase;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;
use Pim\ProductBundle\Services\AttributeSet\Add\Version1\Response\Response as ResponseModel;

/**
 * Class ResponseTest
 * @package Pim\ProductBundle\Tests\Services\AddAttributeSet\Response\Version1
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

    public function testResponseGetterSuccess()
    {
        /**
         * @var ResponseModel $data
         */
        $data = $this->serializer->deserialize($this->jsonDataSuccess(), ResponseModel::class, 'json');

        $this->assertEquals(200, $data->getCode());
        $this->assertEquals('TestMessage', $data->getMessage());
        $this->assertEquals(new \DateTime('1976-04-23 00:05:00'), $data->getDate());
        $this->assertEquals(1.05, $data->getScriptTimeSeconds());
        $this->assertEquals('c3cdda04-e454-4602-bce0-b9168e3191db', $data->getAttributeSetId());
        $this->assertEquals('Bücher', $data->getName());
    }

    public function testResponseSetterSuccess()
    {
        $this->responseModel->setCode(200);
        $this->responseModel->setMessage('TestMessage');
        $this->responseModel->setDate(new \DateTime('1976-04-23 00:05:00'));
        $this->responseModel->setScriptTimeSeconds(1.05);
        $this->responseModel->setAttributeSetId('c3cdda04-e454-4602-bce0-b9168e3191db');
        $this->responseModel->setName('Bücher');

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
                "scriptTimeSeconds" : 1.05,
                "attributeSetId": "c3cdda04-e454-4602-bce0-b9168e3191db",
                "name": "Bücher"
            }';
    }
}