<?php
/**
 * all code by me
 *
 * @copyright  Mohan P Sharma
 * @version    Release: 1.0.0
 * @year       2018
 *
 */
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * BusinessCenter
 *
 * @ORM\Table(name="business_center")
 * @ORM\Entity
 */
class BusinessCenter
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pincode", type="string", length=10, nullable=true)
     */
    private $pincode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phoneNumber", type="string", length=15, nullable=true)
     */
    private $phoneNumber;

    /**
    * @ORM\OneToMany(targetEntity="CommonSpace", mappedBy="center")
    */
    private $commonSpace;

    /**
    * One Center has Many PrivateSpace.
    * @ORM\OneToMany(targetEntity="PrivateSpace", mappedBy="center")
    */
    private $privateSpace;

    public function __construct() {
        $this->privateSpace = new \Doctrine\Common\Collections\ArrayCollection();
        $this->commonSpace = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return BusinessCenter
     */
    public function setName($name = null)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set city.
     *
     * @param string|null $city
     *
     * @return BusinessCenter
     */
    public function setCity($city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set address.
     *
     * @param string|null $address
     *
     * @return BusinessCenter
     */
    public function setAddress($address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set pincode.
     *
     * @param string|null $pincode
     *
     * @return BusinessCenter
     */
    public function setPincode($pincode = null)
    {
        $this->pincode = $pincode;

        return $this;
    }

    /**
     * Get pincode.
     *
     * @return string|null
     */
    public function getPincode()
    {
        return $this->pincode;
    }

    /**
     * Set phoneNumber.
     *
     * @param string|null $phoneNumber
     *
     * @return BusinessCenter
     */
    public function setPhoneNumber($phoneNumber = null)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber.
     *
     * @return string|null
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getPrivateSpace()
    {
        return $this->privateSpace;
    }

    /**
     * @param mixed $privateSpace
     */
    public function setPrivateSpace($privateSpace)
    {
        $this->privateSpace = $privateSpace;
    }

    public function __toString()
    {
        return $this->name;
    }
}
