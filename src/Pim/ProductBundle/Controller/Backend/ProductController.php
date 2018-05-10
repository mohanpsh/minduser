<?php

namespace Pim\ProductBundle\Controller\Backend;

use Pim\ProductBundle\Services\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\DiExtraBundle\Annotation\Inject;
use Pim\ProductBundle\Services\Product\Add\Version1\Form\ProductType as ProductTypeForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Pim\ProductBundle\Services\Product\Lists\Version1\Request\Request as ListRequestModel;

/**
 * Class ProductController
 * @package Pim\ProductBundle\Controller\Backend
 * @Route("/product")
 */
class ProductController extends Controller
{
    /**
     * @Inject("form.factory")
     * @var \Symfony\Component\Form\FormFactory
     */
    private $formFactory;

    /**
     * @Inject("lexik_form_filter.query_builder_updater")
     * @var \Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderUpdater
     */
    private $lexikFilterUpdater;

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
     * @Route("/list", name="pim_product_backend_list")
     * @Template()
     */
    public function listAction(Request $request)
    {

        $requestModel = new ListRequestModel();
        $requestModel->setOffset((($request->query->get('page', 1) * 10) - 10));
        $requestModel->setLimit(20);
        $requestModel->setOrderBy($request->get('sort', 'title'));
        $requestModel->setOrderDir($request->get('direction', 'ASC'));
        $responseModel = $this->serviceManager->product()->lists()->version1()->getProcessor()->run($requestModel);

        return [
            'pagination' => $this->knpPaginator->paginate($responseModel, $request->query->get('page', 1), 10),
        ];
    }

    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @Route("/add", name="pim_product_backend_add")
     * @Template()
     */
    public function addAction(Request $request)
    {
        $addForm = $this->createForm(ProductTypeForm::class);

        $addForm->handleRequest($request);
        if ($addForm->isSubmitted() && $addForm->isValid()) {
            $response = $this->serviceManager->product()->add()->version1()->getProcessor()->run($addForm->getData());
            if ($response->getCode() !== Response::HTTP_OK) {
                foreach ($response->getErrors() as $error) {
                    $this->get('session')->getFlashBag()->add('error',
                        $error->getMessage() . "<br />" . $error->getException());
                }
            } else {
                $this->get('session')->getFlashBag()->add('success', 'Product Entry Created');
                return $this->redirect($this->generateUrl('pim_product_backend_list'));
            }
        }

        return ['add_form' => $addForm->createView()];
    }
}
