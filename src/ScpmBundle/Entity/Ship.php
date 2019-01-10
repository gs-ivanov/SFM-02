<?php

namespace ScpmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ship
 *
 * @ORM\Table(name="ships")
 * @ORM\Entity(repositoryClass="ScpmBundle\Repository\ShipRepository")
 */
class Ship
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
     * @var string
     *
     * @ORM\Column(name="ship_name", type="string", length=100, unique=true)
     */
    private $shipName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="duty_id", type="smallint")
     */
    private $dutyId;


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
     * Set shipName.
     *
     * @param string $shipName
     *
     * @return Ship
     */
    public function setShipName($shipName)
    {
        $this->shipName = $shipName;

        return $this;
    }

    /**
     * Get shipName.
     *
     * @return string
     */
    public function getShipName()
    {
        return $this->shipName;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Ship
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
     * @return int
     */
    public function getDutyId()
    {
        return $this->dutyId;
    }

    /**
     * Set dutyId.
     * @param int $dutyId
     * @return Ship
     **/
    public function setDutyId($dutyId)
    {
        $this->dutyId = $dutyId;
        return $this;
    }


}
