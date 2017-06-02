<?php

namespace Appcoachs\Bundle\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * RolePermissions Class.
 *
 * @MongoDB\Document(
 *    repositoryClass="Appcoachs\Bundle\UserBundle\Document\Repository\RolePermissionsRepository",
 *    collection="role_permissions"
 * )
 * @MongoDB\HasLifecycleCallbacks
 */
class RolePermissions
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    private $id;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Appcoachs\Bundle\UserBundle\Document\Roles")
     */
    private $roleId;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Appcoachs\Bundle\UserBundle\Document\Modules")
     */
    private $modules;

    /**
     * @var bool
     * @MongoDB\Field(type="string",name="_add")
     */
    private $add = "no";

    /**
     * @var bool
     * @MongoDB\Field(type="string",name="_edit")
     */
    private $edit = "no";

    /**
     * @var bool
     * @MongoDB\Field(type="string",name="_show")
     */
    private $show = "yes";

    /**
     * @var bool
     * @MongoDB\Field(type="string",name="_delete")
     */
    private $delete = "no";

    /**
     * @var date
     * @MongoDB\Field(type="date",name="create_at")
     */
    private $createdAt;

    /**
     * Get id.
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set roleId.
     *
     * @param \Appcoachs\Bundle\UserBundle\Document\Roles $roleId
     *
     * @return $this
     */
    public function setRoleId(\Appcoachs\Bundle\UserBundle\Document\Roles $roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get roleId.
     *
     * @return \Appcoachs\Bundle\UserBundle\Document\Roles $roleId
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set add.
     *
     * @param string $add
     *
     * @return $this
     */
    public function setAdd($add)
    {
        $this->add = $add;

        return $this;
    }

    /**
     * Get add.
     *
     * @return string $add
     */
    public function getAdd()
    {
        return $this->add;
    }

    /**
     * Set edit.
     *
     * @param string $edit
     *
     * @return $this
     */
    public function setEdit($edit)
    {
        $this->edit = $edit;

        return $this;
    }

    /**
     * Get edit.
     *
     * @return string $edit
     */
    public function getEdit()
    {
        return $this->edit;
    }

    /**
     * Set show.
     *
     * @param string $show
     *
     * @return $this
     */
    public function setShow($show)
    {
        $this->show = $show;

        return $this;
    }

    /**
     * Get show.
     *
     * @return string $show
     */
    public function getShow()
    {
        return $this->show;
    }

    /**
     * Set delete.
     *
     * @param string $delete
     *
     * @return $this
     */
    public function setDelete($delete)
    {
        $this->delete = $delete;

        return $this;
    }

    /**
     * Get delete.
     *
     * @return string $delete
     */
    public function getDelete()
    {
        return $this->delete;
    }

    
    /**
     * set module
     *
     * @param \Appcoachs\Bundle\UserBundle\Document\Modules $module
     */
    public function setModule(\Appcoachs\Bundle\UserBundle\Document\Modules $module)
    {
        $this->modules = $module;
    }



    /**
     * Get modules
     *
     * @return \Appcoachs\Bundle\UserBundle\Document\Modules $module
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * Set createdAt
     *
     * @param date $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
