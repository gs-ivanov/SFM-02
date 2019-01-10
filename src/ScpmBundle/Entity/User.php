<?php

namespace ScpmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="ScpmBundle\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @var int
     *
     * @ORM\Column(name="duty_id", type="smallint", unique=true)
     */
    private $dutyId;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=100, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=100)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="ship_name", type="string", length=100, unique=true)
     */
    private $shipName;

    /**
     * @var string
     *
     * @ORM\Column(name="ship_type", type="string", length=255)
     */
    private $shipType;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ScpmBundle\Entity\Role")
     *
     * @ORM\JoinTable(name="users_roles",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *   )
     */
    private $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }


    /**
     * @return string
     */
    public function getShipType()
    {
        return $this->shipType;
    }

    /**
     * @param string $shipType
     */
    public function setShipType($shipType)
    {
        $this->shipType = $shipType;
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
     * Set dutyId.
     *
     * @param int $dutyId
     *
     * @return User
     *
     */
    public function setDutyId($dutyId)
    {
        $this->dutyId = $dutyId;

        return $this;
    }

    /**
     * Get dutyId.
     *
     * @return int
     */
    public function getDutyId()
    {
        return $this->dutyId;
    }

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }


    /**
     * Set password.
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return User
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
     * Set duties.
     *
     * @param string|null $duties
     *
     * @return User
     */
    public function setDuties($duties = null)
    {
        $this->duties = $duties;

        return $this;
    }



    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return array('ROLE_USER');
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        $stringRoles = [];

        foreach ($this->roles as $role) {
            /** @var Role $role */
            $stringRoles[] = $role->getRole();
        }

        return $stringRoles;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getShipName()
    {
        return $this->shipName;
    }

    /**
     * @param string $shipName
     */
    public function setShipName($shipName)
    {
        $this->shipName = $shipName;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }


    /**
     * @param \ScpmBundle\Entity\Role $role
     *
     * @return User
     */
    public function addRole(Role $role)
    {
        $this->roles[] = $role;
        return $this;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }


    /**
     * @return bool
     */
    public function isAdmin()
    {
        return in_array("ROLE_ADMIN", $this->getRoles());
    }
}
