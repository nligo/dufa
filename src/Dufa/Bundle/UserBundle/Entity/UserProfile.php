<?php

namespace Appcoachs\Bundle\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Intl\Intl;

/**
 * UserProfile Class.
 *
 * @MongoDB\Document(
 *    repositoryClass="Appcoachs\Bundle\UserBundle\Document\Repository\UserProfileRepository",
 *    collection="user_profile"
 * )
 * @MongoDB\HasLifecycleCallbacks
 */
class UserProfile
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    private $id;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Appcoachs\Bundle\UserBundle\Document\User", inversedBy="userProfile")
     */
    protected $user;

    /**
     * UserProfile country.
     *
     * @MongoDB\Field(type="string",name="country")
     */
    private $country;

    /**
     * UserProfile language.
     *
     * @MongoDB\Field(type="string",name="language")
     */
    private $language;

    /**
     * @var date
     * @MongoDB\Field(type="date",name="create_at")
     */
    private $createdAt;

    /**
     * @var date
     * @MongoDB\Field(type="date",name="update_at")
     */
    private $updatedAt;

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user.
     *
     * @param \Appcoachs\Bundle\UserBundle\Document\User $user
     *
     * @return $this
     */
    public function setUser(\Appcoachs\Bundle\UserBundle\Document\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \Appcoachs\Bundle\UserBundle\Document\User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set country.
     *
     * @param  $country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = Intl::getRegionBundle()->getCountryName($country);

        return $this;
    }

    /**
     * Get country.
     *
     * @return $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set language.
     *
     * @param  $language
     *
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = Intl::getLanguageBundle()->getLanguageName($language);

        return $this;
    }

    /**
     * Get language.
     *
     * @return $language
     */
    public function getLanguage()
    {
        return $this->language;
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
}
