<?php

/**
 * all code by me
 *
 * @copyright  Stefan H.G. Buchhofer
 * @version    Release: 1.0.0
 * @link       www.ilenvo-media.de
 * @email      ilenvo@me.com
 * @year       2017
 */

namespace Pim\ProductBundle\Services\Product\Lists\Version1\Processor;

use AppBundle\Rest\Api\Manager as ApiManager;
use Pim\ProductBundle\Database\Manager as DbM;
use Pim\ProductBundle\Services\Product\Lists\Version1\Request\Request as RequestModel;
use Pim\ProductBundle\Services\Product\Lists\Version1\Response\Response as ResponseModel;
use Pim\ProductBundle\Services\Product\Lists\Version1\Response\Product as SingleProductResponse;
use Pim\ProductBundle\Services\Product\Lists\Version1\Response\Attribute as SingleAttributeResponse;
use Pim\ProductBundle\Entity\Product as ProductEntities;
use Pim\ProductBundle\Services\Common\Error;

/**
 * Class Index
 * @package Pim\ProductBundle\Services\Product\Lists\Version1\Processor
 */
class Index
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
     * @var Error
     */
    private $errorHit;

    /**
     * @var ResponseModel
     */
    private $responseModel;

    /**
     * @var ProductEntities[]
     */
    private $productEntities;

    /**
     * Handler constructor.
     * @param ApiManager $apiM
     * @param DbM $dbM
     */
    public function __construct(ApiManager $apiM, DbM $dbM)
    {
        $this->apiM = $apiM;
        $this->dbM = $dbM;
        $this->errorHit = new Error();
        $this->responseModel = new ResponseModel();
    }

    /**
     * @param RequestModel $requestModel
     * @return ResponseModel
     */
    public function run(RequestModel $requestModel): ResponseModel
    {
        try {
            //@toDo change to dql!!!!
            $offset = $requestModel->getOffset();
            $limit = $requestModel->getLimit();
            $orderBy = $requestModel->getOrderBy();
            $orderDir = $requestModel->getOrderDir();
            $this->responseModel->setOffset($offset);
            $this->responseModel->setLimit($limit);
            $this->responseModel->setCount(count($this->dbM->repository()->product()->findAll()));
            $this->responseModel->setOrderBy($orderBy);
            $this->responseModel->setOrderDir($orderDir);
            $this->mapProductToResponse($this->dbM->repository()->product()->findBy([], [$orderBy => $orderDir], $limit,
                $offset));
            $this->setSuccessResponse();

        } catch (\Exception $exc) {
            $this->setErrorResponse($exc);
        }

        return $this->responseModel;
    }

    /**
     * @param ProductEntities[] $products
     * @return ProductEntity
     */
    private function mapProductToResponse($products)
    {

        foreach ($products as $product) {
            $productAdd = new SingleProductResponse();
            $productAdd->setUuid($product->getUuid()->toString());
            $productAdd->setSku($product->getSku());
            $productAdd->setLanguage($product->getLanguage());
            $productAdd->setSeoUrl($product->getSeoUrl());
            $productAdd->setCanonicalUrl($product->getCanonicalUrl());
            $productAdd->setTitle($product->getTitle());
            $productAdd->setSubTitle($product->getSubTitle());
            $productAdd->setShortDesc($product->getShortDesc());
            $productAdd->setLongDesc($product->getLongDesc());
            $productAdd->setPriceNetto($product->getPriceNetto());
            $productAdd->setPriceBrutto($product->getPriceBrutto());
            $productAdd->setPriceVAT($product->getPriceVAT());
            $productAdd->setReducible($product->isReducible());
            $productAdd->setInStock(null !== $product->getInStock() ? $product->getInStock() : 0);
            $productAdd->setDeliveryTimeInDays($product->getDeliveryTimeInDays());
            if (null !== $product->getAttributes()) {
                foreach ($product->getAttributes() as $attribute) {
                    $attributeObject = new SingleAttributeResponse();
                    $attributeObject->setSection($attribute->getSection());
                    $attributeObject->setName($attribute->getName());
                    $attributeObject->setValue($attribute->getValue());
                    $attributeObject->setAddPrice($attribute->getAddPrice());
                    $attributeObject->setMultiple($attribute->isMultiple());
                    $productAdd->addAttribute($attributeObject);
                }
            }
            $productAdd->setActive($product->isActive());
            $this->responseModel->addProduct($productAdd);
        }
    }

    /**
     * @param \Exception $exc
     */
    private function setErrorResponse(\Exception $exc)
    {
        $this->errorHit->setCode(400);
        $this->errorHit->setMessage('Unable to save to DB');
        $this->errorHit->setException($exc->getMessage());

        $this->responseModel->setCode(400);
        $this->responseModel->setError($this->errorHit);
    }

    private function setSuccessResponse()
    {
        $this->responseModel->setCode(200);

    }
}
