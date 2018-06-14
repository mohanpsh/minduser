<?php

/**
 * all code by me
 *
 * @copyright  Mohan P sharma
 * @version    Release: 1.0.0
 * @year       2018
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
use AppBundle\Entity\Individual;
use AppBundle\Entity\User;

/**
 * Class IndividualController
 * @Route("/app/individual")
 * @package Pferdiathek\BackendBundle\Controller
 */
class IndividualController extends Controller
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
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @Route("/list", name="app_individual_list")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $individuals = $em->getRepository('AppBundle:Individual')->findAll();
        $tabs = array(['title' => 'Individuals','url' => ('app_individual_list'),'active'=>true],
                        ['title' => 'Companies' , 'url' => ('company_index'),'active'=>false]);
        $activeTab = ['title' => 'Individuals List','url' => ('app_individual_new')];
        return $this->render('individual/index.html.twig', array(
            'individuals' => $individuals,
            'page_title' => 'Individuals Management',
            'tabs' => $tabs,
            'activeTab' => $activeTab,
        ));
    }

    /**
     * @Route("/new", name="app_individual_new")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $individual = new Individual();
        $form = $this->createForm('AppBundle\Form\IndividualType', $individual)
            ->add('companies')
       ;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($individual);
            $em->flush();
            return $this->redirectToRoute('app_individual_show', array('id' => $individual->getId()));
        }
        return $this->render('individual/new.html.twig', array(
            'individual' => $individual,
            'form' => $form->createView(),
            'page_title' => 'Individuals Management'
        ));
    }

    /**
     * @Route("/{id}/show", name="app_individual_show")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = $this->dbM->repository()->individual()->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Individual entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        return $this->render('individual/show.html.twig', array(
            'individual' => $entity,
            'delete_form' => $deleteForm->createView(),
            'page_title' => 'Individuals Management'
        ));
    }

    /**
     * @Route("/{id}/edit", name="app_individual_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $entity = $this->dbM->repository()->individual()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Individual entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $userForm =  false;
        $repository = $this->getDoctrine()->getRepository(User::class);
        // look for a single User by email
        $user = $repository->findOneBy(['email' => $entity->getEmail()]);

        if(empty($user)) {
            $userForm = $this->createUserForm($id);
            $userForm = $userForm->createView();
        }
        

        $individual = $entity;
        $roles=[];
        foreach (array_keys($this->getParameter('security.role_hierarchy.roles')) as $role)
            $roles[$role]=$role;
        $editForm = $this->createForm('AppBundle\Form\IndividualType', $individual)
            ->add('companies')
            ->add('update', SubmitType::class, array('label' => 'Update Individual', 'attr' => ['class' => 'btn-success']))
       ;

        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('app_individual_list', array('id' => $individual->getId()));
        }
        return $this->render('individual/edit.html.twig', array(
            'individual' => $individual,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'user_form' => $userForm,
            'page_title' => 'Individuals Management'
        ));
    }

    /**
     * @Route("/{id}/delete", name="app_individual_delete")
     * @Template()
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $this->get('session')->getFlashBag()->add('error', 'Delete is currently deactivated!');
        return $this->redirect($this->generateUrl('app_individual_list'));
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
                    'label' => 'Delete Individual',
                    'attr' => [
                        'class' => 'btn-danger',
                        'onclick' => 'return confirm(\'Really Delete?\')'
                    ]
                ]
            )
            ->getForm();
    }

    /**
     * Deletes a company entity.
     *
     * @Route("/{id}/makeuser", name="app_individual_makeuser")
     */
    public function makeuserAction(Request $request, $id)
    {
        $entity = $this->dbM->repository()->individual()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Individual entity.');
        }

        $individual = $entity;
        $form = $this->createUserForm($id);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            echo $entity->getEmail();

            $entityManager = $this->getDoctrine()->getManager();

            $user = new User();

            $user->setUsername($entity->getEmail());
            $user->setAdress($entity->getAddress());
            $user->setCompanies($entity->getCompanies());
            $user->setCity($entity->getCity());
            $user->setPlz($entity->getPlz());
            $user->setTitle($entity->getTitel());
            $user->setTelephone($entity->getTel());
            $user->setFirstName($entity->getNameFirst());
            $user->setLastName($entity->getNameLast());
            $user->setEmail($entity->getEmail());
            $user->setPassword($this->generateRandomString());

            $entityManager->persist($user);

            $entityManager->flush();


            $entityManager = $this->getDoctrine()->getManager();
            $individual = $entityManager->getRepository(Individual::class)->find($id);

            $individual->setUserid($user->getId());
            $entityManager->flush();

            return $this->redirectToRoute('app_user_list');
        }
        return $this->redirectToRoute('app_individual_list');
    }
    /**
     * Creates a form to make user entity.
     *
     * @param $id The individual id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createUserForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_individual_makeuser', array('id' => $id)))
            ->setMethod('POST')
            ->getForm()
        ;
    }

    /**
     *
     * @param $length Length of password
     *
     * @return String
     */
    public function generateRandomString($length = 16, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
