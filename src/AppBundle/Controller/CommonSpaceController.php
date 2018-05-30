<?php

/**
 * all code by me
 *
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
use AppBundle\Entity\CommonSpace;

/**
 * Class CommonSpaceController
 * @Route("/app/common")
 * @package Pferdiathek\BackendBundle\Controller
 */
class CommonSpaceController extends Controller
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
     * @Route("/list", name="app_common_list")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $spaces = $em->getRepository('AppBundle:CommonSpace')->findAll();
        return $this->render('commonspace/index.html.twig', array(
            'spaces' => $spaces,
            'page_title' => 'Common Space Management'
        ));
    }

    /**
     * @Route("/new", name="app_common_new")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $commonspace = new CommonSpace();
        $form = $this->createForm('AppBundle\Form\CommonSpaceType', $commonspace)
                ->add('center');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commonspace);
            $em->flush();
            return $this->redirectToRoute('app_common_show', array('id' => $commonspace->getId()));
        }
        return $this->render('commonspace/new.html.twig', array(
            'commonspace' => $commonspace,
            'form' => $form->createView(),
            'page_title' => 'Common Space Management'
        ));
    }

    /** 
     * @Route("/{id}/show", name="app_common_show")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = $this->dbM->repository()->commonspace()->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Business Common Space entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        return $this->render('commonspace/show.html.twig', array(
            'commonspace' => $entity,
            'page_title' => 'Common Space Management'
        ));
    }

    /**
     * @Route("/{id}/edit", name="app_common_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $entity = $this->dbM->repository()->commonspace()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Business Center entity.');
        }

        
        $commonspace = $entity;
        
        $editForm = $this->createForm('AppBundle\Form\CommonSpaceType', $commonspace)
            ->add('center')
            ->add('update', SubmitType::class, array('label' => 'Update Common Space', 'attr' => ['class' => 'btn-success']))
       ;

        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('app_common_list', array('id' => $commonspace->getId()));
        }
        return $this->render('commonspace/edit.html.twig', array(
            'commonspace' => $commonspace,
            'edit_form' => $editForm->createView(),
            'page_title' => 'Common Space Management'
        ));
    }

    /**
     * @Route("/{id}/delete", name="app_common_delete")
     * @Template()
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $this->get('session')->getFlashBag()->add('error', 'Delete is currently deactivated!');
        return $this->redirect($this->generateUrl('app_common_list'));
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
                    'label' => 'Delete Common Space',
                    'attr' => [
                        'class' => 'btn-danger',
                        'onclick' => 'return confirm(\'Really Delete?\')'
                    ]
                ]
            )
            ->getForm();
    }
}
