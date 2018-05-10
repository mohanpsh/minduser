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

namespace Pim\ProductBundle\Services\Tag\Lists\Version1\Processor;

use AppBundle\Rest\Api\Manager as ApiManager;
use Pim\ProductBundle\Database\Manager as DbM;
use Pim\ProductBundle\Services\Tag\Lists\Version1\Request\Request as RequestModel;
use Pim\ProductBundle\Services\Tag\Lists\Version1\Response\Response as ResponseModel;
use Pim\ProductBundle\Services\Tag\Lists\Version1\Response\Tag as SingleTagResponse;
use Pim\ProductBundle\Entity\Tags as TagsEntities;
use Pim\ProductBundle\Services\Common\Error;

/**
 * Class Index
 * @package Pim\ProductBundle\Services\Tag\Lists\Version1\Processor
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
            $this->responseModel->setCount(count($this->dbM->repository()->tags()->findAll()));
            $this->responseModel->setOrderBy($orderBy);
            $this->responseModel->setOrderDir($orderDir);
            $this->mapToResponse($this->dbM->repository()->tags()->findBy([], [$orderBy => $orderDir], $limit,
                $offset));
            $this->setSuccessResponse();

        } catch (\Exception $exc) {
            $this->setErrorResponse($exc);
        }

        return $this->responseModel;
    }

    /**
     * @param TagsEntities[] $tags
     */
    private function mapToResponse($tags)
    {
        foreach ($tags as $tag) {
            $tagAdd = new SingleTagResponse();
            $tagAdd->setUuid($tag->getUuid()->toString());
            $tagAdd->setName($tag->getName());
            $tagAdd->setDescription($tag->getDescription());
            $tagAdd->setCreated($tag->getCreated());
            $tagAdd->setUpdated($tag->getUpdated());
            $this->responseModel->addTag($tagAdd);
        }
    }

    /**
     * @param \Exception $exc
     */
    private function setErrorResponse(\Exception $exc)
    {
        $this->errorHit->setCode(400);
        $this->errorHit->setMessage('Unable to get data from DB');
        $this->errorHit->setException($exc->getMessage());

        $this->responseModel->setCode(400);
        $this->responseModel->setError($this->errorHit);
    }

    private function setSuccessResponse()
    {
        $this->responseModel->setCode(200);
    }
}
