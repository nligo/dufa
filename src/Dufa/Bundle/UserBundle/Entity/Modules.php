<?php

namespace Appcoachs\Bundle\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Modules Class.
 *
 * @MongoDB\Document(
 *    repositoryClass="Appcoachs\Bundle\UserBundle\Document\Repository\ModulesRepository",
 *    collection="modules"
 * )
 * @MongoDB\HasLifecycleCallbacks
 */
class Modules
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    private $id;

    /**
     * @var string
     * @MongoDB\Field(type="string",name="p_id")
     */
    private $pId;

    /**
     * @var string
     * @MongoDB\Field(type="string",name="module_name")
     */
    private $moduleName;

    /**
     * @var string
     * @MongoDB\Field(type="string",name="module_url")
     */
    private $moduleUrl;

    /**
     * @var bool
     * @MongoDB\Field(type="boolean",name="is_enable")
     */
    private $isEnable = true;

    /**
     * @var bool
     * @MongoDB\Field(type="boolean",name="is_delete")
     */
    private $isDelete = false;

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
     * Get id.
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pId.
     *
     * @param string $pId
     *
     * @return $this
     */
    public function setPId($pId)
    {
        $this->pId = $pId;

        return $this;
    }

    /**
     * Get pId.
     *
     * @return string $pId
     */
    public function getPId()
    {
        return $this->pId;
    }

    /**
     * Set moduleName.
     *
     * @param string $moduleName
     *
     * @return $this
     */
    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;

        return $this;
    }

    /**
     * Get moduleName.
     *
     * @return string $moduleName
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * Set moduleUrl.
     *
     * @param string $moduleUrl
     *
     * @return $this
     */
    public function setModuleUrl($moduleUrl)
    {
        $this->moduleUrl = $moduleUrl;

        return $this;
    }

    /**
     * Get moduleUrl.
     *
     * @return string $moduleUrl
     */
    public function getModuleUrl()
    {
        return $this->moduleUrl;
    }

    /**
     * Set isEnable.
     *
     * @param bool $isEnable
     *
     * @return $this
     */
    public function setIsEnable($isEnable)
    {
        $this->isEnable = $isEnable;

        return $this;
    }

    /**
     * Get isEnable.
     *
     * @return bool $isEnable
     */
    public function getIsEnable()
    {
        return $this->isEnable;
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
}
