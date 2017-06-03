<?php

namespace Dufa\Bundle\UserBundle\Manager;

use Doctrine\ORM\EntityManager;

/**
 * @author  coffey
 *
 *
 * Class UserManager
 */
class UserManager
{
    protected $em;

    protected $repo;

    protected $class;

    protected $encode;

    public function __construct(EntityManager $em, $class, $encode)
    {
        $this->em = $em;
        $this->class = $class;
        $this->repo = $em->getRepository($class);
        $this->encode = $encode;
    }

    public function get($id)
    {
        return $this->repo->find($id);
    }

    public function getRepository()
    {
        return $this->repo;
    }

    public function encodePassword($obj, $password)
    {
        $encoder = $this->encode
            ->getEncoder($obj);
        $encoded = $encoder->encodePassword($password, $obj->getSalt());

        return $encoded;
    }
}
