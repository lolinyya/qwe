<?php

namespace App\Entity;

use App\Repository\DishesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DishesRepository::class)]
class Dishes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
     #[Assert\NotBlank(message: 'Имя обязательно')]
    private ?string $dname = null;

    #[ORM\Column]
    private ?int $price = null;

    /**
     * @var Collection<int, Orders>
     */
    #[ORM\ManyToMany(targetEntity: Orders::class, mappedBy: 'Dishes')]
    private Collection $Orders;

    public function __construct()
    {
        $this->Orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDname(): ?string
    {
        return $this->dname;
    }

    public function setDname(string $dname): static
    {
        $this->dname = $dname;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

      public function __toString(): string
    {
        return $this->dname . ' — ' . $this->price . ' руб.';
    }

    /**
     * @return Collection<int, Orders>
     */
    public function getOrders(): Collection
    {
        return $this->Orders;
    }

    public function addOrder(Orders $order): static
    {
        if (!$this->Orders->contains($order)) {
            $this->Orders->add($order);
            $order->addDish($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): static
    {
        if ($this->Orders->removeElement($order)) {
            $order->removeDish($this);
        }

        return $this;
    }
}
