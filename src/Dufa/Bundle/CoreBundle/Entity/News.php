<?php

namespace Dufa\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="Dufa\Bundle\CoreBundle\Repository\News")
 */
class News extends Base
{

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=120, nullable=false)
     */
    private $title = "";

    /**
     * @var string
     *
     * @ORM\Column(name="editor", type="string", length=120, nullable=false)
     */
    private $editor = "网络";

    /**
     * @var string
     *
     * @ORM\Column(name="contents", type="text", length=65535, nullable=true)
     */
    private $contents = "";

    /**
     * @var string
     *
     * @ORM\Column(name="digest", type="string", length=120, nullable=false)
     */
    private $digest = "";

    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="string", length=120, nullable=false)
     */
    private $cover = "";

    /**
     * @var integer
     *
     * @ORM\Column(name="category", type="integer",nullable=true)
     */
    private $category = 0;

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
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;



    /**
     * Set title
     *
     * @param string $title
     *
     * @return News
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
     * Set editor
     *
     * @param string $editor
     *
     * @return News
     */
    public function setEditor($editor)
    {
        $this->editor = $editor;

        return $this;
    }

    /**
     * Get editor
     *
     * @return string
     */
    public function getEditor()
    {
        return $this->editor;
    }

    /**
     * Set contents
     *
     * @param string $contents
     *
     * @return News
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
     * Set digest
     *
     * @param string $digest
     *
     * @return News
     */
    public function setDigest($digest)
    {
        $this->digest = $digest;

        return $this;
    }

    /**
     * Get digest
     *
     * @return string
     */
    public function getDigest()
    {
        return $this->digest;
    }

    /**
     * Set cover
     *
     * @param string $cover
     *
     * @return News
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return News
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set user
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\User $user
     *
     * @return News
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
     * @return News
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
     * @return News
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
     * @return News
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
