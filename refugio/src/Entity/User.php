<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;
    
    //////CREADO MANUAL///////////////////////////////////////////////
    
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $nombre;


    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $apellido;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $dni;
    
    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $email;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cantidadMascotas;
    
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $telefono;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity=Adopcion::class, mappedBy="usuario")
     */
    private $adopciones;

    public function __construct()
    {
        $this->isActive = true;
        $this->adopciones = new ArrayCollection();
    }

   
    /////////////////////////////////////////////////////////////////
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
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

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    ///////////////////////////////////////////////////////////
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }
    
    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }
    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCantidadMascotas(): ?int
    {
        return $this->cantidadMascotas;
    }

    public function setCantidadMascotas(int $cantidadMascotas): self
    {
        $this->cantidadMascotas = $cantidadMascotas;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /////////////////////////////////////////////////////////////

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

   

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ]);
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }
    /**
     * @return Collection|Adopcion[]
     */
    public function getAdopciones(): Collection
    {
        return $this->adopciones;
    }

    public function addAdopcione(Adopcion $adopcione): self
    {
        if (!$this->adopciones->contains($adopcione)) {
            $this->adopciones[] = $adopcione;
            $adopcione->setUsuario($this);
        }

        return $this;
    }

    public function removeAdopcione(Adopcion $adopcione): self
    {
        if ($this->adopciones->removeElement($adopcione)) {
            // set the owning side to null (unless already changed)
            if ($adopcione->getUsuario() === $this) {
                $adopcione->setUsuario(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->apellido.", ".$this->nombre;
    }
}
