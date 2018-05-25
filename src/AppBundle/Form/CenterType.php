<?php

/**
 * all code by me
 *
 * @version    Release: 1.0.0
 * @year       2018
 *
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\BusinessCenter as BusinessEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Class CenterType
 * @package AppBundle\Form
 */
class CenterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('city', FormType\TextType::class, ['required' => true])
            ->add('address', FormType\TextType::class, ['required' => false])
            ->add('pincode', FormType\TextType::class, ['required' => false])
            ->add('phonenumber', FormType\TextType::class, ['required' => false])
       ;
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'business_center';
    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => BusinessEntity::class
        ));
    }
}
