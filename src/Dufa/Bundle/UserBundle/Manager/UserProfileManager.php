<?php

namespace Appcoachs\Bundle\UserBundle\Manager;

use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * @author  coffey
 *
 *
 * Class UserProfileManager
 */
class UserProfileManager
{
    protected $dm;
    protected $repo;
    protected $class;
    protected $container;

    public function __construct(DocumentManager $dm, $class, $container)
    {
        $this->dm = $dm;
        $this->class = $class;
        $this->repo = $dm->getRepository($class);
        $this->container = $container;
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
                $userInfo = $this->dm->getRepository('AppcoachsUserBundle:User')->find($v);
                $obj->setUserId($userInfo);
            }
            else
            {
                $obj->$setMethod($v);
            }

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
