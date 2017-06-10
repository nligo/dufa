<?php

namespace Dufa\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAccountRecord
 *
 * @ORM\Table(name="user_account_record", indexes={@ORM\Index(name="user", columns={"user"})})
 * @ORM\Entity(repositoryClass="Dufa\Bundle\CoreBundle\Repository\UserAccountRecord")
 */
class UserAccountRecord extends Base
{
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     */
    private $type = "";

    /**
     * @var string
     *
     * @ORM\Column(name="contents", type="text", length=65535, nullable=true)
     */
    private $contents = "";

    /**
     * @var string
     *
     * @ORM\Column(name="operate_type", type="string", length=50, nullable=true)
     */
    private $operateType = "";

    /**
     * @var string
     *
     * @ORM\Column(name="money", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $money = 0.00;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;



    /**
     * Set type
     *
     * @param string $type
     *
     * @return UserAccountRecord
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set contents
     *
     * @param string $contents
     *
     * @return UserAccountRecord
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
     * Set operateType
     *
     * @param string $operateType
     *
     * @return UserAccountRecord
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
     * Set money
     *
     * @param string $money
     *
     * @return UserAccountRecord
     */
    public function setMoney($money)
    {
        $this->money = $money;

        return $this;
    }

    /**
     * Get money
     *
     * @return string
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * Set user
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\User $user
     *
     * @return UserAccountRecord
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
