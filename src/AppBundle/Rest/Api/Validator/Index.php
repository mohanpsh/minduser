<?php

namespace AppBundle\Rest\Api\Validator;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class Index
 * @package Pim\ProductBundle\Api\Validator
 */
class Index
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @param Container $container
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }


    /**
     * @return ValidatorInterface
     */
    public function symfonyValidator(){

        return $this->validator;
    }

    /**
     * @param string $string
     * @return array
     */
    public function validateJson($string)
    {
        $errorStorage = [];

        if (is_numeric($string)) {
            $errorStorage[] = 'no valid json string (int)';
        }
        json_decode($string);

        if(json_last_error() == JSON_ERROR_NONE){
        } else{
            $errorStorage[] = 'no valid json string';
        }
        return $errorStorage;
    }


    /**
     * @param string $xml
     * @return array
     */
    public function validateXML($xml)
    {
        $errorStorage = [];
        libxml_clear_errors();
        libxml_disable_entity_loader(true);
        libxml_use_internal_errors(true);

        $simpleXML = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_COMPACT);

        if (!$simpleXML) {
            $errors = libxml_get_errors();
            foreach ($errors as $error) {
                $errorStorage[] = $error->message;
            }
            libxml_clear_errors();
            libxml_disable_entity_loader(false);
        } else {
            libxml_clear_errors();
            libxml_disable_entity_loader(false);
        }

        return $errorStorage;
    }
}
