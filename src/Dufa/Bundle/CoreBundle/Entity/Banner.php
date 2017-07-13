<?php

namespace Dufa\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Banner
 *
 * @ORM\Table(name="banner")
 * @ORM\Entity(repositoryClass="Dufa\Bundle\CoreBundle\Repository\Banner")
 */
class Banner extends Base
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=120, nullable=false,options={"comment":"标题"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url", type="text", nullable=false,options={"comment":"图片地址"})
     */
    private $imageUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="target_url", type="string", length=120, nullable=true,options={"comment":"跳转地址"})
     */
    private $targetUrl = "";

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Banner
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
     * Set imageUrl
     *
     * @param string $imageUrl
     *
     * @return Banner
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set targetUrl
     *
     * @param string $targetUrl
     *
     * @return Banner
     */
    public function setTargetUrl($targetUrl)
    {
        $this->targetUrl = $targetUrl;

        return $this;
    }

    /**
     * Get targetUrl
     *
     * @return string
     */
    public function getTargetUrl()
    {
        return $this->targetUrl;
    }
}
