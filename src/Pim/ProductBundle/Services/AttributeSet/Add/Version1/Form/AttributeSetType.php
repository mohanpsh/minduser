<?php

/**
 * all code by me
 *
 * @copyright  Stefan Buchhofer
 * @version    Release: 1.0.0
 * @link       www.ilenvo-media.de
 * @email      ilenvo@me.com
 * @year       2015
 *
 */

namespace Pim\ProductBundle\Services\AttributeSet\Add\Version1\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Pim\ProductBundle\Services\AttributeSet\Add\Version1\Request\Request as RequestModel;

/**
 * Class AttributeSetType
 * @package Pim\ProductBundle\Services\AttributeSet\Add\Version1\Form
 */
class AttributeSetType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('attributes', FormType\CollectionType::class, array(
                'allow_add' => true,
                'allow_delete' => true,
                'mapped' => true,
                'entry_options' => array(
                    'label' => 'name[]'
                ),
            ))
            ->add('save', SubmitType::class, [
                    'label' => 'save'
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => RequestModel::class
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'pim_attribute_set_backend_add';
    }
}
