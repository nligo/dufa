<?php

namespace Dufa\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserOperateRecord
 *
 * @ORM\Table(name="user_operate_record", indexes={@ORM\Index(name="IDX_3836E5CB8D93D649", columns={"user"})})
 * @ORM\Entity(repositoryClass="Dufa\Bundle\CoreBundle\Repository\UserOperateRecord")
 */
class UserOperateRecord extends Base
{
    /**
     * @var string
     *
     * @ORM\Column(name="operate_type", type="string", length=50, nullable=false)
     */
    private $operateType = "";

    /**
     * @var string
     *
     * @ORM\Column(name="contents", type="text", length=65535, nullable=true)
     */
    private $contents = "";

    /**
     * @ORM\ManyToOne(targetEntity="Dictionay")
     * @ORM\JoinColumn(name="d_id", referencedColumnName="id")
     */
    private $dId;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
    private $user;



    /**
     * Set operateType
     *
     * @param string $operateType
     *
     * @return UserOperateRecord
     */
    public function setOperateType($operateType)
    {
        $this->operateType = $operateType;

        return $this;
    }

    /**
     * Get operateType
     *
     * @return string
     */
    public function getOperateType()
    {
        return $this->operateType;
    }

    /**
     * Set contents
     *
     * @param string $contents
     *
     * @return UserOperateRecord
     */
    public function setContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * Get contents
     *
     * @return string
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * Set dId
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\Dictionay $dId
     *
     * @return UserOperateRecord
     */
    public function setDId(\Dufa\Bundle\CoreBundle\Entity\Dictionay $dId = null)
    {
        $this->dId = $dId;

        return $this;
    }

    /**
     * Get dId
     *
     * @return \Dufa\Bundle\CoreBundle\Entity\Dictionay
     */
    public function getDId()
    {
        return $this->dId;
    }

    /**
     * Set user
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\User $user
     *
     * @return UserOperateRecord
     */
    public function setUser(\Dufa\Bundle\CoreBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Dufa\Bundle\CoreBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
