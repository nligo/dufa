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
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=120, nullable=false)
     */
    private $category = "";

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
}
