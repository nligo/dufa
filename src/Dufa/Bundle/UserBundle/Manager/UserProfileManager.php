<?php

namespace Dufa\Bundle\UserBundle\Manager;

use Doctrine\ORM\EntityManager;

/**
 * @author  coffey
 *
 *
 * Class UserProfileManager
 */
class UserProfileManager
{
    protected $em;

    protected $repo;

    protected $class;

    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->class = $class;
        $this->repo = $em->getRepository($class);
    }

    public function get($id)
    {
        return $this->repo->find($id);
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
            if($setMethod == "setUserId")
            {
                $userInfo = $this->em->getRepository('DufaUserBundle:User')->find($v);
                $obj->setUserId($userInfo);
            }
            else
            {
                $obj->$setMethod($v);
            }

        }
        $this->em->persist($obj);
        $this->em->flush();

        return $obj;
    }

    public function update($id = 0, $data = array())
    {
        $obj = $this->repo->find($id);
        foreach ($data as $k => $v) {
            $setMethod = 'set'.ucfirst($k);
            $obj->$setMethod($v);
        }
        $this->em->persist($obj);
        $this->em->flush();

        return $obj;
    }

}
