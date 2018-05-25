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
use AppBundle\Entity\User;

/**
 * Class UserController
 * @Route("/app/user")
 * @package Pferdiathek\BackendBundle\Controller
 */
class UserController extends Controller
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
     * @Route("/list", name="app_user_list")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();
        return $this->render('user/index.html.twig', array(
            'users' => $users,
            'page_title' => 'User Management'
        ));
    }

    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @Route("/new", name="app_user_new")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $roles=[];
        foreach (array_keys($this->getParameter('security.role_hierarchy.roles')) as $role)
            $roles[$role]=$role;
        $form = $this->createForm('AppBundle\Form\UserType', $user)
            ->add('companies')
            ->add('Roles', ChoiceType::class, [
                    'choices' => $roles,
                    'multiple' => true,
                    'expanded' => true,
                    'label' => 'Roles (ROLE_USER added automatically)',
                    'required' => false
                ]
            )
       ;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('users_show', array('id' => $user->getId()));
        }
        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
            'page_title' => 'User Management'
        ));
    }

    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @Route("/{id}/show", name="app_user_show")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = $this->dbM->repository()->user()->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        // $deleteForm = $this->createDeleteForm($id);

        // return array(
        //     'entity' => $entity,
        //     'delete_form' => $deleteForm->createView()
        // );

        $deleteForm = $this->createDeleteForm($id);
        return $this->render('user/show.html.twig', array(
            'user' => $entity,
            'delete_form' => $deleteForm->createView(),
            'page_title' => 'User Management'
        ));
    }

    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @Route("/{id}/edit", name="app_user_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $entity = $this->dbM->repository()->user()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        // $editForm = $this->createForm(Form\UserType::class, $entity, ['roles' => $this->getUserRoleHierarchy()]);
        // $deleteForm = $this->createDeleteForm($id);

        // $editForm->handleRequest($request);

        // if ($editForm->isSubmitted() && $editForm->isValid()) {
        //     $em = $this->dbM->entityManager();
        //     $em->persist($entity);
        //     $em->flush();
        //     $this->get('session')->getFlashBag()->add('success', 'User Updated');
        //     return $this->redirect($this->generateUrl('app_user_edit', array('id' => $id)));
        // } else {
        //     foreach ($editForm->getErrors() as $error) {
        //         $this->get('session')->getFlashBag()->add('error', $error->getMessage());
        //     }
        // }

        // return array(
        //     'entity' => $entity,
        //     'edit_form' => $editForm->createView(),
        //     'delete_form' => $deleteForm->createView(),
        // );

        $deleteForm = $this->createDeleteForm($id);

        $user = $entity;//new User();
        $roles=[];
        foreach (array_keys($this->getParameter('security.role_hierarchy.roles')) as $role)
            $roles[$role]=$role;
        $editForm = $this->createForm('AppBundle\Form\UserType', $user)
            ->add('companies')
            ->add('Roles', ChoiceType::class, [
                    'choices' => $roles,
                    'multiple' => true,
                    'expanded' => true,
                    'label' => 'Roles (ROLE_USER added automatically)',
                    'required' => false
                ]
            )
            ->add('update', SubmitType::class, array('label' => 'Update User', 'attr' => ['class' => 'btn-success']))
       ;

        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('app_user_list', array('id' => $user->getId()));
        }
        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'page_title' => 'User Management'
        ));
    }

    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     * @Route("/{id}/delete", name="app_user_delete")
     * @Template()
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $this->get('session')->getFlashBag()->add('error', 'Delete is currently deactivated!');
        return $this->redirect($this->generateUrl('app_user_list'));
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->dbM()->pferdiathek()->getEntityManager();
            $entity = $this->dbM()->pferdiathek()->getRepository()->User()->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Delete Success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Delete Error');
        }

        return $this->redirect($this->generateUrl('pferdiathek_backend_user_list'));
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
                    'label' => 'Delete User',
                    'attr' => [
                        'class' => 'btn-danger',
                        'onclick' => 'return confirm(\'Really Delete?\')'
                    ]
                ]
            )
            ->getForm();
    }

    /**
     * @return array
     */
    private function getUserRoleHierarchy()
    {
        $roles = $this->container->getParameter('security.role_hierarchy.roles');
        return $roles ? $roles : array();
    }
}
