<?php

namespace Dufa\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="Dufa\Bundle\CoreBundle\Repository\Orders")
 */
class Orders extends Base
{
    const ORDER_STATUS_INIT = "init";

    const ORDER_STATUS_ING = "ing";

    const ORDER_STATUS_END = "end";

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Goods")
     * @ORM\JoinColumn(name="goods_id", referencedColumnName="id")
     */
    private $goodsId;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=20, nullable=false)
     */
    private $username = "";

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=30, nullable=false)
     */
    private $phone = "";

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=120, nullable=false)
     */
    private $address = "";

    /**
     * @var string
     *
     * @ORM\Column(name="order_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $orderPrice = 0.00;

    /**
     * @var string
     *
     * @ORM\Column(name="pay_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $payPrice = 0.00;

    /**
     * @var string
     *
     * @ORM\Column(name="order_status", type="string", length=20, nullable=true)
     */
    private $orderStatus = self::ORDER_STATUS_INIT;


    /**
     * Set username
     *
     * @param string $username
     *
     * @return Orders
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Orders
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Orders
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set orderPrice
     *
     * @param string $orderPrice
     *
     * @return Orders
     */
    public function setOrderPrice($orderPrice)
    {
        $this->orderPrice = $orderPrice;

        return $this;
    }

    /**
     * Get orderPrice
     *
     * @return string
     */
    public function getOrderPrice()
    {
        return $this->orderPrice;
    }

    /**
     * Set payPrice
     *
     * @param string $payPrice
     *
     * @return Orders
     */
    public function setPayPrice($payPrice)
    {
        $this->payPrice = $payPrice;

        return $this;
    }

    /**
     * Get payPrice
     *
     * @return string
     */
    public function getPayPrice()
    {
        return $this->payPrice;
    }

    /**
     * Set orderStatus
     *
     * @param string $orderStatus
     *
     * @return Orders
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

    /**
     * Get orderStatus
     *
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * Set user
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\User $user
     *
     * @return Orders
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
     * Set goodsId
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\Goods $goodsId
     *
     * @return Orders
     */
    public function setGoodsId(\Dufa\Bundle\CoreBundle\Entity\Goods $goodsId = null)
    {
        $this->goodsId = $goodsId;

        return $this;
    }

    /**
     * Get goodsId
     *
     * @return \Dufa\Bundle\CoreBundle\Entity\Goods
     */
    public function getGoodsId()
    {
        return $this->goodsId;
    }
}
