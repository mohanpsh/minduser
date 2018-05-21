<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompanyRepository")
 */
class Company
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
     * @ORM\Column(name="adress", type="string", length=255, nullable=true)
     */
    private $adress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="plz", type="string", length=255, nullable=true)
     */
    private $plz;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="User", mappedBy="companies")
     */
    private $users;

    /**
     * Many Individuals have Many Groups.
     * @ORM\ManyToMany(targetEntity="Individual", mappedBy="companies")
     */
    private $individuals;

    /**
     * Company constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->individuals = new ArrayCollection();
    }

    /**
     * @param User $user
     * @return $this
     */
    public function addUser(User $user)
    {
        if(!$this->users->contains($user)){
            $this->users->add($user);
        }
        return $this;
    }

    /**
     * @param User $article
     */
    public function removeUser(User $article)
    {
        $this->users->removeElement($article);
    }


    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;
    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;
    /**
     * @var string|null
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=true)
     */
    private $tel;
    /**
     * @var string|null
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;

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
     * @return Company
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
     * Set adress.
     *
     * @param string|null $adress
     *
     * @return Company
     */
    public function setAdress($adress = null)
    {
        $this->adress = $adress;
        return $this;
    }

    /**
     * Get adress.
     *
     * @return string|null
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set plz.
     *
     * @param string|null $plz
     *
     * @return Company
     */
    public function setPlz($plz = null)
    {
        $this->plz = $plz;
        return $this;
    }

    /**
     * Get plz.
     *
     * @return string|null
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
     * @return Company
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
     * @param string|null $email
     *
     * @return Company
     */
    public function setEmail($email = null)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set tel.
     *
     * @param string|null $tel
     *
     * @return Company
     */
    public function setTel($tel = null)
    {
        $this->tel = $tel;
        return $this;
    }

    /**
     * Get tel.
     *
     * @return string|null
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set website.
     *
     * @param string|null $website
     *
     * @return Company
     */
    public function setWebsite($website = null)
    {
        $this->website = $website;
        return $this;
    }

    /**
     * Get website.
     *
     * @return string|null
     */
    public function getWebsite()
    {
        return $this->website;
    }

    public function __toString()
    {
        return $this->name;
    }
}
