<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user'])]
    private ?int $id = null;

    #[Groups(['user'])]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    #[Groups(['user'])]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    #[Groups(['user'])]
    private ?bool $ismale = null;

    #[Groups(['user'])]
    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[Groups(['user'])]
    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[Groups(['user'])]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datebirth = null;

    #[Groups(['user'])]
    #[ORM\Column]
    private ?int $adnum = null;

    #[Groups(['user'])]
    #[ORM\Column(length: 255)]
    private ?string $adstreet = null;

    #[Groups(['user'])]
    #[ORM\Column(length: 255)]
    private ?string $adcity = null;

    #[Groups(['user'])]
    #[ORM\Column(length: 255)]
    private ?string $adpostalcode = null;

    #[ORM\ManyToMany(targetEntity: Nft::class, inversedBy: 'users')]
    private Collection $nfts;

    public function __construct()
    {
        $this->nfts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isIsmale(): ?bool
    {
        return $this->ismale;
    }

    public function setIsmale(bool $ismale): static
    {

        $estHomme = $ismale == 'm';
        $this->ismale = $estHomme; //$ismale;

        return $this;
    }


//     public function isIsmale(): ?bool
// {
//     return $this->ismale;
// }

// public function setIsmale(bool $ismale): static
// {
//     $this->ismale = $ismale;
//     return $this;
// }


    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getDatebirth(): ?\DateTimeInterface
    {
        return $this->datebirth;
    }

    public function setDatebirth(\DateTimeInterface $datebirth): static
    {
        $this->datebirth = $datebirth;

        return $this;
    }

    public function getAdnum(): ?int
    {
        return $this->adnum;
    }

    public function setAdnum(int $adnum): static
    {
        $this->adnum = $adnum;

        return $this;
    }

    public function getAdstreet(): ?string
    {
        return $this->adstreet;
    }

    public function setAdstreet(string $adstreet): static
    {
        $this->adstreet = $adstreet;

        return $this;
    }

    public function getAdcity(): ?string
    {
        return $this->adcity;
    }

    public function setAdcity(string $adcity): static
    {
        $this->adcity = $adcity;

        return $this;
    }

    public function getAdpostalcode(): ?string
    {
        return $this->adpostalcode;
    }

    public function setAdpostalcode(string $adpostalcode): static
    {
        $this->adpostalcode = $adpostalcode;

        return $this;
    }

    public function __toString(): string
    {
        return $this->email;
    }

    /**
     * @return Collection<int, Nft>
     */
    public function getNfts(): Collection
    {
        return $this->nfts;
    }

    public function addNft(Nft $nft): static
    {
        if (!$this->nfts->contains($nft)) {
            $this->nfts->add($nft);
        }

        return $this;
    }

    public function removeNft(Nft $nft): static
    {
        $this->nfts->removeElement($nft);

        return $this;
    }

}
