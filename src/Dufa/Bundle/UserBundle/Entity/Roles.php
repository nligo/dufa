<?php

namespace Appcoachs\Bundle\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Roles Class.
 *
 * @MongoDB\Document(
 *    repositoryClass="Appcoachs\Bundle\UserBundle\Document\Repository\RolesRepository",
 *    collection="roles"
 * )
 * @MongoDB\HasLifecycleCallbacks
 */
class Roles
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    private $id;

    /**
     * @var string
     * @MongoDB\Field(type="string",name="role_label")
     */
    private $roleLabel = '';

    /**
     * @var string
     * @MongoDB\Field(type="string",name="role_name")
     */
    private $roleName = '';

    /**
     * @var string
     * @MongoDB\Field(type="string",name="is_lock")
     */
    private $isLock = 'no';

    /**
     * @var string
     * @MongoDB\Field(type="string",name="is_delete")
     */
    private $isDelete = 'no';

    /**
     * @var date
     * @MongoDB\Field(type="date", name="created_at")
     */
    private $createdAt;

    /**
     * @var date
     * @MongoDB\Field(type="date", name="updated_at")
     */
    private $updatedAt;

    /**
     * @MongoDB\ReferenceMany(
     *      targetDocument="Appcoachs\Bundle\UserBundle\Document\User",
     *      inversedBy="role",
     *  )
     */
    protected $roleuser;

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
     * Set roleName.
     *
     * @param string $roleName
     *
     * @return $this
     */
    public function setRoleName($roleName)
    {
        $this->roleName = 'ROLE_'.strtoupper($roleName);

        return $this;
    }

    /**
     * Get roleName.
     *
     * @return string $roleName
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * Set isLock.
     *
     * @param bool $isLock
     *
     * @return $this
     */
    public function setIsLock($isLock)
    {
        $this->isLock = $isLock;

        return $this;
    }

    /**
     * Get isLock.
     *
     * @return bool $isLock
     */
    public function getIsLock()
    {
        return $this->isLock;
    }

    /**
     * Set isDelete.
     *
     * @param bool $isDelete
     *
     * @return $this
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete.
     *
     * @return bool $isDelete
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }

    /**
     * Set createAt.
     *
     * @param date $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($date)
    {
        $this->createdAt = $date;

        return $this;
    }

    /**
     * Get createAt.
     *
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param date $createAt
     *
     * @return $this
     */
    public function setUpdatedAt($date)
    {
        $this->updatedAt = $date;

        return $this;
    }

    /**
     * Get createAt.
     *
     * @return date $createAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function __construct()
    {
        $this->userrole = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add roleuser.
     *
     * @param \Appcoachs\Bundle\UserBundle\Document\User $roleuser
     */
    public function addUserrole(\Appcoachs\Bundle\UserBundle\Document\User $roleuser)
    {
        $this->roleuser[] = $roleuser;
    }

    /**
     * Remove roleuser.
     *
     * @param \Appcoachs\Bundle\UserBundle\Document\User $roleuser
     */
    public function removeUserrole(\Appcoachs\Bundle\UserBundle\Document\User $roleuser)
    {
        $this->roleuser->removeElement($roleuser);
    }

    /**
     * Get userrole.
     *
     * @return \Doctrine\Common\Collections\Collection $roleuser
     */
    public function getUserrole()
    {
        return $this->roleuser;
    }

    /**
     * Set roleLabel.
     *
     * @param string $roleLabel
     *
     * @return $this
     */
    public function setRoleLabel($roleLabel)
    {
        $this->roleLabel = $roleLabel;

        return $this;
    }

    /**
     * Get roleLabel.
     *
     * @return string $roleLabel
     */
    public function getRoleLabel()
    {
        return $this->roleLabel;
    }

    /**
     * Add roleuser.
     *
     * @param Appcoachs\Bundle\UserBundle\Document\User $roleuser
     */
    public function addRoleuser(\Appcoachs\Bundle\UserBundle\Document\User $roleuser)
    {
        $this->roleuser[] = $roleuser;
    }

    /**
     * Remove roleuser.
     *
     * @param Appcoachs\Bundle\UserBundle\Document\User $roleuser
     */
    public function removeRoleuser(\Appcoachs\Bundle\UserBundle\Document\User $roleuser)
    {
        $this->roleuser->removeElement($roleuser);
    }

    /**
     * Get roleuser.
     *
     * @return \Doctrine\Common\Collections\Collection $roleuser
     */
    public function getRoleuser()
    {
        return $this->roleuser;
    }
}
