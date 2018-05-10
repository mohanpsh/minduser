<?php

namespace Pim\ProductBundle\Services;

use AppBundle\Rest\Api\Manager as ApiManager;
use Pim\ProductBundle\Database\Manager as DbM;

/**
 * Class Manager
 * @package Pim\ProductBundle\Services
 */
class Manager
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
     * @return Product\Factory
     */
    public function product()
    {
        if(!isset($this->setter[__FUNCTION__])){
            $this->setter[__FUNCTION__] = new Product\Factory($this->apiM, $this->dbM);
        }

        return $this->setter[__FUNCTION__];
    }

    /**
     * @return AttributeSet\Factory
     */
    public function attributeSet()
    {
        if(!isset($this->setter[__FUNCTION__])){
            $this->setter[__FUNCTION__] = new AttributeSet\Factory($this->apiM, $this->dbM);
        }

        return $this->setter[__FUNCTION__];
    }

    /**
     * @return Tag\Factory
     */
    public function tag()
    {
        if(!isset($this->setter[__FUNCTION__])){
            $this->setter[__FUNCTION__] = new Tag\Factory($this->apiM, $this->dbM);
        }

        return $this->setter[__FUNCTION__];
    }
}
