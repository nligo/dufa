<?php
namespace Dufa\Bundle\CoreBundle\Manager;

use Doctrine\ORM\EntityManager;

class User
{
    protected $em;

    protected $repo;

    protected $class;

    protected $encodeFactory;

    public function __construct(EntityManager $em, $class,$encodeFactory) {
        $this->em = $em;
        $this->class = $class;
        $this->repo = $em->getRepository($class);
        $this->encodeFactory = $encodeFactory;
    }

    public function getRepository()
    {
        return $this->repo;
    }

    public function encodePw($obj,$password)
    {
        $encoder = $this->encodeFactory
            ->getEncoder($obj);
        $encoded = $encoder->encodePassword($password, $obj->getSalt());
        return $encoded;
    }

    public function create($data = array())
    {
        $class = $this->class;
        $obj = new $class();
        foreach ($data as $k => $v) {
            $setMethod = 'set'.ucfirst($k);
            if($k == "password")
            {
                $password = $this->encodePw($obj,$k);
                $obj->$setMethod($password);
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
}