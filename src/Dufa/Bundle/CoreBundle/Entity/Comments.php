<?php

namespace Dufa\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comments
 *
 * @ORM\Table(name="comments")
 * @ORM\Entity(repositoryClass="Dufa\Bundle\CoreBundle\Repository\Comments")
 */
class Comments extends Base
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
     * Set contents
     *
     * @param string $contents
     *
     * @return Comments
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
     * @return Comments
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
     * @return Comments
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
     * @return Comments
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
     * @return Comments
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
     * @return Comments
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
}
