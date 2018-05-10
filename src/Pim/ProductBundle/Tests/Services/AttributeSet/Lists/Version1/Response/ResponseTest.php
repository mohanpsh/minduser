<?php

namespace Pim\ProductBundle\Tests\Services\AttributeSet\Lists\Version1\Response;

use PHPUnit\Framework\TestCase;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;
use Pim\ProductBundle\Services\AttributeSet\Lists\Version1\Response\Response as ResponseModel;
use Pim\ProductBundle\Services\AttributeSet\Lists\Version1\Response\AttributeSet as AttributeSetModel;

/**
 * Class ResponseTest
 * @package Pim\ProductBundle\Tests\Services\AttributeSet\Lists\Version1\Response
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
        $this->responseModel->setCount(99);
        $this->responseModel->setOffset(0);
        $this->responseModel->setLimit(10);
        $this->responseModel->setOrderBy('createdAt');
        $this->responseModel->setOrderDir('ASC');

        $attrSet = new AttributeSetModel();
        $attrSet->setUuid('784304f7-da76-4d30-bed4-2b614ba98a5b');
        $attrSet->setName('Bücher');
        $attrSet->setCreated(new \DateTime('1976-04-23 00:05:00'));
        $attrSet->setUpdated(new \DateTime('1976-04-23 00:05:00'));
        $attrSet->setAttributes(['ISBN','Seiten','Autor']);

        $attrSetTwo = new AttributeSetModel();
        $attrSetTwo->setName('Videos');
        $attrSetTwo->setUuid('5c5a0a21-d61b-4b7c-9fba-8ad291d4aa70');
        $attrSetTwo->setCreated(new \DateTime('1976-04-23 00:05:00'));
        $attrSetTwo->setUpdated(new \DateTime('1976-04-23 00:05:00'));
        $attrSetTwo->setAttributes(['Länge','Qualität']);

        $this->responseModel->addAttributeSet($attrSet);
        $this->responseModel->addAttributeSet($attrSetTwo);

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
                "offset" : 0,
                "limit" : 10,
                "count" : 99,
                "orderBy" : "createdAt",
                "orderDir" : "ASC",
                "attributeSets": [
                    {
                      "uuid": "784304f7-da76-4d30-bed4-2b614ba98a5b",
                      "name": "Bücher",
                      "created": "1976-04-23T00:05:00+0100",
                      "updated": "1976-04-23T00:05:00+0100",
                      "attributes": [
                        "ISBN",
                        "Seiten",
                        "Autor"
                      ]
                    },
                    {
                      "uuid": "5c5a0a21-d61b-4b7c-9fba-8ad291d4aa70",
                      "name": "Videos",
                      "created": "1976-04-23T00:05:00+0100",
                      "updated": "1976-04-23T00:05:00+0100",
                      "attributes": [
                        "Länge",
                        "Qualität"
                      ]
                    }
                ]
                }';
    }
}
