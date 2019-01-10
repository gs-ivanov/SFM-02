<?php

namespace ScpmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fleet
 *
 * @ORM\Table(name="fleets")
 * @ORM\Entity(repositoryClass="ScpmBundle\Repository\FleetRepository")
 */
class Fleet
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
     * @ORM\Column(name="fleet_name", type="string", length=100)
     */
    private $fleetName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="details", type="text", nullable=true)
     */
    private $details;

    /**
     * @var int
     *
     * @ORM\Column(name="duty_id", type="smallint", unique=true)
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
     * Set fleetName.
     *
     * @param string $fleetName
     *
     * @return Fleet
     */
    public function setFleetName($fleetName)
    {
        $this->fleetName = $fleetName;

        return $this;
    }

    /**
     * Get fleetName.
     *
     * @return string
     */
    public function getFleetName()
    {
        return $this->fleetName;
    }

     /**
     * Set details.
     *
     * @param string|null $details
     *
     * @return Fleet
     */
    public function setDetails($details = null)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details.
     *
     * @return string|null
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @return int
     */
    public function getDutyId()
    {
        return $this->dutyId;
    }

    /**
     * @param int $dutyId
     */
    public function setDutyId($dutyId)
    {
        $this->dutyId = $dutyId;
    }

}
