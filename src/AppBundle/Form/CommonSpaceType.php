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
use AppBundle\Entity\CommonSpace as CommonSpaceEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Class CommonSpaceType
 * @package AppBundle\Form
 */
class CommonSpaceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('doorId', FormType\TextType::class, ['required' => false])
            ->add('doorDescription', FormType\TextType::class, ['required' => false])
       ;
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'common_space';
    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CommonSpaceEntity::class
        ));
    }
}
