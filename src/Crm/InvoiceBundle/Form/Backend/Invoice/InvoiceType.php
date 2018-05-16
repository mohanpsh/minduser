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

use Crm\InvoiceBundle\Entity\Invoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class InvoiceType
 * @package Crm\InvoiceBundle\Form\Backend\Invoice
 */
class InvoiceType extends AbstractType
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
            ->add('customerId', FormType\TextType::class)
            ->add('locale', FormType\TextType::class)
            ->add('currency', FormType\TextType::class)
            ->add('invoiceId', FormType\TextType::class)
            ->add('invoiceDate', FormType\DateTimeType::class)
            ->add('paymentTransactionId')
            ->add('paymentProvider')
            ->add('paymentMethod')
            ->add('paymentAccount')
            ->add('paymentStatus')
            ->add('netPriceTotal')
            ->add('grossPriceTotal')
            ->add('vatPriceTotal')
            ->add('footerOne')
            ->add('footerTwo')
            ->add('invoiceNotes', FormType\TextareaType::class)
            ->add('cancellation')
            ->add('cancellationPdfName')
            ->add('pdfName')
            ->add('pdfName')
            ->add('created')
            ->add('updated')
            ->add('recipient', RecipientType::class)
            ->add('invoicePositions', FormType\CollectionType::class, array(
                'entry_type' => InvoicePositionType::class,
                'allow_add' => true,
                'allow_delete' => true
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Invoice::class
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'invoice_bundle_invoice';
    }
}
