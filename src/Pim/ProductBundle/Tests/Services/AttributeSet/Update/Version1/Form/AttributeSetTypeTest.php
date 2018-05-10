<?php

namespace Pim\ProductBundle\Tests\Services\AttributeSet\Update\Version1\Form;

use Pim\ProductBundle\Services\AttributeSet\Update\Version1\Form\TagsType;
use Pim\ProductBundle\Services\AttributeSet\Update\Version1\Request\Request as RequestModel;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class AttributeSetTypeTest
 * @package Pim\ProductBundle\Tests\Services\AttributeSet\Add\Version1\Form
 */
class AttributeSetTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'uuid' => '123',
            'name' => 'testName',
            'attributes' => ['testOne', 'testTwo']
        );

        $form = $this->factory->create(TagsType::class);

        $requestModel = new RequestModel();
        $requestModel->setUuid('123');
        $requestModel->setName('testName');
        $requestModel->setAttributes(['testOne', 'testTwo']);

        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($requestModel, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
