<?php

namespace Dufa\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dictionay
 *
 * @ORM\Table(name="dictionay")
 * @ORM\Entity(repositoryClass="Dufa\Bundle\CoreBundle\Repository\Dictionay")
 */
class Dictionay extends Base
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50, nullable=false)
     */
    private $title = "";

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description = "";

    /**
     * @var string
     *
     * @ORM\Column(name="cn_name", type="string", length=50, nullable=false)
     */
    private $cnName = "";

    /**
     * @var string
     *
     * @ORM\Column(name="en_name", type="string", length=50, nullable=true)
     */
    private $enName = "";

    /**
     * @var string
     *
     * @ORM\Column(name="mean", type="string", length=120, nullable=true)
     */
    private $mean = "";

    /**
     * @var string
     *
     * @ORM\Column(name="effect", type="string", length=120, nullable=true)
     */
    private $effect = "";

    /**
     * @var string
     *
     * @ORM\Column(name="second_title", type="string", length=50, nullable=true)
     */
    private $secondTitle = "";

    /**
     * @var string
     *
     * @ORM\Column(name="contents", type="text", length=65535, nullable=true)
     */
    private $contents = "";

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;


    /**
     * @var float
     * @ORM\Column(name="dufa_num",type="decimal", precision=10, scale=2,nullable=true)
     */
    private $dufaNum = '0.00';

    /**
     * @var integer
     * @ORM\Column(name="comment_num",type="integer",nullable=true)
     */
    private $commentNum = '0';

    /**
     * @var integer
     * @ORM\Column(name="view_num",type="integer",nullable=true)
     */
    private $viewNum = '0';

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Dictionay
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
     * Set description
     *
     * @param string $description
     *
     * @return Dictionay
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set cnName
     *
     * @param string $cnName
     *
     * @return Dictionay
     */
    public function setCnName($cnName)
    {
        $this->cnName = $cnName;

        return $this;
    }

    /**
     * Get cnName
     *
     * @return string
     */
    public function getCnName()
    {
        return $this->cnName;
    }

    /**
     * Set enName
     *
     * @param string $enName
     *
     * @return Dictionay
     */
    public function setEnName($enName)
    {
        $this->enName = $enName;

        return $this;
    }

    /**
     * Get enName
     *
     * @return string
     */
    public function getEnName()
    {
        return $this->enName;
    }

    /**
     * Set mean
     *
     * @param string $mean
     *
     * @return Dictionay
     */
    public function setMean($mean)
    {
        $this->mean = $mean;

        return $this;
    }

    /**
     * Get mean
     *
     * @return string
     */
    public function getMean()
    {
        return $this->mean;
    }

    /**
     * Set effect
     *
     * @param string $effect
     *
     * @return Dictionay
     */
    public function setEffect($effect)
    {
        $this->effect = $effect;

        return $this;
    }

    /**
     * Get effect
     *
     * @return string
     */
    public function getEffect()
    {
        return $this->effect;
    }

    /**
     * Set secondTitle
     *
     * @param string $secondTitle
     *
     * @return Dictionay
     */
    public function setSecondTitle($secondTitle)
    {
        $this->secondTitle = $secondTitle;

        return $this;
    }

    /**
     * Get secondTitle
     *
     * @return string
     */
    public function getSecondTitle()
    {
        return $this->secondTitle;
    }

    /**
     * Set contents
     *
     * @param string $contents
     *
     * @return Dictionay
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
     * @return Dictionay
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
     * Set dufaNum
     *
     * @param string $dufaNum
     *
     * @return Dictionay
     */
    public function setDufaNum($dufaNum)
    {
        $this->dufaNum = $dufaNum;

        return $this;
    }

    /**
     * Get dufaNum
     *
     * @return string
     */
    public function getDufaNum()
    {
        return $this->dufaNum;
    }

    /**
     * Set commentNum
     *
     * @param integer $commentNum
     *
     * @return Dictionay
     */
    public function setCommentNum($commentNum)
    {
        $this->commentNum = $commentNum;

        return $this;
    }

    /**
     * Get commentNum
     *
     * @return integer
     */
    public function getCommentNum()
    {
        return $this->commentNum;
    }

    /**
     * Set viewNum
     *
     * @param integer $viewNum
     *
     * @return Dictionay
     */
    public function setViewNum($viewNum)
    {
        $this->viewNum = $viewNum;

        return $this;
    }

    /**
     * Get viewNum
     *
     * @return integer
     */
    public function getViewNum()
    {
        return $this->viewNum;
    }
}
