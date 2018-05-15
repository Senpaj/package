<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $fk_service;

    /**
     * @ORM\Column(type="integer")
     */
    private $fk_order;

    public function getId()
    {
        return $this->id;
    }

    public function getFkService(): ?int
    {
        return $this->fk_service;
    }

    public function setFkService(int $fk_service): self
    {
        $this->fk_service = $fk_service;

        return $this;
    }

    public function getFkOrder(): ?int
    {
        return $this->fk_order;
    }

    public function setFkOrder(int $fk_order): self
    {
        $this->fk_order = $fk_order;

        return $this;
    }
}
