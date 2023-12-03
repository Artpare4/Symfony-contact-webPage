<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 1,
        max: 30,
        minMessage: 'Votre prénom ne doit pas être en dessous de {{ limit }} caractères',
        maxMessage: 'Votre prénom ne doit pas dépasser {{ limit }} caractères',
    )]
    private ?string $firstname = null;

    #[ORM\Column(length: 40)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 1,
        max: 40,
        minMessage: 'Votre nom de famille ne doit pas être en dessous de {{ limit }} caractères',
        maxMessage: 'Votre nom de famille ne doit pas dépasser {{ limit }} caractères',
    )]
    private ?string $lastname = null;

    #[ORM\Column(length: 100)]
    #[Assert\Length(
        min: 1,
        max: 100,
        minMessage: 'Votre email ne doit pas être en dessous de {{ limit }} caractères',
        maxMessage: 'Votre email ne doit pas dépasser {{ limit }} caractères',
    )]
    #[Assert\Email(
        message: 'L\'email {{ value }} n\'est pas valide.',
    )]
    private ?string $email = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(
        min: 1,
        max: 20,
        minMessage: 'Votre numéro de téléphone ne doit pas être en dessous de {{ limit }} caractères',
        maxMessage: 'Votre numéro de téléphone ne doit pas dépasser {{ limit }} caractères',
    )]
    #[Assert\Regex(
        pattern: '/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4})$/',
        message: 'Format de téléphone invalide'
    )]
    private ?string $phone = null;

    #[ORM\ManyToOne(inversedBy: 'contacts')]
    private ?Category $category = null;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
