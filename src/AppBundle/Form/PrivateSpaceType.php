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
use AppBundle\Entity\PrivateSpace as PrivateSpaceEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Class PrivateSpaceType
 * @package AppBundle\Form
 */
class PrivateSpaceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('roomNumber', FormType\TextType::class, ['required' => false])
            ->add('doorId', FormType\TextType::class, ['required' => false])
            ->add('typeOfRoom', FormType\TextType::class, ['required' => false])
       ;
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'private_space';
    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => PrivateSpaceEntity::class
        ));
    }
}
