<?php
/**
 * all code by me
 *
 * @copyright  Stefan H.G. Buchhofer
 * @version    Release: 1.0.0
 * @link       www.ilenvo-media.de
 * @email      ilenvo@me.com
 * @year       2017
 *
 */
namespace AppBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="app_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     * @var string
     */
    private $firstName;
    /**
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @var string
     */
    private $title;
    /**
     * @ORM\Column(name="adress", type="string", length=255, nullable=true)
     * @var string
     */
    private $adress;
    /**
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }
    /**
     * @param string $adress
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;
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
     * @ORM\JoinTable(name="users_companies")
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
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }
    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }
    /**
     * @return string
     */
    public function getPlz()
    {
        return $this->plz;
    }
    /**
     * @param string $plz
     */
    public function setPlz($plz)
    {
        $this->plz = $plz;
    }
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }
    /**
     * @ORM\Column(name="plz", type="string", length=255, nullable=true)
     * @var string
     */
    private $plz;
    /**
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     * @var string
     */
    private $city;
    /**
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     * @var string
     */
    private $telephone;
    /**
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     * @var string
     */
    private $lastName;
    /**
     * @ORM\Column(name="api_key", type="string", length=32, unique=true)
     * @var string
     */
    private $apiKey;
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->companies= new \Doctrine\Common\Collections\ArrayCollection();
        if(null === $this->apiKey){
            $this->apiKey = strtoupper(md5(uniqid()));
        }
        parent::__construct();
        // your own logic
    }
    /**
     * @return string
     */
    public function getFirstName()
    {
        if($this->firstName){
            return $this->firstName;
        }
        return '';
    }
    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }
    /**
     * @return string
     */
    public function getLastName(): string
    {
        if($this->lastName){
            return $this->lastName;
        }
        return '';
    }
    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }
    /**
     * @param string $apiKey
     * @return User
     */
    public function setApiKey(string $apiKey): User
    {
        $this->apiKey = $apiKey;
        return $this;
    }
}
