<?php

namespace eDemy\CustomerBundle\Controller;

use eDemy\MainBundle\Controller\BaseController;
use eDemy\MainBundle\Event\ContentEvent;
use eDemy\MainBundle\Event\MainEvents;

use eDemy\CustomerBundle\Entity\Customer;
use eDemy\CustomerBundle\Form\CustomerType;
use eDemy\CustomerBundle\Form\CustomerContactType;
use eDemy\CustomerBundle\Form\CustomerRegistrationType;

class CustomerController extends BaseController
{
    public static function getSubscribedEvents()
    {
        return self::getSubscriptions('customer', ['customer'], array(
            //'edemy_product_product_details' => array('onProductDetails', 0),
            //'edemy_product_product_details_lastmodified' => array('onProductDetailsLastModified', 0),
            //'edemy_product_category_details' => array('onCategoryDetails', 0),
            //'edemy_product_category_details_lastmodified' => array('onCategoryDetailsLastModified', 0),
        ));
    }

    public function onFrontpage(ContentEvent $event)
    {
        $request = $this->get('request_stack')->getCurrentRequest();
        
        $this->get('edemy.meta')->setTitlePrefix("Formulario de Alta");
        $customer = new Customer($this->get('doctrine.orm.entity_manager'));

        $form = $this->get('form.factory')->create(new CustomerType($customer), $customer, array(
            'action' => $this->get('router')->generate($_target_path, array(
            )),
            'method' => 'POST',
        ));
        $form->handleRequest($request);

        if ($form->isValid()) {
            if($customer->getNamespace() == null) {
                $customer->setNamespace($this->getNamespace());
            }
            //buscar un usuario con ese nif. si no existe crearlo y asociarlo
            //die(var_dump($customer));
            $this->get('doctrine.orm.entity_manager')->persist($customer);
            $this->get('doctrine.orm.entity_manager')->flush();

            $event->setContent($this->newRedirectResponse('edemy_customer_frontpage', array()));
            $event->stopPropagation();

            return true;
        }

        $this->addEventModule($event, "new_customer.html.twig", array(
            'entity' => $customer,
            'form' => $form->createView(),
        ));
    }
    
    public function getRegistrationForm($_target_path)
    {
        $customer = new Customer($this->get('doctrine.orm.entity_manager'));

        $form = $this->get('form.factory')->create(new CustomerRegistrationType($customer), $customer, array(
            'action' => $this->get('router')->generate($_target_path, array(
            )),
            'method' => 'POST',
        ));
        
        return $form;
    }

    public function getContactForm($_target_path = null)
    {
        $customer = new Customer($this->get('doctrine.orm.entity_manager'));
        $action = $this->get('router')->generate($_target_path, array());
        $form = $this->get('form.factory')->create(new CustomerContactType($customer), $customer, array(
            'action' => $action, 
            'method' => 'POST',
        ));
        
        return $form;
    }
}
