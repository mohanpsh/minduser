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
class TagsController extends FOSRestController
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
     *        "name" : "Offers",
     *        "description" : "Our current special offers"
     *     }
     *
     * @ApiDoc(
     *  resource="PIM/Tag",
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
     * @Post("/v1/tag/add", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function addTagAction(Request $request)
    {
        return $this->serviceManager->tag()->add()->version1()->handleRestRequest($request);
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
     *  resource="PIM/Tag",
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
     *      "class" = "Pim\ProductBundle\Services\Tag\Lists\Version1\Request\Request"
     * },
     *  tags={
     *      "stable" = "#000"
     *  }
     * )
     * @Get("/v1/tags/list", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function listTagsAction(Request $request)
    {
        return $this->serviceManager->tag()->list()->version1()->handleRestRequest($request);
    }

    /**
     * ###Request (header)
     *
     *      Key                 | Value               | Description
     *      ------------------- | ------------------- | --------------------------------------
     *      username            |  (string)           | your username
     *      apiKey              |  (string)           | your apiKey
     *
     * ###Request url
     *
     *      /api/v1/tag/delete/c4f8ccbf-d895-4af5-9d50-479e7f1e5a42.json
     *
     * ###Response json
     *
     *      {
     *       "code": 200,
     *       "status": "OK",
     *       "message": "Tag deleted!",
     *       "dateTime": "2017-04-09T15:31:15+0200",
     *       "scriptTimeSeconds": 0.2549
     *      }
     *
     * @ApiDoc(
     *  resource="PIM/Tag",
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
     * @Delete("/v1/tag/{uuid}/delete", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function deleteTagAction(Request $request)
    {
        return $this->serviceManager->tag()->delete()->version1()->handleRestRequest($request);
    }

    /**
     * ###Request (header)
     *
     *      Key                 | Value               | Description
     *      ------------------- | ------------------- | --------------------------------------
     *      username            |  (string)           | your username
     *      apiKey              |  (string)           | your apiKey
     *
     * ###Request url
     *
     *      PUT /api/v1/tag/21c74e30-984c-4ecf-9b18-9b7cc6f7754e/update.json
     *
     * ###Request body
     *
     *      {
     *        "name" : "Offers",
     *        "description" : "Our current special offers"
     *     }
     *
     * ###Response json
     *
     *      {
     *        "code": 200,
     *        "status": "OK",
     *        "message": "Tag updated!",
     *        "dateTime": "2017-04-11T10:24:10+0200",
     *        "scriptTimeSeconds": 0.0807,
     *        "tagUuid": "21c74e30-984c-4ecf-9b18-9b7cc6f7754e",
     *        "name": "Offers"
     *      }
     *
     * @ApiDoc(
     *  resource="PIM/Tag",
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
     * @Put("/v1/tag/{uuid}/update", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function updateTagAction(Request $request)
    {
        return $this->serviceManager->tag()->update()->version1()->handleRestRequest($request);
    }

    /**
     * ###Request (header)
     *
     *      Key                 | Value               | Description
     *      ------------------- | ------------------- | --------------------------------------
     *      username            |  (string)           | your username
     *      apiKey              |  (string)           | your apiKey
     *
     * ###Request example json
     *
     *      GET /api/v1/tag/721d8f81-c34d-4e74-87e8-3297d1d73c83/show.json
     *
     * ###Response body json
     *
     *     {
     *       "code": 200,
     *       "status": "OK",
     *       "dateTime": "2017-04-04T15:00:35+0200",
     *       "scriptTimeSeconds": 0.2344,
     *       "uuid": "784304f7-da76-4d30-bed4-2b614ba98a5b",
     *       "name": "Offer",
     *       "description": "Our special offers",
     *       "created": "2017-04-04T12:28:29+0200",
     *       "updated": "2017-04-04T12:28:29+0200"
     *     }
     *
     * @ApiDoc(
     *  resource="PIM/Tag",
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
     * @Get("/v1/tag/{uuid}/show", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function showTagAction(Request $request)
    {
        return $this->serviceManager->tag()->show()->version1()->handleRestRequest($request);
    }
}
