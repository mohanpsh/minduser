<?php

namespace Tests\AppBundle\Rest\Error\Model;

use PHPUnit\Framework\TestCase;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;
use AppBundle\Rest\Error\Model\Response as ResponseModel;
use AppBundle\Rest\Error\Model\Error as ErrorModel;

/**
 * Class ResponseTest
 * @package Tests\AppBundle\Rest\Error\Model
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

    public function testResponseGetter(){
        /**
         * @var $object ResponseModel
         */
        $object = $this->serializer->deserialize($this->jsonData(), ResponseModel::class, 'json');

        $this->assertEquals($object->getCode(), 401);
        $this->assertEquals($object->getStatus(), 'Unauthorized');
        $this->assertEquals($object->getDate(), new \DateTime('1976-04-23 00:05:00'));
        $this->assertEquals($object->getScriptTimeSeconds(), 1.55);

        //now check the errors an loop them
        $i = 0;
        foreach ($object->getErrors() as $error){
            if($i == 0){
                $this->assertEquals($error->getCode(), 400);
                $this->assertEquals($error->getStatus(), 'Bad Request');
                $this->assertEquals($error->getMessage(), 'No username found in header');
            }

            if($i == 1){
                $this->assertEquals($error->getCode(), 400);
                $this->assertEquals($error->getStatus(), 'Bad Request');
                $this->assertEquals($error->getMessage(), 'No apiKey found in header');
            }
            $i++;
        }


    }

    public function testResponseSetter()
    {
        $this->responseModel->setCode(401);
        $this->responseModel->setScriptTimeSeconds(1.55);
        $this->responseModel->setDate(new \DateTime('1976-04-23 00:05:00'));

        $errorOne = new ErrorModel();
        $errorOne->setCode(400);
        $errorOne->setMessage('No username found in header');
        $this->responseModel->addError($errorOne);

        $errorTwo = new ErrorModel();
        $errorTwo->setCode(400);
        $errorTwo->setMessage('No apiKey found in header');
        $this->responseModel->addError($errorTwo);

        $jsonContent = $this->serializer->serialize($this->responseModel, 'json');

        $this->assertJsonStringEqualsJsonString($this->jsonData(), $jsonContent);
    }

    public function jsonData()
    {
        return '{
                "code" : 401,
                "status" : "Unauthorized",
                "dateTime" : "1976-04-23T00:05:00+0100",
                "scriptTimeSeconds" : 1.55,
                "errors" : [
                    {
                        "code" : 400,
                        "status" : "Bad Request",
                        "message" : "No username found in header"
                    },
                    {
                        "code" : 400,
                        "status" : "Bad Request",
                        "message" : "No apiKey found in header"
                    }
                ]
            }';
    }
}