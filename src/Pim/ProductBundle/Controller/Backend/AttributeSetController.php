<?php

namespace Pim\ProductBundle\Controller\Backend;

use Pim\ProductBundle\Services\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\DiExtraBundle\Annotation\Inject;
use Pim\ProductBundle\Services\AttributeSet\Add\Version1\Form\AttributeSetType as AttributeSetTypeForm;
use Pim\ProductBundle\Services\AttributeSet\Update\Version1\Form\TagsType as UpdateAttributeSetTypeForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Pim\ProductBundle\Services\AttributeSet\Lists\Version1\Request\Request as ListRequestModel;
use Pim\ProductBundle\Services\AttributeSet\Delete\Version1\Request\Request as DeleteRequestModel;
use Pim\ProductBundle\Services\AttributeSet\Show\Version1\Request\Request as ShowRequestModel;
use Pim\ProductBundle\Services\AttributeSet\Update\Version1\Request\Request as UpdateRequestModel;

/**
 * Class ProductController
 * @package Pim\ProductBundle\Controller\Backend
 * @Route("/attribute/set")
 */
class AttributeSetController extends Controller
{
    /**
     * @Inject("knp_paginator")
     * @var \Knp\Component\Pager\Paginator
     */
    private $knpPaginator;

    /**
     * @Inject("pim_product.services.manager")
     * @var Manager
     */
    private $serviceManager;

    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @Route("/list", name="pim_attribute_set_backend_list")
     * @Template()
     */
    public function listAction(Request $request)
    {

        $requestModel = new ListRequestModel();
        $requestModel->setOffset((($request->query->get('page', 1) * 10) - 10));
        $requestModel->setLimit(20);
        $requestModel->setOrderBy($request->get('sort', 'name'));
        $requestModel->setOrderDir($request->get('direction', 'ASC'));
        $responseModel = $this->serviceManager->attributeSet()->list()->version1()->getProcessor()->run($requestModel);
        return [
            'pagination' => $this->knpPaginator->paginate($responseModel, $request->query->get('page', 1), 10),
        ];
    }

    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @Route("/add", name="pim_attribute_set_backend_add")
     * @Template()
     */
    public function addAction(Request $request)
    {
        $addForm = $this->createForm(AttributeSetTypeForm::class);
        $addForm->handleRequest($request);

        if ($addForm->isSubmitted() && $addForm->isValid()) {

            $requestModel = $addForm->getData();
            $response = $this->serviceManager->attributeSet()->add()->version1()->getProcessor()->run($requestModel);
            if ($response->getCode() !== Response::HTTP_OK) {
                foreach ($response->getErrors() as $error) {
                    $this->get('session')->getFlashBag()->add('error',
                        $error->getMessage() . "<br />" . $error->getException());
                }
            } else {
                $this->get('session')->getFlashBag()->add('success', 'AttributeSet Entry Created');
                return $this->redirect($this->generateUrl('pim_attribute_set_backend_list'));
            }
        }

        return ['add_form' => $addForm->createView()];
    }

    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @Route("/delete/{uuid}", name="pim_attribute_set_backend_delete", requirements={"uuid"})
     */
    public function deleteAction($uuid)
    {
        try {
            $requestModel = new DeleteRequestModel();
            $requestModel->setUuid($uuid);
            $this->serviceManager->attributeSet()->delete()->version1()->getProcessor()->run($requestModel);
            $this->get('session')->getFlashBag()->add('success', 'AttributeSet Entry Deleted!');
        } catch (\Exception $exc) {
            $this->get('session')->getFlashBag()->add('error', 'AttributeSet Entry Error!');
        }

        return $this->redirect($this->generateUrl('pim_attribute_set_backend_list'));
    }

    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @Route("/show/{uuid}", name="pim_attribute_set_backend_show", requirements={"uuid"})
     * @Template()
     */
    public function showAction($uuid)
    {
        try {
            $requestModel = new ShowRequestModel();
            $requestModel->setUuid($uuid);
            $response = $this->serviceManager->attributeSet()->show()->version1()->getProcessor()->run($requestModel);
        } catch (\Exception $exc) {
            $this->get('session')->getFlashBag()->add('error', 'AttributeSet Entry Error!');
            $this->redirect($this->generateUrl('pim_attribute_set_backend_list'));
        }

        return ['entity' => $response];
    }

    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @Route("/edit/{uuid}", name="pim_attribute_set_backend_edit", defaults={"uuid": "none"})
     * @Template()
     */
    public function editAction(Request $request, string $uuid)
    {
        //first get data
        $requestModel = new ShowRequestModel();
        $requestModel->setUuid($uuid);
        $responseShow = $this->serviceManager->attributeSet()->show()->version1()->getProcessor()->run($requestModel);

        $updateRequest = new UpdateRequestModel();
        $updateRequest->setUuid($responseShow->getUuid());
        $updateRequest->setName($responseShow->getName());
        $updateRequest->setAttributes($responseShow->getAttributes());

        $addForm = $this->createForm(UpdateAttributeSetTypeForm::class, $updateRequest);
        $addForm->handleRequest($request);

        if ($addForm->isSubmitted() && $addForm->isValid()) {

            $requestModel = $addForm->getData();
            $response = $this->serviceManager->attributeSet()->update()->version1()->getProcessor()->run($requestModel);
            if ($response->getCode() !== Response::HTTP_OK) {
                foreach ($response->getErrors() as $error) {
                    $this->get('session')->getFlashBag()->add('error',
                        $error->getMessage() . "<br />" . $error->getException());
                }
            } else {
                $this->get('session')->getFlashBag()->add('success', 'AttributeSet Entry Updated');
                return $this->redirect($this->generateUrl('pim_attribute_set_backend_list'));
            }
        }

        return ['edit_form' => $addForm->createView()];
    }
}
