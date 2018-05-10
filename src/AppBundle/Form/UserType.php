<?php

/**
 * all code by me
 *
 * @copyright  Stefan H.G. Buchhofer
 * @version    Release: 1.0.0
 * @link       www.ilenvo-media.de
 * @email      ilenvo@me.com
 * @year       2017
 *
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\User as UserEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Class UserType
 * @package Pferdiathek\BackendBundle\Form
 */
class UserType extends AbstractType
{

    /**
     * @var array
     */
    private $roleHierarchy;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->roleHierarchy = $options['roles'] ? $options['roles'] : [];
        $builder->add('email', FormType\EmailType::class, ['required' => true])
            ->add('emailCanonical', FormType\EmailType::class, ['required' => true])
            ->add('username', FormType\TextType::class, ['required' => true])
            ->add('usernameCanonical', FormType\TextType::class, ['required' => true])
            ->add('enabled', FormType\CheckboxType::class, ['required' => false])
            ->add('firstName', FormType\TextType::class, ['required' => false])
            ->add('lastName', FormType\TextType::class, ['required' => false])
            ->add('apiKey', FormType\TextType::class, ['required' => false])
            ->add('Roles', FormType\ChoiceType::class, [
                    'choices' => $this->getExistingRoles(),
                    'multiple' => true,
                    'expanded' => true,
                    'label' => 'Roles (ROLE_USER added automatically)',
                    'required' => false
                ]
            )
            ->add('lastLogin', FormType\DateTimeType::class, ['required' => false])
            ->add('update', FormType\SubmitType::class, array('label' => 'Update User', 'attr' => ['class' => 'btn-success']))
        ;

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UserEntity::class,
            'roles' => null
        ));
    }

    /**
     * @return array
     */
    protected function getExistingRoles()
    {
        $roles = array_keys($this->roleHierarchy);
        return array_combine($roles, $roles);
    }
}
