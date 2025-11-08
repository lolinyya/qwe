<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Dishes>
     */
    #[ORM\ManyToMany(targetEntity: Dishes::class, inversedBy: 'Orders')]
    #[Assert\Count(min: 1, minMessage: 'Выберите хотя бы одно блюдо')]
    private Collection $Dishes;

    #[ORM\ManyToOne(inversedBy: 'Orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?People $People = null;

    public function __construct()
    {
        $this->Dishes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Dishes>
     */
    public function getDishes(): Collection
    {
        return $this->Dishes;
    }

    public function addDish(Dishes $dish): static
    {
        if (!$this->Dishes->contains($dish)) {
            $this->Dishes->add($dish);
        }

        return $this;
    }

    public function removeDish(Dishes $dish): static
    {
        $this->Dishes->removeElement($dish);

        return $this;
    }

    public function getPeople(): ?People
    {
        return $this->People;
    }

    public function setPeople(?People $People): static
    {
        $this->People = $People;

        return $this;
    }
}
