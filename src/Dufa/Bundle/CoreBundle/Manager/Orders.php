<?php
namespace Dufa\Bundle\CoreBundle\Manager;

use Doctrine\ORM\EntityManager;
use Dufa\Bundle\CoreBundle\Entity\Base;

class Orders
{
    protected $em;

    protected $repo;

    protected $class;

    public function __construct(EntityManager $em, $class) {
        $this->em = $em;
        $this->class = $class;
        $this->repo = $em->getRepository($class);
    }

    public function getRepository()
    {
        return $this->repo;
    }

    public function create($data = array())
    {
        $class = $this->class;
        $obj = new $class();
        foreach ($data as $k => $v) {
            $setMethod = 'set'.ucfirst($k);
            $obj->$setMethod($v);
        }
        $this->em->persist($obj);
        $this->em->flush();

        return $obj;
    }

    public function update($id,$data = array())
    {
        $obj = $this->getRepository()->find($id);
        foreach ($data as $k => $v) {
            $setMethod = 'set'.ucfirst($k);
            $obj->$setMethod($v);
        }
        $this->em->persist($obj);
        $this->em->flush();
        return $obj;
    }

    public function createOrder($user,$goodsId,$addressId)
    {
        $addressInfo = $this->em->getRepository("DufaCoreBundle:UserAddress")->find($addressId);
        $goodsInfo = $this->em->getRepository("DufaCoreBundle:Goods")->find($goodsId);
        $obj = new $this->class();
        $obj
            ->setUser($user)
            ->setUsername($addressInfo->getUsername())
            ->setAddress($addressInfo->getAddress())
            ->setPhone($addressInfo->getPhone())
            ->setGoodsId($goodsInfo)
            ->setPayPrice($goodsInfo->getPrice())
            ->setOrderPrice($goodsInfo->getPrice())
            ->setOrderStatus($this->class::ORDER_STATUS_ING)
        ;
        $this->em->persist($obj);
        $this->em->flush();
        return $obj;

    }

    public function getOrdersList($condition,$start = 0,$limit = 10)
    {
        $qb = $this->getRepository()->createQueryBuilder("o");
        $qb->andWhere('o.status = :status')->setParameter('status',Base::STATUS_ACTIVE);
        $qb = $this->_getWhere($qb,$condition);
        $qb->setFirstResult($start)->setMaxResults($limit);
        $qb->orderBy('o.createdAt','DESC');
        return $qb->getQuery()->getResult() ? : [];
    }

    private function _getWhere($qb,$condition = [])
    {
        if(!empty($condition))
        {
        }
        return $qb;
    }
}