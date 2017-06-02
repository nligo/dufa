<?php

namespace Appcoachs\Bundle\UserBundle\Manager;

use Doctrine\ODM\MongoDB\DocumentManager;

class RolesManager
{
    protected $dm;
    protected $repo;
    protected $class;

    public function __construct(DocumentManager $dm, $class)
    {
        $this->dm = $dm;
        $this->class = $class;
        $this->repo = $dm->getRepository($class);
    }

    public function get($id)
    {
        return $this->repo->findById($id);
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
        $this->dm->persist($obj);
        $this->dm->flush();

        return $obj;
    }

    public function update($id = 0, $data = array())
    {
        $obj = $this->repo->find($id);
        foreach ($data as $k => $v) {
            $setMethod = 'set'.ucfirst($k);
            $obj->$setMethod($v);
        }
        $this->dm->persist($obj);
        $this->dm->flush();

        return $obj;
    }
}
