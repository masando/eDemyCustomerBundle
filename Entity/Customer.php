<?php

namespace eDemy\CustomerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use eDemy\MainBundle\Entity\BaseEntity;
use eDemy\CustomerBundle\Validator as CustomerAssert;

/**
 * @ORM\Table("Customer")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="eDemy\CustomerBundle\Entity\CustomerRepository")
 */
class Customer extends BaseEntity implements Translatable
{
    public function __construct($em)
    {
        parent::__construct($em);
        $this->address = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNombreCompleto();
    }

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="empresa", type="string", length=255, nullable=true)
     */
    protected $empresa;

    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    
        return $this;
    }

    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function showEmpresaInPanel()
    {
        return true;
    }

    public function showEmpresaInForm()
    {
        return true;
    }

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    protected $nombre;

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function showNombreInPanel()
    {
        return true;
    }

    public function showNombreInForm()
    {
        return true;
    }

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="apellido1", type="string", length=255, nullable=true)
     */
    protected $apellido1;

    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;
    
        return $this;
    }

    public function getApellido1()
    {
        return $this->apellido1;
    }

    public function showApellido1InPanel()
    {
        return true;
    }

    public function showApellido1InForm()
    {
        return true;
    }

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="apellido2", type="string", length=255, nullable=true)
     */
    protected $apellido2;

    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;
    
        return $this;
    }

    public function getApellido2()
    {
        return $this->apellido2;
    }

    public function showApellido2InPanel()
    {
        return true;
    }

    public function showApellido2InForm()
    {
        return true;
    }

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="nif", type="string", length=9, nullable=true)
     * @CustomerAssert\NIF
     */
    protected $nif;

    public function setNif($nif)
    {
        $this->nif = $nif;
    
        return $this;
    }

    public function getNif()
    {
        return $this->nif;
    }

    public function showNifInPanel()
    {
        return true;
    }

    public function showNifInForm()
    {
        return true;
    }

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     * @Assert\NotBlank
     */
    protected $phone;

    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\Email(
     *     message = "El email '{{ value }}' no es un email válido.",
     *     checkMX = true
     * )
     */
    protected $email;

    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="customer", cascade={"persist","remove"})
     */
    protected $addresses;


    public function getAddress()
    {
        return $this->address;
    }

    public function addAddress(Address $address)
    {
        $address->setCustomer($this);
        $this->addresses->add($address);
    }

    public function removeAddress(Address $address)
    {
        $this->addresses->removeElement($address);
        $this->getEntityManager()->remove($address);
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
            'empresa' => 'Empresa',
        );
        return $this->devuelve($choices, $key);
    }

}
