<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Member;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserInfoRepository")
 */
class UserInfo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $bornAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;


    /**
     * One User has One UserInfo.
     * @ORM\OneToOne(targetEntity="Member", mappedBy="userInfo",  cascade = "remove")
    * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
    */
    private $member;



    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBornAt()
    {
        return $this->bornAt;
    }

    public function setBornAt(\DateTimeInterface $bornAt): self
    {
        $this->bornAt = $bornAt;

        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function serialize()
    {
        return serialize([
            $this->firstName,
            $this->lastName,
            $this->bornAt,
            $this->city,
            $this->address,
            $this->description,
            $this->member,

        ]);
        // TODO: Implement serialize() method.
    }

    public function unserialize($serialized)
    {
        list (
            $this->firstName,
            $this->lastName,
            $this->bornAt,
            $this->city,
            $this->address,
            $this->description,
            $this->member,

            ) = unserialize($serialized);
        // TODO: Implement unserialize() method.
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(Member $member): self
    {
        $this->member = $member;

        // set the owning side of the relation if necessary
        if ($this !== $member->getUserInfo()) {
            $member->setUserInfo($this);
        }

        return $this;
    }

}
