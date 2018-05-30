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
 * privateSpace
 *
 * @ORM\Table(name="private_space")
 * @ORM\Entity
 */
class PrivateSpace
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
     * Many Private space have one business center.
     * @ORM\ManyToOne(targetEntity="BusinessCenter", inversedBy="center")
     */
    private $center;

    /**
     * @var int
     *
     * @ORM\Column(name="roomNumber", type="integer")
     */
    private $roomNumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="doorId", type="integer", nullable=true)
     */
    private $doorId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="typeOfRoom", type="string", length=255, nullable=true)
     */
    private $typeOfRoom;


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
     * Set roomNumber.
     *
     * @param int $centerId
     *
     * @return privateSpace
     */
    public function setCenter($center)
    {
        $this->center = $center;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCenter()
    {
        return $this->center;
    }
    /**
     * Set roomNumber.
     *
     * @param int $roomNumber
     *
     * @return privateSpace
     */
    public function setRoomNumber($roomNumber)
    {
        $this->roomNumber = $roomNumber;

        return $this;
    }

    /**
     * Get roomNumber.
     *
     * @return int
     */
    public function getRoomNumber()
    {
        return $this->roomNumber;
    }

    /**
     * Set doorId.
     *
     * @param int|null $doorId
     *
     * @return privateSpace
     */
    public function setDoorId($doorId = null)
    {
        $this->doorId = $doorId;

        return $this;
    }

    /**
     * Get doorId.
     *
     * @return int|null
     */
    public function getDoorId()
    {
        return $this->doorId;
    }

    /**
     * Set typeOfRoom.
     *
     * @param string|null $typeOfRoom
     *
     * @return privateSpace
     */
    public function setTypeOfRoom($typeOfRoom = null)
    {
        $this->typeOfRoom = $typeOfRoom;

        return $this;
    }

    /**
     * Get typeOfRoom.
     *
     * @return string|null
     */
    public function getTypeOfRoom()
    {
        return $this->typeOfRoom;
    }
}
