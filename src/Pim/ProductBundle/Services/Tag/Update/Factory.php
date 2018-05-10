<?php

namespace Pim\ProductBundle\Services\Tag\Update;

use AppBundle\Rest\Api\Manager as ApiManager;
use Pim\ProductBundle\Database\Manager as DbM;

/**
 * Class Factory
 * @package Pim\ProductBundle\Services\Tag\Update
 */
class Factory
{
    /**
     * @var array
     */
    private $setter;

    /**
     * @var ApiManager
     */
    private $apiM;

    /**
     * @var DbM
     */
    private $dbM;

    /**
     * Manager constructor.
     * @param ApiManager $apiM
     * @param DbM $dbM
     */
    public function __construct(ApiManager $apiM, DbM $dbM)
    {
        $this->apiM = $apiM;
        $this->dbM = $dbM;
    }

    /**
     * @return Version1\Handler
     */
    public function version1()
    {
        if(!isset($this->setter[__FUNCTION__])){
            $processor = new Version1\Processor\Index($this->apiM, $this->dbM);
            $this->setter[__FUNCTION__] = new Version1\Handler($this->apiM, $processor);
        }

        return $this->setter[__FUNCTION__];
    }
}
