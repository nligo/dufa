<?php

namespace Dufa\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Creatives
 *
 * @ORM\Table(name="creatives")
 * @ORM\Entity(repositoryClass="Dufa\Bundle\CoreBundle\Repository\Creatives")
 */
class Creatives extends Base
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
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type = "";

    /**
     * @var string
     *
     * @ORM\Column(name="editor", type="string", length=30, nullable=false)
     */
    private $editor = "";

    /**
     * @var string
     *
     * @ORM\Column(name="contents", type="text", length=65535, nullable=true)
     */
    private $contents = "";

    /**
     * @var string
     *
     * @ORM\Column(name="keyword", type="string", length=255, nullable=false)
     */
    private $keyword = "";

    /**
     * @var string
     *
     * @ORM\Column(name="reward", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $reward = 0.00;

    /**
     * @var string
     *
     * @ORM\Column(name="add_reward", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $addReward = 0.00;

    /**
     * @var string
     *
     * @ORM\Column(name="valuation", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $valuation = 0.00;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $price = 0.00;

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
     * @return Creatives
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
     * Set type
     *
     * @param string $type
     *
     * @return Creatives
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
     * Set editor
     *
     * @param string $editor
     *
     * @return Creatives
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
     * @return Creatives
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
     * Set keyword
     *
     * @param string $keyword
     *
     * @return Creatives
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set reward
     *
     * @param string $reward
     *
     * @return Creatives
     */
    public function setReward($reward)
    {
        $this->reward = $reward;

        return $this;
    }

    /**
     * Get reward
     *
     * @return string
     */
    public function getReward()
    {
        return $this->reward;
    }

    /**
     * Set addReward
     *
     * @param string $addReward
     *
     * @return Creatives
     */
    public function setAddReward($addReward)
    {
        $this->addReward = $addReward;

        return $this;
    }

    /**
     * Get addReward
     *
     * @return string
     */
    public function getAddReward()
    {
        return $this->addReward;
    }

    /**
     * Set valuation
     *
     * @param string $valuation
     *
     * @return Creatives
     */
    public function setValuation($valuation)
    {
        $this->valuation = $valuation;

        return $this;
    }

    /**
     * Get valuation
     *
     * @return string
     */
    public function getValuation()
    {
        return $this->valuation;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Creatives
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set user
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\User $user
     *
     * @return Creatives
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
