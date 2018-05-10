<?php

namespace AppBundle\Rest\Api\Mapper;

/**
 * Class Index
 * @package AppBundle\Rest\Api\Mapper
 */
class Index
{

    /**
     * @param object $modelIn
     * @param object $modelOut
     * @return object $modelOut
     */
    public function modelInToModelOut($modelIn, $modelOut)
    {
        $getArray = $this->classGetIsMethods($modelIn);
        $setArray = $this->classSetMethods($modelOut);

        // looping the set array
        foreach ($setArray as $method) {
            if (in_array($method, $getArray)) {
                $setName = "set" . $method;
                $getName = "get" . $method;
                $isName = "is" . $method;
                if (method_exists($modelOut, $setName)) {
                    if (method_exists($modelIn, $getName)) {
                        $modelOut->{$setName}($modelIn->{$getName}());
                    } else {
                        $modelOut->{$setName}($modelIn->{$isName}());
                    }
                }
            }
        }
        return $modelOut;
    }

    /**
     * @param object $className
     * @return array
     */
    private function classSetMethods($className)
    {
        $reflectionClass = new \ReflectionClass($className);
        $setMethods = array();
        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $reflectionMethod) {
            preg_match("/(set+[A-Z]+[a-z])/", $reflectionMethod->name, $match);
            if ($match) {
                $name = str_ireplace('set', '', $reflectionMethod->name);
                $setMethods[$name] = $name;
            }
        }
        return $setMethods;
    }

    /**
     * @param object $className
     * @return array
     */
    private function classGetIsMethods($className)
    {
        $reflectionClass = new \ReflectionClass($className);
        $getMethods = array();
        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $reflectionMethod) {
            preg_match("/(get+[A-Z]+[a-z])|(is+[A-Z]+[a-z])/", $reflectionMethod->name, $match);
            if ($match) {
                $name = str_ireplace(['get', 'is'], ['', ''], $reflectionMethod->name);
                $getMethods[$name] = $name;
            }
        }
        return $getMethods;
    }
}
