<?php

namespace App\Entity;

use App\Repository\NftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NftRepository::class)]
class Nft
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["nfts"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["nfts"])]
    private ?string $name_nft = null;

    #[ORM\Column]
    #[Groups(["nfts"])]
    private ?int $priceeth = null;

    #[Groups(["nfts"])]
    #[ORM\Column(length: 255)]
    private ?string $pathurl = null;

    #[Groups(["nfts"])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'nfts')]
    private Collection $users;

    #[Groups(["nfts"])]
    #[ORM\ManyToMany(targetEntity: Subcategory::class, inversedBy: 'nfts')]
    private Collection $subcategories;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->subcategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameNft(): ?string
    {
        return $this->name_nft;
    }

    public function setNameNft(string $name_nft): static
    {
        $this->name_nft = $name_nft;

        return $this;
    }

    public function getPriceeth(): ?int
    {
        return $this->priceeth;
    }

    public function setPriceeth(int $priceeth): static
    {
        $this->priceeth = $priceeth;

        return $this;
    }

    public function getPathurl(): ?string
    {
        return $this->pathurl;
    }

    public function setPathurl(string $pathurl): static
    {
        $this->pathurl = $pathurl;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addNft($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeNft($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Subcategory>
     */
    public function getSubcategories(): Collection
    {
        return $this->subcategories;
    }

    public function addSubcategory(Subcategory $subcategory): static
    {
        if (!$this->subcategories->contains($subcategory)) {
            $this->subcategories->add($subcategory);
        }

        return $this;
    }

    public function removeSubcategory(Subcategory $subcategory): static
    {
        $this->subcategories->removeElement($subcategory);

        return $this;
    }
}
