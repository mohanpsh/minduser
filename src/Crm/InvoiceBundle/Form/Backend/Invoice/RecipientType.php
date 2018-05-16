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

use Crm\InvoiceBundle\Entity\InvoiceRecipient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RecipientType
 * @package Crm\InvoiceBundle\Form\Backend\Invoice
 */
class RecipientType extends AbstractType
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
            ->add('customerId')
            ->add('userId')
            ->add('salutation')
            ->add('firstName')
            ->add('lastName')
            ->add('company')
            ->add('street')
            ->add('zip')
            ->add('city')
            ->add('country')
            ->add('email')
            ->add('telephoneNumber')
            ->add('birthday')
            ->add('gender');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => InvoiceRecipient::class
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'invoice_bundle_invoice_recipient';
    }
}
