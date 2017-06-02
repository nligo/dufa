<?php

namespace Appcoachs\Bundle\UserBundle\Manager;

use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * @author  coffey
 *
 *
 * Class UserManager
 */
class UserManager
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

    /**
     * code
     *         413 = "user is locked.",
     *         414 = "user not active.",
     *         415 = "user does not exist.",.
     *
     * @param $email
     */
    public function loadValidUserByEmail($email)
    {
        $obj = $this->getRepository()->findOneBy(array('email' => $email));
        if (empty($obj)) {
            $returnArray = array('code' => 415, 'msg' => 'user does not exist');

            return $returnArray;
        }
        $obj = $this->getRepository()->findOneBy(array('email' => $email, 'isActive' => 'yes'));
        if (empty($obj)) {
            $returnArray = array('code' => 414, 'msg' => 'user not active.');

            return $returnArray;
        }

        $obj = $this->getRepository()->findOneBy(array('email' => $email, 'isActive' => 'yes', 'isLocked' => 'no'));
        if (empty($obj)) {
            $returnArray = array('code' => 413, 'msg' => 'user is locked.');
        } else {
            $returnArray = array('code' => 200, 'msg' => 'login is successful', 'data' => $obj);
        }

        return $returnArray;
    }

    /**
     * @author  coffey
     *
     * romove all role
     *
     * @param $id
     *
     * @return bool
     */
    public function removeAllRole($id)
    {
        $obj = $this->getRepository()->find($id);
        if (!empty($obj)) {
            $list = $obj->getUserrole();
            try {
                foreach ($list as $k => $v) {
                    $obj->removeUserrole($v);
                }
                $this->dm->persist($obj);
                $this->dm->flush();

                return true;
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    public function encodePassword($obj, $password)
    {
        $encoder = $this->container->get('security.encoder_factory')
            ->getEncoder($obj);
        $encoded = $encoder->encodePassword($password, $obj->getSalt());

        return $encoded;
    }

    public function setRoles($obj = array(),$roles = array())
    {
        if(!empty(is_array($roles)) && !empty($obj))
        {
            foreach ($roles as $k=>$v)
            {
                $obj->addUserrole($v);
            }
            return $obj;
        }
        else
        {
            return false;
        }
    }
}
