<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerOrderRepository")
 */
class CustomerOrder
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $fk_client;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auto_make;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auto_model;
    /**
     * @ORM\Column(type="integer", nullable = true)
     */
    private $status;

    public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getfk_client()
    {
        return $this->fk_client;
    }

    public function setfk_client(int $fk_client): self
    {
        $this->fk_client = $fk_client;

        return $this;
    }
    public function getauto_make()
    {
        return $this->auto_make;
    }

    public function setauto_make(string $auto_make): self
    {
        $this->auto_make = $auto_make;

        return $this;
    }
    public function getauto_model()
    {
        return $this->auto_model;
    }

    public function setauto_model(string $auto_model): self
    {
        $this->auto_model = $auto_model;

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
    public function getStatus()
    {
        $tmpStatus = $this->status;

        if($tmpStatus === false) {
            $tmpStatus = 1;
        }
        return $tmpStatus;
    }
    public  function setStatus($Status)
    {
        $this->status = $Status;
    }
}
