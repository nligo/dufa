<?php
namespace Dufa\Bundle\CoreBundle\Manager;

use Doctrine\ORM\EntityManager;

class AskQuestions
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
}