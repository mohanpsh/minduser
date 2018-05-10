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

namespace Pim\ProductBundle\Services\Category\Add\Version1\Processor;

use AppBundle\Rest\Api\Manager as ApiManager;
use Pim\ProductBundle\Database\Manager as DbM;
use Pim\ProductBundle\Services\Category\Add\Version1\Request\Request as RequestModel;
use Pim\ProductBundle\Services\Category\Add\Version1\Response\Response as ResponseModel;
use Pim\ProductBundle\Entity\Category as CategoryEntity;
use Pim\ProductBundle\Services\Common\Error;

/**
 * Class Index
 * @package Pim\ProductBundle\Services\Category\Add\Version1\Processor
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
     * @var ProductEntity
     */
    private $productEntity;

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
        $this->productEntity = $this->dbM->entity()->product();
    }

    /**
     * @param RequestModel $requestModel
     * @return ResponseModel
     */
    public function handleRequestModel(RequestModel $requestModel) : ResponseModel
    {
        try {
            $this->productEntity = $this->mapRequestToEntity($requestModel);
            $this->dbM->entityManager()->persist($this->productEntity);
            $this->dbM->entityManager()->flush();
            $this->setSuccessResponse();
        } catch (\Exception $exc) {
            $this->setErrorResponse($exc);
        }

        return $this->responseModel;
    }

    /**
     * @param RequestModel $requestModel
     * @return ProductEntity
     */
    private function mapRequestToEntity(RequestModel $requestModel) : ProductEntity
    {
        $this->productEntity->setSku($requestModel->getSku());
        $this->productEntity->setLanguage($requestModel->getLanguage());
        $this->productEntity->setSeoUrl($requestModel->getSeoUrl());
        $this->productEntity->setCanonicalUrl($requestModel->getCanonicalUrl());
        $this->productEntity->setTitle($requestModel->getTitle());
        $this->productEntity->setSubTitle($requestModel->getSubTitle());
        $this->productEntity->setShortDesc($requestModel->getShortDesc());
        $this->productEntity->setLongDesc($requestModel->getLongDesc());
        $this->productEntity->setPriceNetto($requestModel->getPriceNetto());
        $this->productEntity->setPriceBrutto($requestModel->getPriceBrutto());
        $this->productEntity->setPriceVAT($requestModel->getPriceVAT());
        $this->productEntity->setReducible($requestModel->isReducible());
        $this->productEntity->setInStock(null !== $requestModel->getInStock() ? $requestModel->getInStock() : 0);
        $this->productEntity->setDeliveryTimeInDays($requestModel->getDeliveryTimeInDays());

        dump($requestModel->getAttributes());
        foreach($requestModel->getAttributes() as $attribute){
            $productAttribute = $this->dbM->entity()->productAttributes();
            $productAttribute->setProduct($this->productEntity);
            $productAttribute->setSection($attribute->getSection());
            $productAttribute->setName($attribute->getName());
            $productAttribute->setValue($attribute->getValue());
            $productAttribute->setAddPrice($attribute->getAddPrice());
            $productAttribute->setMultiple($attribute->isMultiple());

            $this->dbM->entityManager()->persist($productAttribute);
            $this->productEntity->addAttribute($productAttribute);
        }

        $this->productEntity->setActive($requestModel->isActive());

        return $this->productEntity;
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
        $this->responseModel->setSku($this->productEntity->getSku());
        $this->responseModel->setProductId($this->productEntity->getUuid()->toString());
    }
}
