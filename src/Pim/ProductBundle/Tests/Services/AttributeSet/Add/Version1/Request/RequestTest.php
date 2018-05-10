<?php

namespace Pim\ProductBundle\Tests\Services\AttributeSet\Add\Version1\Request;

use PHPUnit\Framework\TestCase;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;
use Pim\ProductBundle\Services\AttributeSet\Add\Version1\Request\Request as RequestModel;

/**
 * Class RequestTest
 * @package Pim\ProductBundle\Tests\Services\AttributeSet\Add\Version1\Request
 */
class RequestTest extends TestCase
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var RequestModel
     */
    private $requestModel;

    public function setUp()
    {
        $this->serializer = SerializerBuilder::create()->build();
        $this->requestModel = new RequestModel();

        parent::setUp();
    }

    public function testRequestGetter()
    {
        $object = $this->serializer->deserialize($this->jsonData(), RequestModel::class, 'json');

        $this->assertEquals($object->getName(), 'Bücher');
        $this->assertEquals($object->getAttributes(), ["ISBN", "Seiten", "Autor"]);
    }


    public function testRequestSetter()
    {
        $this->requestModel->setName('Bücher');
        $attributeSet = ["ISBN", "Seiten", "Autor"];

        $this->requestModel->setAttributes($attributeSet);

        $jsonContent = $this->serializer->serialize($this->requestModel, 'json');
        $this->assertJsonStringEqualsJsonString($this->jsonData(), $jsonContent);
    }

    public function jsonData()
    {
        return '{
                    "name" : "Bücher",
                    "attributes" : [
                        "ISBN",
                        "Seiten", 
                        "Autor"
                    ]
                }';
    }
}