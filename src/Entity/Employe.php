<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
#[ORM\Table(name: '_admin_employe')]
class Employe
{

    const DEFAULT_CHOICE_LABEL = 'nomComplet';
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fonction $fonction = null;

    // #[ORM\ManyToOne]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?Civilite $civilite = null;

    #[ORM\Column(length: 50)]
    private ?string $contact = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseMail = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], mappedBy: "employe")]
    private ?Utilisateur $utilisateur = null;


   // #[ORM\Column(length: 12)]
   // private ?string $matricule = null;



    #[ORM\ManyToOne(inversedBy: 'employes')]
    private ?Entreprise $entreprise = null;

    // #[ORM\Column(length: 255)]
    // private ?string $numPiece = null;

    // #[ORM\Column(length: 255,nullable: true)]
    // private ?string $contacts = null;

    // #[ORM\Column(length: 255)]
    // private ?string $residence = null;

    #[ORM\Column(nullable: true)]
    private ?bool $genre = null;

    // #[ORM\ManyToOne(cascade: ["persist"], fetch: "EAGER")]
    // #[ORM\JoinColumn(nullable: true)]
    // private ?FichierAdmin $piece = null;


    public function __construct()
    {
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getFonction(): ?Fonction
    {
        return $this->fonction;
    }

    public function setFonction(?Fonction $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

   /* public function getCivilite(): ?Civilite
    {
        return $this->civilite;
    }

    public function setCivilite(?Civilite $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }*/

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getAdresseMail(): ?string
    {
        return $this->adresseMail;
    }

    public function setAdresseMail(string $adresseMail): self
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }



    public function getNomComplet(): ?string
    {
        return $this->getNom() . ' ' . $this->getPrenom();
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }


    public function isGenre(): ?bool
    {
        return $this->genre;
    }

    public function setGenre(bool $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function setUtilisateur(Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        // set the owning side of the relation if necessary
        if ($utilisateur->getEmploye() !== $this) {
            $utilisateur->setEmploye($this);
        }

        return $this;
    }

    /*public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }*/


    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /*public function getNumPiece(): ?string
    {
        return $this->numPiece;
    }

    public function setNumPiece(string $numPiece): static
    {
        $this->numPiece = $numPiece;

        return $this;
    }*/

    // public function getContacts(): ?string
    // {
    //     return $this->contacts;
    // }

    // public function setContacts(string $contacts): static
    // {
    //     $this->contacts = $contacts;

    //     return $this;
    // }

   /* public function getResidence(): ?string
    {
        return $this->residence;
    }

    public function setResidence(string $residence): static
    {
        $this->residence = $residence;

        return $this;
    }
    public function getPiece(): ?FichierAdmin
    {
        return $this->piece;
    }

    public function setPiece(FichierAdmin $piece): static
    {
        $this->piece = $piece;

        return $this;
    }*/
}
