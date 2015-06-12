<?php

namespace eDemy\CustomerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use eDemy\MainBundle\Entity\BaseEntity;

/**
 * @ORM\Table("CustomerAddress")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="CustomerRepository")
 */
class Address extends BaseEntity implements Translatable
{
    public function __construct($em = null)
    {
        parent::__construct($em);
    }

    public function __toString()
    {
        return $this->getAddressString();
    }

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="type", type="array")
     */
    protected $type;

    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getTypeChoices($key = null){
        $choices = array(
            'particular' => 'Particular', 
            'shipping' => 'Envío',
            'invoice' => 'Facturación',
        );
        return $this->devuelve($choices, $key);
    }

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="zip", type="string", length=5)
     */
    private $zip;

    public function setZip($zip)
    {
        $this->zip = $zip;
    
        return $this;
    }

    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="addresses")
     */
    protected $customer;

    public function setCustomer(Customer $customer = null)
    {
        $this->customer = $customer;
    
        return $this;
    }

    public function getCustomer()
    {
        return $this->customer;
    }
}
