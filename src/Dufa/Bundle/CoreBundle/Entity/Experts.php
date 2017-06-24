<?php

namespace Dufa\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Experts
 *
 * @ORM\Table(name="experts")
 * @ORM\Entity(repositoryClass="Dufa\Bundle\CoreBundle\Repository\Experts")
 */
class Experts extends Base
{
    const TYPE_SERVICE = "service";

    const TYPE_JUDGES = "judges";
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name = "";

    /**
     * @var string
     *
     * @ORM\Column(name="head_img", type="string", length=120, nullable=false)
     */
    private $headImg = "";

    /**
     * @var string
     *
     * @ORM\Column(name="contents", type="text", length=65535, nullable=false)
     */
    private $contents = "";

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $price = 0.00;

    /**
     * @var string
     *
     * @ORM\Column(name="qq", type="string", length=20,nullable=true)
     */
    private $qq = "";

    /**
     * @var string
     *
     * @ORM\Column(name="wechat", type="string", length=20,nullable=true)
     */
    private $wechat = "";

    /**
     * @var boolean
     *
     * @ORM\Column(name="type", type="string",length=20, nullable=false)
     */
    private $type;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Experts
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set headImg
     *
     * @param string $headImg
     *
     * @return Experts
     */
    public function setHeadImg($headImg)
    {
        $this->headImg = $headImg;

        return $this;
    }

    /**
     * Get headImg
     *
     * @return string
     */
    public function getHeadImg()
    {
        return $this->headImg;
    }

    /**
     * Set contents
     *
     * @param string $contents
     *
     * @return Experts
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
     * Set price
     *
     * @param string $price
     *
     * @return Experts
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
     * Set qq
     *
     * @param string $qq
     *
     * @return Experts
     */
    public function setQq($qq)
    {
        $this->qq = $qq;

        return $this;
    }

    /**
     * Get qq
     *
     * @return string
     */
    public function getQq()
    {
        return $this->qq;
    }

    /**
     * Set wechat
     *
     * @param string $wechat
     *
     * @return Experts
     */
    public function setWechat($wechat)
    {
        $this->wechat = $wechat;

        return $this;
    }

    /**
     * Get wechat
     *
     * @return string
     */
    public function getWechat()
    {
        return $this->wechat;
    }

    /**
     * Set type
     *
     * @param boolean $type
     *
     * @return Experts
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean
     */
    public function getType()
    {
        return $this->type;
    }
}
