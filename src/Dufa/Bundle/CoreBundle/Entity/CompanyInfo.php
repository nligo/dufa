<?php

namespace Dufa\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyInfo
 *
 * @ORM\Table(name="company_info")
 * @ORM\Entity(repositoryClass="Dufa\Bundle\CoreBundle\Repository\CompanyInfo")
 */
class CompanyInfo extends Base
{
    const CERTIFICATION_STATUS_INIT = "init";

    const CERTIFICATION_STATUS_WAIT = "wait";

    const CERTIFICATION_STATUS_PASS = "pass";

    const CERTIFICATION_STATUS_REJECT = "reject";

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=120, nullable=false)
     */
    private $name = "";

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=120, nullable=false)
     */
    private $address = "";

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=120, nullable=false)
     */
    private $contact = "";

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=120, nullable=false)
     */
    private $phone = "";

    /**
     * @var string
     *
     * @ORM\Column(name="contact_type", type="string", length=50, nullable=false)
     */
    private $contactType = "";

    /**
     * @var string
     *
     * @ORM\Column(name="business", type="string", length=120, nullable=true)
     */
    private $business = "";

    /**
     * @var string
     *
     * @ORM\Column(name="area", type="string", length=120, nullable=true)
     */
    private $area = "";

    /**
     * @var string
     *
     * @ORM\Column(name="scale", type="string", length=120, nullable=false)
     */
    private $scale = "";

    /**
     * @var string
     *
     * @ORM\Column(name="reg_contents", type="string", length=120, nullable=true)
     */
    private $regContents = "";

    /**
     * @var string
     *
     * @ORM\Column(name="license", type="text",nullable=false)
     */
    private $license = "";

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="text",nullable=false)
     */
    private $brand = "";

    /**
     * @var string
     *
     * @ORM\Column(name="company_type", type="string", length=120, nullable=false)
     */
    private $companyType = "";

    /**
     * @var string
     *
     * @ORM\Column(name="certification_status", type="string", length=20, nullable=false)
     */
    private $certificationStatus = self::CERTIFICATION_STATUS_INIT;

    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CompanyInfo
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return CompanyInfo
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return CompanyInfo
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return CompanyInfo
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
     * Set contactType
     *
     * @param string $contactType
     *
     * @return CompanyInfo
     */
    public function setContactType($contactType)
    {
        $this->contactType = $contactType;

        return $this;
    }

    /**
     * Get contactType
     *
     * @return string
     */
    public function getContactType()
    {
        return $this->contactType;
    }

    /**
     * Set business
     *
     * @param string $business
     *
     * @return CompanyInfo
     */
    public function setBusiness($business)
    {
        $this->business = $business;

        return $this;
    }

    /**
     * Get business
     *
     * @return string
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * Set area
     *
     * @param string $area
     *
     * @return CompanyInfo
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set scale
     *
     * @param string $scale
     *
     * @return CompanyInfo
     */
    public function setScale($scale)
    {
        $this->scale = $scale;

        return $this;
    }

    /**
     * Get scale
     *
     * @return string
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * Set regContents
     *
     * @param string $regContents
     *
     * @return CompanyInfo
     */
    public function setRegContents($regContents)
    {
        $this->regContents = $regContents;

        return $this;
    }

    /**
     * Get regContents
     *
     * @return string
     */
    public function getRegContents()
    {
        return $this->regContents;
    }

    /**
     * Set license
     *
     * @param string $license
     *
     * @return CompanyInfo
     */
    public function setLicense($license)
    {
        $this->license = $license;

        return $this;
    }

    /**
     * Get license
     *
     * @return string
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return CompanyInfo
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set companyType
     *
     * @param string $companyType
     *
     * @return CompanyInfo
     */
    public function setCompanyType($companyType)
    {
        $this->companyType = $companyType;

        return $this;
    }

    /**
     * Get companyType
     *
     * @return string
     */
    public function getCompanyType()
    {
        return $this->companyType;
    }

    /**
     * Set certificationStatus
     *
     * @param string $certificationStatus
     *
     * @return CompanyInfo
     */
    public function setCertificationStatus($certificationStatus)
    {
        $this->certificationStatus = $certificationStatus;

        return $this;
    }

    /**
     * Get certificationStatus
     *
     * @return string
     */
    public function getCertificationStatus()
    {
        return $this->certificationStatus;
    }

    /**
     * Set user
     *
     * @param \Dufa\Bundle\CoreBundle\Entity\User $user
     *
     * @return CompanyInfo
     */
    public function setUser(\Dufa\Bundle\CoreBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Dufa\Bundle\CoreBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
