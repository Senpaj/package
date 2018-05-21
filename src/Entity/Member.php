<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\UserInfo;

/**
 * Member
 *
 * @ORM\Table(name="member")
 * @ORM\Entity(repositoryClass="App\Repository\MemberRepository")
 */
class Member implements UserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64)
     */
    private $password;

    private $plainPassword;

    private $plainPasswordOld;

    private $plainPasswordNew;
   /**
     * One User has One UserInfo.
    * @ORM\OneToOne(targetEntity="UserInfo", inversedBy="member", cascade = "remove")
    */
    private $userInfo;

    /**
     * @var array
     *
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $recovery_hash;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Member
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Member
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Member
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }


    /**
     * @return mixed
     */
    public function getPlainPasswordOld()
    {
        return $this->plainPasswordOld;
    }

    /**
     * @param mixed $plainPasswordOld
     */
    public function setPlainPasswordOld($plainPasswordOld)
    {
        $this->plainPasswordOld = $plainPasswordOld;
    }

    public function getPlainPasswordNew()
    {
        return $this->plainPasswordNew;
    }

    /**
     * @param mixed $plainPasswordNew
     */
    public function setPlainPasswordNew($plainPasswordNew)
    {
        $this->plainPasswordNew = $plainPasswordNew;
    }


    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,

        ]);
        // TODO: Implement serialize() method.
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password
            ) = unserialize($serialized);
        // TODO: Implement unserialize() method.
    }

    public function getRoles()
    {
        $tmpRoles = $this->roles;

        if(in_array('ROLE_USER', $tmpRoles) === false) {
            $tmpRoles[] = 'ROLE_USER';
        }
        return $tmpRoles;
        // TODO: Implement getRoles() method.
    }
    public  function setRoles($roles)
    {
        $this->roles = $roles;
    }
    public function getSalt()
    {
            return null;
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserInfo()//: ?UserInfo
    {
        return $this->userInfo;
    }

    public function setUserInfo(UserInfo $userInfo): self
    {
        $this->userInfo = $userInfo;
        return $this;
    }


    public function getRecoveryHash(): ?string
    {
        return $this->recovery_hash;
    }

    public function setRecoveryHash(?string $recovery_hash): self
    {
        $this->recovery_hash = $recovery_hash;

        return $this;
    }

}
