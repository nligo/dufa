<?php

namespace Dufa\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Dufa\Bundle\CoreBundle\Repository\User")
 */
class User extends Base implements UserInterface
{
    /**
     * @ORM\Column(type="string", unique=true,name="username",options={"comment":"用户名"})
     */
    private $username = "";

    /**
     * @ORM\Column(type="string",name="nickname",options={"comment":"用户昵称"})
     */
    private $nickname = "";

    /**
     * @ORM\Column(type="string",name="headimg",nullable=true,options={"comment":"用户头像"})
     */
    private $headimg = "";

    /**
     * @ORM\Column(type="string",name="password",options={"comment":"用户密码"})
     */
    private $password;

    /**
     * @ORM\Column(type="json_array",name="roles",options={"comment":"用户角色"})
     */
    private $roles = array();

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=120, nullable=false)
     */
    private $salt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login_time", type="datetime", nullable=true)
     */
    private $lastLoginTime;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_adress", type="string", length=255, nullable=true)
     */
    private $ipAdress = "";

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=50, nullable=false)
     */
    private $phone = "";

    /**
     * @var string
     *
     * @ORM\Column(name="dufa_money", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $dufaMoney = 0.00;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_num", type="integer", length=30, nullable=false)
     */
    private $commentNum = 0;


    public function __construct()
    {
        if(empty($this->salt))
        {
            $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        }
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
     * @param String
     */
    public function setRole($role)
    {
        $this->roles[] = $role;
    }

    /**
     * @param array
     */
    public function setRoles(array $roles)
    {
        $this->roles = (array)$roles;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Removes sensitive data from the user.
     */
    public function eraseCredentials()
    {
        // if you had a plainPassword property, you'd nullify it here
        // $this->plainPassword = null;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    /**
     * Set nickname
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
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return User
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set lastLoginTime
     *
     * @param \DateTime $lastLoginTime
     *
     * @return User
     */
    public function setLastLoginTime($lastLoginTime)
    {
        $this->lastLoginTime = $lastLoginTime;

        return $this;
    }

    /**
     * Get lastLoginTime
     *
     * @return \DateTime
     */
    public function getLastLoginTime()
    {
        return $this->lastLoginTime;
    }

    /**
     * Set ipAdress
     *
     * @param string $ipAdress
     *
     * @return User
     */
    public function setIpAdress($ipAdress)
    {
        $this->ipAdress = $ipAdress;

        return $this;
    }

    /**
     * Get ipAdress
     *
     * @return string
     */
    public function getIpAdress()
    {
        return $this->ipAdress;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set dufaMoney
     *
     * @param string $dufaMoney
     *
     * @return User
     */
    public function setDufaMoney($dufaMoney)
    {
        $this->dufaMoney = $dufaMoney;

        return $this;
    }

    /**
     * Get dufaMoney
     *
     * @return string
     */
    public function getDufaMoney()
    {
        return $this->dufaMoney;
    }

    /**
     * Set commentNum
     *
     * @param string $commentNum
     *
     * @return User
     */
    public function setCommentNum($commentNum)
    {
        $this->commentNum = $commentNum;

        return $this;
    }

    /**
     * Get commentNum
     *
     * @return string
     */
    public function getCommentNum()
    {
        return $this->commentNum;
    }

    /**
     * Set headimg
     *
     * @param string $headimg
     *
     * @return User
     */
    public function setHeadimg($headimg)
    {
        $this->headimg = $headimg;

        return $this;
    }

    /**
     * Get headimg
     *
     * @return string
     */
    public function getHeadimg()
    {
        return $this->headimg;
    }
}
