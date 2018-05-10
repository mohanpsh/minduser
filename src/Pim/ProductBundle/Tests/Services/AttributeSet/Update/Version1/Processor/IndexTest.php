<?php

namespace Pim\ProductBundle\Tests\Services\AttributeSet\Update\Version1\Processor;

use PHPUnit\Framework\TestCase;
use AppBundle\Rest\Api\Manager as ApiManager;
use Pim\ProductBundle\Database\Manager as DbM;
use Pim\ProductBundle\Services\AttributeSet\Update\Version1\Processor\Index as IndexProcessor;
use AppBundle\Rest\Error\Manager as ErrorManager;
use Pim\ProductBundle\Services\AttributeSet\Update\Version1\Request\Request as RequestModel;
use Pim\ProductBundle\Services\AttributeSet\Update\Version1\Response\Response as ResponseModel;
use AppBundle\Rest\Api\Mapper\Index as MapperIndex;
use Pim\ProductBundle\Database\Entity\Factory as EntityFactory;

/**
 * Class FactoryTest
 * @package Pim\ProductBundle\Tests\Services\AttributeSet\Add
 */
class IndexTest extends TestCase
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

    /**
     * @var RequestModel
     */
    private $requestModel;


    public function setUp()
    {
        $this->errorManager = $this->getMockBuilder(ErrorManager::class)->disableOriginalConstructor()->getMock();

        $this->apiM = $this->getMockBuilder(ApiManager::class)
        ->disableOriginalConstructor()
        ->getMock();

        $this->apiM->method('errorManager')
            ->willReturn($this->errorManager);

        $this->apiM->method('mapper')
            ->willReturn(new MapperIndex());

        $this->dbM = $this->getMockBuilder(DbM::class)->disableOriginalConstructor()->getMock();

        $this->dbM->method('entity')
            ->willReturn(new EntityFactory());

        $this->requestModel = new RequestModel();
        $this->requestModel ->setName('test');
        $this->requestModel ->setAttributes(['one', 'two']);
    }

    public function testProcessorSuccess()
    {
        $processor = new IndexProcessor($this->apiM, $this->dbM);
        $responseModel = $processor->run($this->requestModel);
        $this->assertInstanceOf(ResponseModel::class, $responseModel);
    }

    public function testProcessorError()
    {
        $this->dbM = $this->getMockBuilder(DbM::class)->disableOriginalConstructor()->getMock();

        $this->dbM->method('entity')
            ->willReturn(new EntityFactory());

        $this->dbM->method('entityManager')
            ->will($this->throwException(new \Exception));

        $processor = new IndexProcessor($this->apiM, $this->dbM);
        $responseModel = $processor->run($this->requestModel);
        $this->assertInstanceOf(ResponseModel::class, $responseModel);
    }
}
