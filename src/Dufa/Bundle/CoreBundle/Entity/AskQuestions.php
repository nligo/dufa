<?php

namespace Dufa\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AskQuestions
 *
 * @ORM\Table(name="ask_questions")
 * @ORM\Entity(repositoryClass="Dufa\Bundle\CoreBundle\Repository\AskQuestions")
 */
class AskQuestions extends Base
{
    const ASK_STATUS_OPEN = "open";

    const ASK_STATUS_CLOSE = "close";

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=120, nullable=false)
     */
    private $title = "";

    /**
     * @var string
     *
     * @ORM\Column(name="contents", type="text", length=65535, nullable=false)
     */
    private $contents = "";

    /**
     * @var string
     *
     * @ORM\Column(name="rewards", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $rewards = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="img_url", type="string", length=120, nullable=true)
     */
    private $imgUrl = "";

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="ask_status", type="string", length=20, nullable=true)
     */
    private $askStatus = self::ASK_STATUS_OPEN;

    /**
     * Set title
     *
     * @param string $title
     *
     * @return AskQuestions
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set contents
     *
     * @param string $contents
     *
     * @return AskQuestions
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
     * Set rewards
     *
     * @param string $rewards
     *
     * @return AskQuestions
     */
    public function setRewards($rewards)
    {
        $this->rewards = $rewards;

        return $this;
    }

    /**
     * Get rewards
     *
     * @return string
     */
    public function getRewards()
    {
        return $this->rewards;
    }

    /**
     * Set imgUrl
     *
     * @param string $imgUrl
     *
     * @return AskQuestions
     */
    public function setImgUrl($imgUrl)
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }

    /**
     * Get imgUrl
     *
     * @return string
     */
    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    /**
     * Set user
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\User $user
     *
     * @return AskQuestions
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
     * Set askStatus
     *
     * @param string $askStatus
     *
     * @return AskQuestions
     */
    public function setAskStatus($askStatus)
    {
        $this->askStatus = $askStatus;

        return $this;
    }

    /**
     * Get askStatus
     *
     * @return string
     */
    public function getAskStatus()
    {
        return $this->askStatus;
    }
}
