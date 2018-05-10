<?php

namespace Pim\ProductBundle\Tests\Services\AddProduct\Version1\Request;

use PHPUnit\Framework\TestCase;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;
use Pim\ProductBundle\Services\Product\Add\Version1\Request\Attribute;
use Pim\ProductBundle\Services\Product\Add\Version1\Request\Request as RequestModel;

/**
 * Class RequestTest
 * @package Pim\ProductBundle\Tests\Services\AddProduct\Request\Version1
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

        $this->assertEquals($object->getSku(), 'SKU123456789');
        $this->assertEquals($object->getLanguage(), 'DE');
        $this->assertEquals($object->getSeoUrl(), 'SeoUrl');
        $this->assertEquals($object->getCanonicalUrl(), 'CanonicalUrl');
        $this->assertEquals($object->getTitle(), 'title');
        $this->assertEquals($object->getSubTitle(),'subTitle');
        $this->assertEquals($object->getShortDesc(),'shortDesc');
        $this->assertEquals($object->getLongDesc(),'longDesc');
        $this->assertEquals($object->getPriceNetto(),1.00);
        $this->assertEquals($object->getPriceBrutto(),1.19);
        $this->assertEquals($object->getPriceVAT(),19.00);
        $this->assertEquals($object->isReducible(), true);
        $this->assertEquals($object->getInStock(),99);
        $this->assertEquals($object->getDeliveryTimeInDays(),1);
        $this->assertEquals($object->getAttributes()[0]->getName(),'color');
        $this->assertEquals($object->getAttributes()[0]->getValue(),'red');
        $this->assertEquals($object->getAttributes()[0]->getSection(),'section');
        $this->assertEquals($object->getAttributes()[0]->getAddPrice(),12);
        $this->assertEquals($object->getAttributes()[0]->isMultiple(),false);
        $this->assertEquals($object->isActive(),true);
    }


    public function testRequestSetter()
    {
        $this->requestModel->setSku('SKU123456789');
        $this->requestModel->setLanguage('DE');
        $this->requestModel->setSeoUrl('SeoUrl');
        $this->requestModel->setCanonicalUrl('CanonicalUrl');
        $this->requestModel->setTitle('title');
        $this->requestModel->setSubTitle('subTitle');
        $this->requestModel->setShortDesc('shortDesc');
        $this->requestModel->setLongDesc('longDesc');
        $this->requestModel->setPriceNetto(1.00);
        $this->requestModel->setPriceBrutto(1.19);
        $this->requestModel->setPriceVAT(19.00);
        $this->requestModel->setReducible(true);
        $this->requestModel->setInStock(99);
        $this->requestModel->setDeliveryTimeInDays(1);
        $attribute = new Attribute();
        $attribute->setName('color');
        $attribute->setValue('red');
        $attribute->setSection('section');
        $attribute->setAddPrice(12);
        $attribute->setMultiple(false);
        $this->requestModel->addAttribute($attribute);
        $attributeTwo = new Attribute();
        $attributeTwo->setName('size');
        $attributeTwo->setValue('XL');
        $attributeTwo->setSection('section');
        $attributeTwo->setAddPrice(12);
        $attributeTwo->setMultiple(false);
        $this->requestModel->addAttribute($attributeTwo);
        $this->requestModel->setActive(true);

        $jsonContent = $this->serializer->serialize($this->requestModel, 'json');

        $this->assertJsonStringEqualsJsonString($this->jsonData(), $jsonContent);
    }

    public function jsonData()
    {
        return '{
                    "sku" : "SKU123456789",
                    "language" : "DE",
                    "seoUrl" : "SeoUrl",
                    "canonicalUrl" : "CanonicalUrl",
                    "title" : "title",
                    "subTitle" : "subTitle",
                    "shortDesc" : "shortDesc",
                    "longDesc" : "longDesc",
                    "priceNetto" : 1,
                    "priceBrutto" : 1.19,
                    "priceVAT" : 19,
                    "reducible" : true,
                    "inStock" : 99,
                    "deliveryTimeInDays" : 1,
                    "attributes" : [
                        {
                        "name" : "color",
                        "value" : "red",
                        "section" : "section",
                        "addPrice" : 12,
                        "multiple" : false
                        },
                        {
                        "name" : "size",
                        "value" : "XL",
                        "section" : "section",
                        "addPrice" : 12,
                        "multiple" : false
                        }
                    ],
                    "active" : true
                }';
    }
}