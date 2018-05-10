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
class AttributeSetController extends FOSRestController
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
     * ###Response body json
     *
     *     {
     *        "code": 200,
     *        "status": "OK",
     *        "dateTime": "2017-04-04T12:33:05+0200",
     *        "scriptTimeSeconds": 0.0893,
     *        "attributeSetId": "c3cdda04-e454-4602-bce0-b9168e3191db",
     *        "name": "Buecher1"
     *      }
     *
     * @ApiDoc(
     *  resource="PIM/AttributeSet",
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
     * @Post("/v1/attributeSet/add", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function addAttributeSetAction(Request $request)
    {
        return $this->serviceManager->attributeSet()->add()->version1()->handleRestRequest($request);
    }

    /**
     * ###Request (header)
     *
     *      Key                 | Value               | Description
     *      ------------------- | ------------------- | --------------------------------------
     *      username            |  (string)           | your username
     *      apiKey              |  (string)           | your apiKey
     *
     * ###Request URL
     *
     *      GET /api/v1/attributeSet/list.json?offset=0&limit=3&orderBy=name&orderDir=DESC
     *
     * ###Response body json
     *
     *     {
     *       "code": 200,
     *       "status": "OK",
     *       "dateTime": "2017-04-04T15:00:35+0200",
     *       "scriptTimeSeconds": 0.2344,
     *       "offset": 0,
     *       "limit": 20,
     *       "count": 2,
     *       "orderBy": "created",
     *       "orderDir": "ASC",
     *       "attributeSets": [
     *         {
     *           "uuid": "784304f7-da76-4d30-bed4-2b614ba98a5b",
     *           "name": "Bücher",
     *           "created": "2017-04-04T12:28:29+0200",
     *           "updated": "2017-04-04T12:28:29+0200",
     *           "attributes": [
     *             "ISBN",
     *             "Seiten",
     *             "Autor"
     *           ]
     *         },
     *         {
     *           "uuid": "5c5a0a21-d61b-4b7c-9fba-8ad291d4aa70",
     *           "name": "Videos",
     *           "created": "2017-04-04T12:31:27+0200",
     *           "updated": "2017-04-04T12:31:27+0200",
     *           "attributes": [
     *             "Länge",
     *             "Qualität",
     *             "Autor"
     *           ]
     *         }
     *       ]
     *     }
     *
     * @ApiDoc(
     *  resource="PIM/AttributeSet",
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
     *      "class" = "Pim\ProductBundle\Services\AttributeSet\Lists\Version1\Request\Request"
     * },
     *  tags={
     *      "stable" = "#000"
     *  }
     * )
     * @Get("/v1/attributeSet/list", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function listAttributeSetsAction(Request $request)
    {
        return $this->serviceManager->attributeSet()->list()->version1()->handleRestRequest($request);
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
     *      /api/v1/attributeSet/delete/c4f8ccbf-d895-4af5-9d50-479e7f1e5a42.json
     *
     * ###Response json
     *
     *      {
     *       "code": 200,
     *       "status": "OK",
     *       "message": "AttributeSet deleted!",
     *       "dateTime": "2017-04-09T15:31:15+0200",
     *       "scriptTimeSeconds": 0.2549
     *      }
     *
     * @ApiDoc(
     *  resource="PIM/AttributeSet",
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
     * @Delete("/v1/attributeSet/{uuid}/delete", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function deleteAttributeSetAction(Request $request)
    {
        return $this->serviceManager->attributeSet()->delete()->version1()->handleRestRequest($request);
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
     *      PUT /api/v1/attributeSet/21c74e30-984c-4ecf-9b18-9b7cc6f7754e/update.json
     *
     * ###Request body
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
     * ###Response json
     *
     *      {
     *        "code": 200,
     *        "status": "OK",
     *        "message": "AttributeSet updated!",
     *        "dateTime": "2017-04-11T10:24:10+0200",
     *        "scriptTimeSeconds": 0.0807,
     *        "attributeSetId": "21c74e30-984c-4ecf-9b18-9b7cc6f7754e",
     *        "name": "Bücher"
     *      }
     *
     * @ApiDoc(
     *  resource="PIM/AttributeSet",
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
     * @Put("/v1/attributeSet/{uuid}/update", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function updateAttributeSetAction(Request $request)
    {
        return $this->serviceManager->attributeSet()->update()->version1()->handleRestRequest($request);
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
     *      GET /api/v1/attributeSet/721d8f81-c34d-4e74-87e8-3297d1d73c83/show.json
     *
     * ###Response body json
     *
     *     {
     *       "code": 200,
     *       "status": "OK",
     *       "dateTime": "2017-04-04T15:00:35+0200",
     *       "scriptTimeSeconds": 0.2344,
     *       "uuid": "784304f7-da76-4d30-bed4-2b614ba98a5b",
     *       "name": "Bücher",
     *       "created": "2017-04-04T12:28:29+0200",
     *       "updated": "2017-04-04T12:28:29+0200",
     *       "attributes": [
     *         "ISBN",
     *         "Seiten",
     *         "Autor"
     *       ]
     *     }
     *
     * @ApiDoc(
     *  resource="PIM/AttributeSet",
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
     * @Get("/v1/attributeSet/{uuid}/show", name="_v1", options={ "method_prefix" = true })
     * @Secure(roles="ROLE_API")
     * @param Request $request
     * @return Response
     */
    public function showAttributeSetAction(Request $request)
    {
        return $this->serviceManager->attributeSet()->show()->version1()->handleRestRequest($request);
    }
}
