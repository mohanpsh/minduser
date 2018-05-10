<?php

namespace Pim\ProductBundle\Controller\Rest;

use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\Response;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use JMS\DiExtraBundle\Annotation as DI;
use Pim\ProductBundle\Services\Manager as ServiceManager;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ApiController
 * @NamePrefix("api_rest_")
 * @package Pim\ProductBundle\Controller
 */
class CategoryController extends FOSRestController
{
    /**
     * @DI\Inject("pim_product.services.manager")
     * @var ServiceManager
     */
    private $serviceManager;

    /**
     * ###Request (header)
     *
     *      Key                 | Value               | Description
     *      ------------------- | ------------------- | --------------------------------------
     *      username            |  (string)           | your username
     *      apiKey              |  (string)           | your apiKey
     * ###Request body json
     *
     *     {
     *        "name" : "Bücher",
     *        "attributes" : [
     *          "ISBN",
     *          "Seiten",
     *          "Autor"
     *        ]
     *     }
     *
     * @ApiDoc(
     *  resource="PIM/Category",
     *  description="",
     *     statusCodes={
     *         200="Returned when successful",
     *         204="Returned when no content was send",
     *         400="Returned when an error occurred",
     *         401="Unauthorized - Wrong credentials",
     *         403="Returned when the user is not authorized to do this request",
     *         416="Returned when the request is malformed",
     *         500="Returned on internal server errors"
     *  },
     *  headers={
     *      {
     *        "name"="username",
     *        "description"="your username",
     *        "required"=true
     *       },
     *      {
     *        "name"="apiKey",
     *        "description"="your apiKey",
     *        "required"=true
     *       }
     *  },
     *  tags={
     *      "stable" = "#000"
     *  }
     * )
     * @Post("/v1/category/add", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function addCategoryAction(Request $request)
    {
        return $this->serviceManager->addProductV1()->handleRestRequest($request);
    }

    /**
     * ###Request (header)
     *
     *      Key                 | Value               | Description
     *      ------------------- | ------------------- | --------------------------------------
     *      username            |  (string)           | your username
     *      apiKey              |  (string)           | your apiKey
     * ###Request body json
     *
     *     {
     *       "sku" : "SKU123456789",
     *       "language" : "DE",
     *       "seoUrl" : "SeoUrl",
     *       "canonicalUrl" : "CanonicalUrl",
     *       "title" : "title",
     *       "subTitle" : "subTitle",
     *       "shortDesc" : "shortDesc",
     *       "longDesc" : "longDesc",
     *       "priceNetto" : 1,
     *       "priceBrutto" : 1.19,
     *       "priceVAT" : 19,
     *       "reducible" : true,
     *       "inStock" : 99,
     *       "deliveryTimeInDays" : 1,
     *       "attributes" : {
     *           "color" : "red",
     *           "size" : "XL"
     *       },
     *       "active" : true
     *     }
     *
     * @ApiDoc(
     *  resource="PIM/Category",
     *  description="",
     *     statusCodes={
     *         200="Returned when successful",
     *         204="Returned when no content was send",
     *         400="Returned when an error occurred",
     *         401="Unauthorized - Wrong credentials",
     *         403="Returned when the user is not authorized to do this request",
     *         416="Returned when the request is malformed",
     *         500="Returned on internal server errors"
     *  },
     *  headers={
     *      {
     *        "name"="username",
     *        "description"="your username",
     *        "required"=true
     *       },
     *      {
     *        "name"="apiKey",
     *        "description"="your apiKey",
     *        "required"=true
     *       }
     *  },
     *  input = {
     *      "class" = "Pim\ProductBundle\Services\ListProducts\Version1\Request\Request"
     * },
     *  tags={
     *      "stable" = "#000"
     *  }
     * )
     * @Get("/v1/categories/list", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function listCategoriesAction(Request $request)
    {
        return $this->serviceManager->listProductsV1()->handleRestRequest($request);
    }

    /**
     * ###Request (header)
     *
     *      Key                 | Value               | Description
     *      ------------------- | ------------------- | --------------------------------------
     *      username            |  (string)           | your username
     *      apiKey              |  (string)           | your apiKey
     * ###Request body json
     *
     *     {
     *        "name" : "Bücher",
     *        "attributes" : [
     *          "ISBN",
     *          "Seiten",
     *          "Autor"
     *        ]
     *     }
     *
     * @ApiDoc(
     *  resource="PIM/Category",
     *  description="",
     *     statusCodes={
     *         200="Returned when successful",
     *         204="Returned when no content was send",
     *         400="Returned when an error occurred",
     *         401="Unauthorized - Wrong credentials",
     *         403="Returned when the user is not authorized to do this request",
     *         416="Returned when the request is malformed",
     *         500="Returned on internal server errors"
     *  },
     *  headers={
     *      {
     *        "name"="username",
     *        "description"="your username",
     *        "required"=true
     *       },
     *      {
     *        "name"="apiKey",
     *        "description"="your apiKey",
     *        "required"=true
     *       }
     *  },
     *  tags={
     *      "stable" = "#000"
     *  }
     * )
     * @Delete("/v1/category/delete", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function deleteCategoryAction(Request $request)
    {
        return $this->serviceManager->addProductV1()->handleRestRequest($request);
    }

    /**
     * ###Request (header)
     *
     *      Key                 | Value               | Description
     *      ------------------- | ------------------- | --------------------------------------
     *      username            |  (string)           | your username
     *      apiKey              |  (string)           | your apiKey
     * ###Request body json
     *
     *     {
     *        "name" : "Bücher",
     *        "attributes" : [
     *          "ISBN",
     *          "Seiten",
     *          "Autor"
     *        ]
     *     }
     *
     * @ApiDoc(
     *  resource="PIM/Category",
     *  description="",
     *     statusCodes={
     *         200="Returned when successful",
     *         204="Returned when no content was send",
     *         400="Returned when an error occurred",
     *         401="Unauthorized - Wrong credentials",
     *         403="Returned when the user is not authorized to do this request",
     *         416="Returned when the request is malformed",
     *         500="Returned on internal server errors"
     *  },
     *  headers={
     *      {
     *        "name"="username",
     *        "description"="your username",
     *        "required"=true
     *       },
     *      {
     *        "name"="apiKey",
     *        "description"="your apiKey",
     *        "required"=true
     *       }
     *  },
     *  tags={
     *      "stable" = "#000"
     *  }
     * )
     * @Put("/v1/category/update", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function updateCategoryAction(Request $request)
    {
        return $this->serviceManager->addProductV1()->handleRestRequest($request);
    }
}
