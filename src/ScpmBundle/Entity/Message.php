<?php

namespace ScpmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="messages")
 * @ORM\Entity(repositoryClass="ScpmBundle\Repository\MessageRepository")
 */
class Message
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
     * @ORM\Column(name="frm", type="string", length=255)
     */
    private $frm;

    /**
     * @var string
     *
     * @ORM\Column(name="too", type="string", length=255)
     */
    private $too;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="sent", type="datetime", nullable=true)
     */
    private $sent;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="received", type="datetime", nullable=true)
     */
    private $received;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var bool
     *
     * @ORM\Column(name="isRead", type="boolean")
     */
    private $isRead;


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
     * Set frm.
     *
     * @param string $frm
     *
     * @return Message
     */
    public function setFrm($frm)
    {
        $this->frm = $frm;

        return $this;
    }

    /**
     * Get frm.
     *
     * @return string
     */
    public function getFrm()
    {
        return $this->frm;
    }

    /**
     * Set too.
     *
     * @param string $too
     *
     * @return Message
     */
    public function setToo($too)
    {
        $this->too = $too;

        return $this;
    }

    /**
     * Get too.
     *
     * @return string
     */
    public function getToo()
    {
        return $this->too;
    }

    /**
     * Set sent.
     *
     * @param \DateTime|null $sent
     *
     * @return Message
     */
    public function setSent($sent = null)
    {
        $this->sent = $sent;

        return $this;
    }

    /**
     * Get sent.
     *
     * @return \DateTime|null
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * Set received.
     *
     * @param \DateTime|null $received
     *
     * @return Message
     */
    public function setReceived($received = null)
    {
        $this->received = $received;

        return $this;
    }

    /**
     * Get received.
     *
     * @return \DateTime|null
     */
    public function getReceived()
    {
        return $this->received;
    }

    /**
     * Set content.
     *
     * @param string|null $content
     *
     * @return Message
     */
    public function setContent($content = null)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set isRead.
     *
     * @param bool $isRead
     *
     * @return Message
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;

        return $this;
    }

    /**
     * Get isRead.
     *
     * @return bool
     */
    public function getIsRead()
    {
        return $this->isRead;
    }
}
