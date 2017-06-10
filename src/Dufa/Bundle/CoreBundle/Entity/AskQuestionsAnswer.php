<?php

namespace Dufa\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AskQuestionsAnswer
 *
 * @ORM\Table(name="ask_questions_ answer")
 * @ORM\Entity(repositoryClass="Dufa\Bundle\CoreBundle\Repository\AskQuestionsAnswer")
 */
class AskQuestionsAnswer
{
    /**
     * @ORM\ManyToOne(targetEntity="AskQuestions")
     * @ORM\JoinColumn(name="aq_id", referencedColumnName="id")
     */
    private $aqId;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="string", length=255, nullable=false)
     */
    private $answer = "";

    /**
     * @var boolean
     *
     * @ORM\Column(name="best", type="boolean", nullable=false)
     */
    private $best = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="general", type="boolean", nullable=false)
     */
    private $general = false;


    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return AskQuestionsAnswer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set best
     *
     * @param boolean $best
     *
     * @return AskQuestionsAnswer
     */
    public function setBest($best)
    {
        $this->best = $best;

        return $this;
    }

    /**
     * Get best
     *
     * @return boolean
     */
    public function getBest()
    {
        return $this->best;
    }

    /**
     * Set general
     *
     * @param boolean $general
     *
     * @return AskQuestionsAnswer
     */
    public function setGeneral($general)
    {
        $this->general = $general;

        return $this;
    }

    /**
     * Get general
     *
     * @return boolean
     */
    public function getGeneral()
    {
        return $this->general;
    }

    /**
     * Set aqId
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\AskQuestions $aqId
     *
     * @return AskQuestionsAnswer
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
     * Set user
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\User $user
     *
     * @return AskQuestionsAnswer
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
