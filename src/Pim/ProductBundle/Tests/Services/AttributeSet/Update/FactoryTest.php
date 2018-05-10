<?php

namespace Pim\ProductBundle\Tests\Services\AttributeSet\Update;

use PHPUnit\Framework\TestCase;
use AppBundle\Rest\Api\Manager as ApiManager;
use Pim\ProductBundle\Database\Manager as DbM;
use Pim\ProductBundle\Services\AttributeSet\Update\Factory;
use Pim\ProductBundle\Services\AttributeSet\Update\Version1\Handler as Version1Handler;
use AppBundle\Rest\Error\Manager as ErrorManager;

/**
 * Class FactoryTest
 * @package Pim\ProductBundle\Tests\Services\AttributeSet\Add
 */
class FactoryTest extends TestCase
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
     * @var ErrorManager
     */
    private $errorManager;


    public function setUp()
    {
        $this->errorManager = $this->getMockBuilder(ErrorManager::class)->disableOriginalConstructor()->getMock();

        $this->apiM = $this->getMockBuilder(ApiManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiM->method('errorManager')
            ->willReturn($this->errorManager);

        $this->dbM = $this->getMockBuilder(DbM::class)->disableOriginalConstructor()->getMock();
    }

    public function testFactory()
    {
        $factory = new Factory($this->apiM, $this->dbM);
        $this->assertInstanceOf(Version1Handler::class, $factory->version1());
    }
}
