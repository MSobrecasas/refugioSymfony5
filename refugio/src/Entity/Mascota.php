<?php

namespace App\Entity;

use App\Repository\MascotaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MascotaRepository::class)
 */
class Mascota
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nombre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $edad;

    /**
     * @ORM\ManyToOne(targetEntity=RazaMascota::class)
     */
    private $raza;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $tamanio;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaIngreso;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activo;

    /**
     * @ORM\OneToOne(targetEntity=Adopcion::class, mappedBy="mascota", cascade={"persist", "remove"})
     */
    private $adopcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @ORM\ManyToOne(targetEntity=TipoMascota::class)
     */
    private $tipo;

    public function __construct()
    {
        $this->activo = true;
        //$this -> adopcion = null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(?int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getRaza(): ?RazaMascota
    {
        return $this->raza;
    }

    public function setRaza(?RazaMascota $raza): self
    {
        $this->raza = $raza;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getTamanio(): ?string
    {
        return $this->tamanio;
    }

    public function setTamanio(string $tamanio): self
    {
        $this->tamanio = $tamanio;

        return $this;
    }

    public function getFechaIngreso(): ?\DateTimeInterface
    {
        return $this->fechaIngreso;
    }

    public function setFechaIngreso(?\DateTimeInterface $fechaIngreso): self
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    public function getAdopcion(): ?Adopcion
    {
        return $this->adopcion;
    }

    public function setAdopcion(Adopcion $adopcion): self
    {
        // set the owning side of the relation if necessary
        if ($adopcion->getMascota() !== $this) {
            $adopcion->setMascota($this);
        }

        $this->adopcion = $adopcion;

        return $this;
    }

    public function __toString() {
        $string = ($this->nombre." Edad: ".$this->edad." Color ".$this->color);
        return $string;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getTipo(): ?TipoMascota
    {
        return $this->tipo;
    }

    public function setTipo(?TipoMascota $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }
}
