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
class ProductController extends FOSRestController
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
     *       "attributes" : [
     *          {
     *          "name" : "color",
     *          "value" : "red",
     *          "section" : "section",
     *          "addPrice" : 12,
     *          "multiple" : false
     *          },
     *          {
     *          "name" : "size",
     *          "value" : "XL",
     *          "section" : "section",
     *          "addPrice" : 12,
     *          "multiple" : false
     *          }
     *        ],
     *       "active" : true
     *     }
     *
     * ###Response Success json
     *
     *     {
     *       "code": 200,
     *       "status": "OK",
     *       "dateTime": "2017-03-29T16:03:18+0200",
     *       "scriptTimeSeconds": 0.2836,
     *       "sku": "SKU12345678d",
     *       "productId": "a7456731-7e16-47ea-9aed-21bbc775ea03"
     *     }
     *
     * @ApiDoc(
     *  resource="PIM/Product",
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
     * @Post("/v1/product/add", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function addProductAction(Request $request)
    {
        return $this->serviceManager->product()->add()->version1()->handleRestRequest($request);
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
     *  resource="PIM/Product",
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
     * @Get("/v1/products/list", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function listProductAction(Request $request)
    {
        return $this->serviceManager->product()->lists()->version1()->handleRestRequest($request);
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
     *  resource="PIM/Product",
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
     * @Delete("/v1/product/delete", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function deleteProductAction(Request $request)
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
     *  resource="PIM/Product",
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
     * @Put("/v1/product/update", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function updateProductAction(Request $request)
    {
        return $this->serviceManager->addProductV1()->handleRestRequest($request);
    }
}
