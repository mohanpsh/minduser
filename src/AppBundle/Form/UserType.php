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

use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\User as UserEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Class UserType
 * @package AppBundle\Form
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
            ->add('username', FormType\TextType::class, ['required' => true])
            ->add('enabled', FormType\CheckboxType::class, ['required' => false])
            ->add('firstName', FormType\TextType::class, ['required' => false])
            ->add('lastName', FormType\TextType::class, ['required' => false])
            ->add('title', FormType\TextType::class, ['required' => false])
            ->add('adress', FormType\TextType::class, ['required' => false])
            ->add('plz', FormType\TextType::class, ['required' => false])
            ->add('city', FormType\TextType::class, ['required' => false])
            ->add('telephone', FormType\TextType::class, ['required' => false])
       ;
    }
    public function getParent()
    {
        return RegistrationFormType::class;
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
