<?php

/**
 * all code by me
 *
 * @copyright  Stefan H.G. Buchhofer
 * @version    Release: 1.0.0
 * @link       www.ilenvo-media.de
 * @email      ilenvo@me.com
 * @year       2016
 *
 */

namespace AppBundle\Controller;

use AppBundle\Database\Manager as DatabaseManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\DiExtraBundle\Annotation\Inject;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\BusinessCenter;

/**
 * Class CenterController
 * @Route("/app/center")
 * @package Pferdiathek\BackendBundle\Controller
 */
class CenterController extends Controller
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
     * @Inject("app.database.manager")
     * @var DatabaseManager
     */
    private $dbM;

    /**
     * @Route("/list", name="app_center_list")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $centers = $em->getRepository('AppBundle:BusinessCenter')->findAll();
        return $this->render('center/index.html.twig', array(
            'centers' => $centers,
            'page_title' => 'Business Center Management'
        ));
    }

    /**
     * @Route("/new", name="app_center_new")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $center = new BusinessCenter();
        $form = $this->createForm('AppBundle\Form\CenterType', $center);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($center);
            $em->flush();
            return $this->redirectToRoute('app_center_show', array('id' => $center->getId()));
        }
        return $this->render('center/new.html.twig', array(
            'center' => $center,
            'form' => $form->createView(),
            'page_title' => 'Business Center Management'
        ));
    }

    /** 
     * @Route("/{id}/show", name="app_center_show")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = $this->dbM->repository()->center()->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Business Center entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        return $this->render('center/show.html.twig', array(
            'center' => $entity,
            'page_title' => 'Business Center Management'
        ));
    }

    /**
     * @Route("/{id}/edit", name="app_center_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $entity = $this->dbM->repository()->center()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Business Center entity.');
        }

        
        $center = $entity;
        
        $editForm = $this->createForm('AppBundle\Form\CenterType', $center)
            ->add('update', SubmitType::class, array('label' => 'Update Business center', 'attr' => ['class' => 'btn-success']))
       ;

        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('app_center_list', array('id' => $center->getId()));
        }
        return $this->render('center/edit.html.twig', array(
            'center' => $center,
            'edit_form' => $editForm->createView(),
            'page_title' => 'Business Center Management'
        ));
    }

    /**
     * @Route("/{id}/delete", name="app_center_delete")
     * @Template()
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $this->get('session')->getFlashBag()->add('error', 'Delete is currently deactivated!');
        return $this->redirect($this->generateUrl('app_center_list'));
    }

    /**
     * @param integer $id
     * @return \Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', HiddenType::class)
            ->add('update', FormType\SubmitType::class, [
                    'label' => 'Delete Center',
                    'attr' => [
                        'class' => 'btn-danger',
                        'onclick' => 'return confirm(\'Really Delete?\')'
                    ]
                ]
            )
            ->getForm();
    }
}
