<?php

namespace Crm\InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="crm_invoice_templates")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Templates
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_id", type="string", length=36, nullable=true)
     */
    private $customerId = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="template", type="text", nullable=true)
     */
    private $template = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * Invoice constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * @param string $customerId
     * @return Invoice
     */
    public function setCustomerId(string $customerId): Templates
    {
        $this->customerId = $customerId;
        return $this;
    }

    /**
     * @return int
     */
    public function getTemplate(): int
    {
        return $this->template;
    }

    /**
     * @param int $template
     * @return Templates
     */
    public function setTemplate(int $template): Templates
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updated = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->updated = new \DateTime();
        $this->created = new \DateTime();
    }
}
