<?php

namespace Pim\ProductBundle\Services\Tag;

use AppBundle\Rest\Api\Manager as ApiManager;
use Pim\ProductBundle\Database\Manager as DbM;

/**
 * Class Factory
 * @package Pim\ProductBundle\Services\Tag
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
     * @return Add\Factory
     */
    public function add()
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = new Add\Factory($this->apiM, $this->dbM);
        }

        return $this->setter[__FUNCTION__];
    }

    /**
     * @return Lists\Factory
     */
    public function list()
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = new Lists\Factory($this->apiM, $this->dbM);
        }

        return $this->setter[__FUNCTION__];
    }

    /**
     * @return Delete\Factory
     */
    public function delete()
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = new Delete\Factory($this->apiM, $this->dbM);
        }

        return $this->setter[__FUNCTION__];
    }

    /**
     * @return Update\Factory
     */
    public function update()
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = new Update\Factory($this->apiM, $this->dbM);
        }

        return $this->setter[__FUNCTION__];
    }

    /**
     * @return Show\Factory
     */
    public function show()
    {
        if (!isset($this->setter[__FUNCTION__])) {
            $this->setter[__FUNCTION__] = new Show\Factory($this->apiM, $this->dbM);
        }

        return $this->setter[__FUNCTION__];
    }
}
