<?php

namespace Appcoachs\Bundle\UserBundle\Document;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * User Class.
 *
 * @MongoDB\Document(
 *    repositoryClass="Appcoachs\Bundle\UserBundle\Document\Repository\UserRepository",
 *    collection="user"
 * )
 * @MongoDB\HasLifecycleCallbacks
 */
class User implements UserInterface
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    private $id;

    /**
     *@var string
     * @MongoDB\Field(type="string",name="username")
     */
    private $username = '';

    /**
     * User nickname.
     *
     * @MongoDB\Field(type="string",name="nickname")
     */
    private $nickname = '';

    /**
     * @var string
     * @MongoDB\Field(type="string",name="password")
     */
    private $password;

    /**
     * @var string
     * @MongoDB\Field(type="string",name="salt")
     */
    private $salt;

    /**
     * @var string
     * @MongoDB\Field(type="string",name="email")
     */
    private $email = '';

    /**
     * User roles.
     *
     * @MongoDB\Field(type="collection",name="roles")
     */
    private $roles = array();

    /**
     *@var string
     * @MongoDB\Field(type="string",name="is_active")
     */
    private $isActive = 'no';

    /**
     * @var string
     * @MongoDB\Field(type="string",name="is_locked")
     */
    private $isLocked = 'no';

    /**
     * @var string
     * @MongoDB\Field(type="string",name="is_delete")
     */
    private $isDelete = 'no';

    /**
     * @var string
     *
     * @MongoDB\Field(type="string",name="confirm_token")
     */
    private $confirmToken = '';

    /**
     * @var int
     *
     * @MongoDB\Field(type="integer",name="token_valid_time")
     */
    private $TokenValidTime = '';

    /**
     * @var int
     * @MongoDB\Field(type="integer",name="last_login")
     */
    private $lastLogin;

    /**
     * @var date
     * @MongoDB\Field(type="date",name="create_at")
     */
    private $createdAt;

    /**
     * @var date
     * @MongoDB\Field(type="date",name="updated_at")
     */
    private $updatedAt;

    /**
     * @MongoDB\ReferenceMany(
     *      targetDocument="Appcoachs\Bundle\UserBundle\Document\Roles",
     *      inversedBy="user",
     *  )
     */
    private $userrole;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Appcoachs\Bundle\UserBundle\Document\UserProfile", inversedBy="user")
     */
    private $userProfile;

    public function __construct()
    {
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->userrole = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Pre Persist.
     *
     * @MongoDB\PrePersist
     */
    public function prePersist()
    {
        if (!$this->createdAt) {
            $this->createdAt = new \DateTime();
            $this->updatedAt = new \DateTime();
        }
    }

    /**
     * @MongoDB\PreUpdate
     */
    public function PreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returns the roles or permissions granted to the user for security.
     */
    public function getRoles()
    {
        $roles = $this->roles;
        // guarantees that a user always has at least one role for security
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    /**
     * @param string
     */
    public function setRole($role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * @param array
     */
    public function setRoles(array $roles)
    {
        $this->roles = (array) $roles;

        return $this;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }
    /**
     * Removes sensitive data from the user.
     */
    public function eraseCredentials()
    {
        // if you had a plainPassword property, you'd nullify it here
        // $this->plainPassword = null;
    }

    /**
     * Set nickname.
     *
     * @param string $nickname
     *
     * @return User
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname.
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive.
     *
     * @param string $isActive
     *
     * @return $this
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive.
     *
     * @return string $isActive
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isLocked.
     *
     * @param string $isLocked
     *
     * @return $this
     */
    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;

        return $this;
    }

    /**
     * Get isLocked.
     *
     * @return string $isLocked
     */
    public function getIsLocked()
    {
        return $this->isLocked;
    }

    /**
     * Set confirmToken.
     *
     * @param string $confirmToken
     *
     * @return $this
     */
    public function setConfirmToken($confirmToken)
    {
        $this->confirmToken = $confirmToken;

        return $this;
    }

    /**
     * Get confirmToken.
     *
     * @return string $confirmToken
     */
    public function getConfirmToken()
    {
        return $this->confirmToken;
    }

    /**
     * Set tokenValidTime.
     *
     * @param int $tokenValidTime
     *
     * @return $this
     */
    public function setTokenValidTime($tokenValidTime)
    {
        $this->TokenValidTime = $tokenValidTime;

        return $this;
    }

    /**
     * Get tokenValidTime.
     *
     * @return int $tokenValidTime
     */
    public function getTokenValidTime()
    {
        return $this->TokenValidTime;
    }

    /**
     * Set lastLogin.
     *
     * @param date $lastLogin
     *
     * @return $this
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin.
     *
     * @return date $lastLogin
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set isDelete.
     *
     * @param string $isDelete
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
     * @return string $isDelete
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }

    /**
     * Add userrole.
     *
     * @param \Appcoachs\Bundle\UserBundle\Document\Roles $userrole
     */
    public function addUserrole(\Appcoachs\Bundle\UserBundle\Document\Roles $userrole)
    {
        $this->userrole[] = $userrole;
    }

    /**
     * Remove userrole.
     *
     * @param \Appcoachs\Bundle\UserBundle\Document\Roles $userrole
     */
    public function removeUserrole(\Appcoachs\Bundle\UserBundle\Document\Roles $userrole)
    {
        $this->userrole->removeElement($userrole);
    }

    /**
     * Get userrole.
     *
     * @return \Doctrine\Common\Collections\Collection $userrole
     */
    public function getUserrole()
    {
        return $this->userrole;
    }


    public function setUserrole(array $roles)
    {
        $this->userrole = $roles;
    }

    /**
     * Set createdAt.
     *
     * @param date $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
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
     * @param date $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return date $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set userProfile.
     *
     * @param \Appcoachs\Bundle\UserBundle\Document\UserProfile $userProfile
     *
     * @return $this
     */
    public function setUserProfile(\Appcoachs\Bundle\UserBundle\Document\UserProfile $userProfile)
    {
        $this->userProfile = $userProfile;

        return $this;
    }

    /**
     * Get userProfile.
     *
     * @return \Appcoachs\Bundle\UserBundle\Document\UserProfile $userProfile
     */
    public function getUserProfile()
    {
        return $this->userProfile;
    }
}
