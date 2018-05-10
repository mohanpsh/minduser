<?php

namespace Tests\AppBundle\Rest\Api\Mapper;

use PHPUnit\Framework\TestCase;
use AppBundle\Rest\Api\Mapper\Index as MapperIndex;

/**
 * Class IndexTest
 * @package Tests\AppBundle\Rest\Api\Mapper
 */
class IndexTest extends TestCase
{

    public function testMapper(){


        $modelIn = new ModelIn();
        $modelIn->setCheckArray([1,2,3]);
        $modelIn->setCheckBool(true);
        $modelIn->setCheckString('string');
        $modelIn->setCheckInteger(4711);

        //object to fill
        $modelOut = new ModelOut();
        $mapper = new MapperIndex();
        $modelOut = $mapper->modelInToModelOut($modelIn, $modelOut);

        $this->assertEquals($modelOut->getCheckArray(), $modelIn->getCheckArray());
        $this->assertEquals($modelOut->isCheckBool(), $modelIn->isCheckBool());
        $this->assertEquals($modelOut->getCheckString(), $modelIn->getCheckString());
        $this->assertEquals($modelOut->getCheckInteger(), $modelIn->getCheckInteger());
    }
}
