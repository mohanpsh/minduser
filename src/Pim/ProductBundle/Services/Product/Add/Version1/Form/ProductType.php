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

namespace Pim\ProductBundle\Services\Product\Add\Version1\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Pim\ProductBundle\Services\Product\Add\Version1\Request\Request as RequestModel;

/**
 * Class ProductType
 * @package Pim\ProductBundle\Services\Product\Add\Version1\Form
 */
class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sku')
            ->add('language')
            ->add('seoUrl')
            ->add('canonicalUrl')
            ->add('title')
            ->add('subTitle')
            ->add('shortDesc', FormType\TextareaType::class, array(
                'attr' => array(
                    'class' => 'tinymce',
                    'data-theme' => 'advanced'
                )
            ))
            ->add('longDesc', FormType\TextareaType::class, array(
                'attr' => array(
                    'class' => 'tinymce',
                    'data-theme' => 'advanced'
                )
            ))
            ->add('priceNetto')
            ->add('priceBrutto')
            ->add('priceVAT')
            ->add('reducible')
            ->add('inStock')
            ->add('deliveryTimeInDays')
            ->add('attributes', FormType\CollectionType::class, array(
                'entry_type' => AttributeType::class,
                'allow_add' => true,
                'mapped' => true
            ))
            ->add('active')
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
        return 'pim_product_backend_add';
    }
}
