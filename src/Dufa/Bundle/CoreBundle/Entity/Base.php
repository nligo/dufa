<?php

namespace Dufa\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\HasLifecycleCallbacks()
 * @ORM\MappedSuperclass()
 */
class Base
{
    const STATUS_ACTIVE = "active";

    const STATUS_INACTIVE = "inactive";

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer",options={"comment":"userId"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20, nullable=false)
     */
    private $status = "active";

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


    /**
     * @ORM\PrePersist
     */
    public function PrePersist(){
        if (!$this->createdAt) {
            $this->createdAt = new \DateTime();
            $this->updatedAt = new \DateTime();
        }
        if (!$this->getStatus()) {
            $this->setStatus(self::STATUS_ACTIVE);
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function PreUpdate(){
        $this->updatedAt = new \DateTime();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}