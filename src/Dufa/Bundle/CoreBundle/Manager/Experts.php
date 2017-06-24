<?php
namespace Dufa\Bundle\CoreBundle\Manager;

use Doctrine\ORM\EntityManager;
use Dufa\Bundle\CoreBundle\Entity\Base;

class Experts
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

    public function getList($type = "",$condition,$start = 0,$limit = 10)
    {
        $qb = $this->getRepository()->createQueryBuilder("e");
        if(!empty($type))
        {
            $qb->andWhere('e.type = :type')->setParameter('type',$type);
        }
        $qb->andWhere('e.status = :status')->setParameter('status',Base::STATUS_ACTIVE);
        $qb = $this->_getWhere($qb,$condition);
        $qb->setFirstResult($start)->setMaxResults($limit);
        $qb->orderBy('e.createdAt','DESC');
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