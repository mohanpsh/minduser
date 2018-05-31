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

use Doctrine\ORM\Mapping as ORM;

/**
 * Individual
 *
 * @ORM\Table(name="individual")
 * @ORM\Entity
 */
class Individual
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
     * @ORM\Column(name="salutation", type="string", length=6, nullable=true)
     */
    private $salutation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Titel", type="string", length=255, nullable=true)
     */
    private $titel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name_first", type="string", length=255, nullable=true)
     */
    private $nameFirst;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name_middle", type="string", length=255, nullable=true)
     */
    private $nameMiddle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name_last", type="string", length=255, nullable=true)
     */
    private $nameLast;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name_birth", type="string", length=255, nullable=true)
     */
    private $nameBirth;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Address", type="text", nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="Plz", type="string", length=7)
     */
    private $plz;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=20)
     */
    private $tel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mobile", type="string", length=15, nullable=true)
     */
    private $mobile;

    /**
     * @var string|null
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @var int|null
     *
     * @ORM\Column(name="userid", type="integer", nullable=true)
     */
    private $userid;


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
     * Set salutation.
     *
     * @param string|null $salutation
     *
     * @return Individual
     */
    public function setSalutation($salutation = null)
    {
        $this->salutation = $salutation;

        return $this;
    }

    /**
     * Get salutation.
     *
     * @return string|null
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * Set titel.
     *
     * @param string|null $titel
     *
     * @return Individual
     */
    public function setTitel($titel = null)
    {
        $this->titel = $titel;

        return $this;
    }

    /**
     * Get titel.
     *
     * @return string|null
     */
    public function getTitel()
    {
        return $this->titel;
    }

    /**
     * Set nameFirst.
     *
     * @param string|null $nameFirst
     *
     * @return Individual
     */
    public function setNameFirst($nameFirst = null)
    {
        $this->nameFirst = $nameFirst;

        return $this;
    }

    /**
     * Get nameFirst.
     *
     * @return string|null
     */
    public function getNameFirst()
    {
        return $this->nameFirst;
    }

    /**
     * Set nameMiddle.
     *
     * @param string|null $nameMiddle
     *
     * @return Individual
     */
    public function setNameMiddle($nameMiddle = null)
    {
        $this->nameMiddle = $nameMiddle;

        return $this;
    }

    /**
     * Get nameMiddle.
     *
     * @return string|null
     */
    public function getNameMiddle()
    {
        return $this->nameMiddle;
    }

    /**
     * Set nameLast.
     *
     * @param string|null $nameLast
     *
     * @return Individual
     */
    public function setNameLast($nameLast = null)
    {
        $this->nameLast = $nameLast;

        return $this;
    }

    /**
     * Get nameLast.
     *
     * @return string|null
     */
    public function getNameLast()
    {
        return $this->nameLast;
    }

    /**
     * Set nameBirth.
     *
     * @param string|null $nameBirth
     *
     * @return Individual
     */
    public function setNameBirth($nameBirth = null)
    {
        $this->nameBirth = $nameBirth;

        return $this;
    }

    /**
     * Get nameBirth.
     *
     * @return string|null
     */
    public function getNameBirth()
    {
        return $this->nameBirth;
    }

    /**
     * Set address.
     *
     * @param string|null $address
     *
     * @return Individual
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
     * Set plz.
     *
     * @param string $plz
     *
     * @return Individual
     */
    public function setPlz($plz)
    {
        $this->plz = $plz;

        return $this;
    }

    /**
     * Get plz.
     *
     * @return string
     */
    public function getPlz()
    {
        return $this->plz;
    }

    /**
     * Set city.
     *
     * @param string|null $city
     *
     * @return Individual
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
     * Set email.
     *
     * @param string $email
     *
     * @return Individual
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set tel.
     *
     * @param string $tel
     *
     * @return Individual
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel.
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set userid
     *
     * @param string $userid
     *
     * @return Individual
     */
    public function setUserid($userid = null)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid.
     *
     * @return intger
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set mobile.
     *
     * @param string|null $mobile
     *
     * @return Individual
     */
    public function setMobile($mobile = null)
    {
        $this->mobile = $mobile;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getCompanies()
    {
        return $this->companies;
    }
    /**
     * @param mixed $companies
     */
    public function setCompanies($companies)
    {
        $this->companies = $companies;
    }
    /**
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="Company", inversedBy="companies")
     * @ORM\JoinTable(name="individuals_companies")
     */
    private $companies;
    public function addCompany(Company $tag)
    {
        $tag->addUser($this); // synchronously updating inverse side
        $this->companies[] = $tag;
    }
    public function removeCompany(Company $article)
    {
        $this->companies->removeElement($article)  ;
    }

    /**
     * Individual constructor.
     */
    public function __construct()
    {
        $this->companies= new \Doctrine\Common\Collections\ArrayCollection();
        // your own logic
    }
    /**
     * Get mobile.
     *
     * @return string|null
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set picture.
     *
     * @param string|null $picture
     *
     * @return Individual
     */
    public function setPicture($picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture.
     *
     * @return string|null
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
