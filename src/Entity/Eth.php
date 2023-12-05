<?php

namespace App\Entity;

use App\Repository\EthRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EthRepository::class)]
class Eth
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(["eth"])]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_eth = null;

    #[Groups(["eth"])]
    #[ORM\Column]
    private ?int $value_eth = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEth(): ?\DateTimeInterface
    {
        return $this->date_eth;
    }

    public function setDateEth(\DateTimeInterface $date_eth): static
    {
        $this->date_eth = $date_eth;

        return $this;
    }

    public function getValueEth(): ?int
    {
        return $this->value_eth;
    }

    public function setValueEth(int $value_eth): static
    {
        $this->value_eth = $value_eth;

        return $this;
    }
}
