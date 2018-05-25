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
 * CommonSpace
 *
 * @ORM\Table(name="common_space")
 * @ORM\Entity
 */
class CommonSpace
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
     * @ORM\ManyToOne(targetEntity="BusinessCenter", inversedBy="commonSpace")
     * @ORM\JoinColumn(name="center_id", referencedColumnName="id")
     */
    private $centerID;

    /**
     * @var int
     *
     * @ORM\Column(name="doorID", type="integer")
     */
    private $doorID;

    /**
     * @var string|null
     *
     * @ORM\Column(name="doorDescription", type="string", length=255, nullable=true)
     */
    private $doorDescription;


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
     * Set centerID.
     *
     * @param int $centerID
     *
     * @return CommonSpace
     */
    public function setCenterID($centerID)
    {
        $this->centerID = $centerID;

        return $this;
    }

    /**
     * Get centerID.
     *
     * @return int
     */
    public function getCenterID()
    {
        return $this->centerID;
    }

    /**
     * Set doorID.
     *
     * @param int $doorID
     *
     * @return CommonSpace
     */
    public function setDoorID($doorID)
    {
        $this->doorID = $doorID;

        return $this;
    }

    /**
     * Get doorID.
     *
     * @return int
     */
    public function getDoorID()
    {
        return $this->doorID;
    }

    /**
     * Set doorDescription.
     *
     * @param string|null $doorDescription
     *
     * @return CommonSpace
     */
    public function setDoorDescription($doorDescription = null)
    {
        $this->doorDescription = $doorDescription;

        return $this;
    }

    /**
     * Get doorDescription.
     *
     * @return string|null
     */
    public function getDoorDescription()
    {
        return $this->doorDescription;
    }
}
