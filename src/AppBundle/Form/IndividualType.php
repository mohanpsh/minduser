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

//use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Individual as IndividualEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Class IndividualType
 * @package AppBundle\Form
 */
class IndividualType extends AbstractType
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
        $builder->add('email', FormType\EmailType::class, ['required' => true])
            //->add('username', FormType\TextType::class, ['required' => true])
            //->add('enabled', FormType\CheckboxType::class, ['required' => false])
            ->add('nameFirst', FormType\TextType::class, ['required' => false])
            ->add('nameLast', FormType\TextType::class, ['required' => false])
            ->add('titel', FormType\TextType::class, ['required' => false])
            ->add('address', FormType\TextType::class, ['required' => false])
            ->add('plz', FormType\TextType::class, ['required' => false])
            ->add('city', FormType\TextType::class, ['required' => false])
            ->add('tel', FormType\TextType::class, ['required' => false])
       ;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'individual';
    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => IndividualEntity::class
        ));
    }
}
