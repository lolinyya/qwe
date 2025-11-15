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
    #[Assert\Length(
        max: 120,
        maxMessage: 'Название не может превышать {{ limit }} символов'
    )]
    private ?string $dname = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Цена обязательна')]
    #[Assert\Positive(message: 'Цена должна быть положительным числом')]
    private ?int $price = null;

    /**
     * @var Collection<int, Orders>
     */
    #[ORM\ManyToMany(targetEntity: Orders::class, mappedBy: 'dishes')]
    private Collection $orders;

    /**
     * @var Collection<int, DishImage>
     */
    #[ORM\OneToMany(targetEntity: DishImage::class, mappedBy: 'dish', cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\OrderBy(['sortOrder' => 'ASC'])]
    private Collection $images;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->images = new ArrayCollection();
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
        return $this->orders;
    }

    public function addOrder(Orders $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->addDish($this);
        }
        return $this;
    }

    public function removeOrder(Orders $order): static
    {
        if ($this->orders->removeElement($order)) {
            $order->removeDish($this);
        }
        return $this;
    }

    /**
     * @return Collection<int, DishImage>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(DishImage $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setDish($this);
        }
        return $this;
    }

    public function removeImage(DishImage $image): static
    {
        if ($this->images->removeElement($image)) {
            if ($image->getDish() === $this) {
                $image->setDish(null);
            }
        }
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getMainImage(): ?DishImage
    {
        return $this->images->first() ?: null;
    }
}