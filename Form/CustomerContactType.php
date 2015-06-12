<?php

namespace eDemy\CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use eDemy\CustomerBundle\Entity\Customer;

class CustomerContactType extends AbstractType
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
            'label'     => 'Tipo de cliente',
            //'empty_value' => 'Selecciona...',
        ));
        $builder->add('empresa', null, ['label' => 'Empresa']);
        $builder->add('nombre', null, ['label' => 'Nombre']);
        $builder->add('apellido1', null, ['label' => 'Apellido1']);
        $builder->add('apellido2', null, ['label' => 'Apellido2']);
        $builder->add('nif', null, ['label' => 'NIF']);
        $builder->add('phone', null, ['label' => 'Teléfono']);
        $builder->add('email', null, ['label' => 'Email']);
        /*
        $builder->add('password', 'password', array(
            'label' => 'edit_customer.password',
            'mapped' => false,
        ));
        */
        $builder->add('mensaje', 'textarea', array(
            'label' => 'Mensaje',
            'mapped' => false,
        ));
        $builder->add('Enviar', 'submit');
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
