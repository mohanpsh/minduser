<?php

/**
 * all code by me
 *
 * @copyright  Stefan H.G. Buchhofer
 * @version    Release: 1.0.0
 * @link       www.ilenvo-media.de
 * @email      ilenvo@me.com
 * @year       2018
 */

namespace Crm\InvoiceBundle\Form\Backend\Invoice;

use Crm\InvoiceBundle\Entity\InvoicePosition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class InvoicePositionType
 * @package Crm\InvoiceBundle\Form\Backend\Invoice
 */
class InvoicePositionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', FormType\TextType::class, array(
                'attr' => array(
                    'readonly' => true,
                )
            ))
            ->add('sku')
            ->add('title')
            ->add('descriptionOne')
            ->add('descriptionTwo')
            ->add('descriptionImage')
            ->add('quantity')
            ->add('netPrice')
            ->add('grossPrice')
            ->add('netPriceTotal')
            ->add('grossPriceTotal')
            ->add('vatRate')
            ->add('vatPrice')
            ->add('vatPriceTotal');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => InvoicePosition::class
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'invoice_bundle_invoice_position';
    }
}
