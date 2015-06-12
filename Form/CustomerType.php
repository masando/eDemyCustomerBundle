<?php

namespace eDemy\CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use eDemy\CustomerBundle\Entity\Customer;

class CustomerType extends AbstractType
{
    private $customer;

    public function __construct(Customer $customer = null)
    {
        $this->customer = $customer;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type', 'choice', array(
            'choices'   => $this->customer->getTypeChoices(),
            'required'  => true,
            'multiple'  => false,
            'expanded'  => true,
            //'empty_value' => 'Selecciona...',
        ));
        $builder->add('empresa', null, ['label' => 'edit_customer.empresa']);
        $builder->add('nombre', null, ['label' => 'edit_customer.nombre']);
        $builder->add('apellido1', null, ['label' => 'edit_customer.apellido1']);
        $builder->add('apellido2', null, ['label' => 'edit_customer.apellido2']);
        $builder->add('nif', null, ['label' => 'edit_customer.nif']);
        $builder->add('phone', null, ['label' => 'edit_customer.phone']);
        $builder->add('email', null, ['label' => 'edit_customer.email']);
        $builder->add('enviar', 'submit');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'eDemy\CustomerBundle\Entity\Customer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'edemy_customerbundle_customer';
    }
}
