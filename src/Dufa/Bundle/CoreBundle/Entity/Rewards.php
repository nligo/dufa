<?php

namespace Dufa\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reward
 *
 * @ORM\Table(name="rewards")
 * @ORM\Entity(repositoryClass="Dufa\Bundle\CoreBundle\Repository\Reward")
 */
class Rewards extends Base
{
    /**
     * @var string
     *
     * @ORM\Column(name="contents", type="string", length=255, nullable=false)
     */
    private $contents = "";

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Dictionay")
     * @ORM\JoinColumn(name="d_id", referencedColumnName="id")
     */
    private $dId;

    /**
     * @ORM\ManyToOne(targetEntity="AskQuestions")
     * @ORM\JoinColumn(name="aq_id", referencedColumnName="id")
     */
    private $aqId;

    /**
     * @ORM\ManyToOne(targetEntity="AskQuestionsAnswer")
     * @ORM\JoinColumn(name="aqa_id", referencedColumnName="id")
     */
    private $aqaId;

    /**
     * @ORM\ManyToOne(targetEntity="Creatives")
     * @ORM\JoinColumn(name="creative_id", referencedColumnName="id")
     */
    private $creativeId;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type = "default";

    /**
     * @var string
     *
     * @ORM\Column(name="money", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $money = 0.00;

    /**
     * Set contents
     *
     * @param string $contents
     *
     * @return Rewards
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
     * Set user
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\User $user
     *
     * @return Rewards
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

    /**
     * Set dId
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\Dictionay $dId
     *
     * @return Rewards
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
     * Set aqId
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\AskQuestions $aqId
     *
     * @return Rewards
     */
    public function setAqId(\Dufa\Bundle\CoreBundle\Entity\AskQuestions $aqId = null)
    {
        $this->aqId = $aqId;

        return $this;
    }

    /**
     * Get aqId
     *
     * @return \Dufa\Bundle\CoreBundle\Entity\AskQuestions
     */
    public function getAqId()
    {
        return $this->aqId;
    }

    /**
     * Set aqaId
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\AskQuestionsAnswer $aqaId
     *
     * @return Rewards
     */
    public function setAqaId(\Dufa\Bundle\CoreBundle\Entity\AskQuestionsAnswer $aqaId = null)
    {
        $this->aqaId = $aqaId;

        return $this;
    }

    /**
     * Get aqaId
     *
     * @return \Dufa\Bundle\CoreBundle\Entity\AskQuestionsAnswer
     */
    public function getAqaId()
    {
        return $this->aqaId;
    }

    /**
     * Set creativeId
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\Creatives $creativeId
     *
     * @return Rewards
     */
    public function setCreativeId(\Dufa\Bundle\CoreBundle\Entity\Creatives $creativeId = null)
    {
        $this->creativeId = $creativeId;

        return $this;
    }

    /**
     * Get creativeId
     *
     * @return \Dufa\Bundle\CoreBundle\Entity\Creatives
     */
    public function getCreativeId()
    {
        return $this->creativeId;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Rewards
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
}
