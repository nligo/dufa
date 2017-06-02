<?php

namespace Dufa\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping\Annotation as ORM;

/**
 * @author  coffey  <coffey@nligo.com>
 * ModulePermissions
 *
 * @ORM\Table(name="module_permissions")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Dufa\Bundle\UserBundle\Repository\ModulePermissionsRepository")
 */
class ModulePermissions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer",options={"comment":"id"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Modules")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     */
    private $moduleId;

    /**
     * @ORM\ManyToOne(targetEntity="RolePermissions")
     * @ORM\JoinColumn(name="role_permissions_id", referencedColumnName="id")
     */
    private $permissionId;

    /**
     * @var integer
     * @ORM\Column(type="integer",name="create_time",options={"comment":"创建时间"})
     */
    public $createTime = "";

    /**
     * @ORM\PrePersist
     */
    public function PrePersist()
    {
        $this->setCreateTime(time());
    }
    
    public function getId()
    {
        return $this->id;
    }
}
