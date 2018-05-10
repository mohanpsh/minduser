<?php

/**
 * all code by me
 *
 * @copyright  Stefan H.G. Buchhofer
 * @version    Release: 1.0.0
 * @link       www.ilenvo-media.de
 * @email      ilenvo@me.com
 * @year       2017
 */

namespace Pim\ProductBundle\Services\Product\Add\Version1\Form;

use Pim\ProductBundle\Services\Product\Add\Version1\Request\Attribute as AttributeModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as FormType;

/**
 * Class AttributeType
 * @package Pim\ProductBundle\Services\Product\Add\Version1\Form
 */
class AttributeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('section')
            ->add('name')
            ->add('value')
            ->add('addPrice')
            ->add('multiple');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => AttributeModel::class,
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'pim_product_backend_add_attribute';
    }
}
