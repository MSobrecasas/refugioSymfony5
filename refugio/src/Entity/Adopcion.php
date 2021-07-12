<?php

namespace App\Entity;

use App\Repository\AdopcionRepository;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdopcionRepository::class)
 */
class Adopcion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Mascota::class, inversedBy="adopcion", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $mascota;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="adopciones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaAdopcion;

    public function __construct()
    {
        $fechaActual = new DateTime(null, new DateTimeZone('America/Argentina/Jujuy'));
         
        $this->fechaAdopcion = $fechaActual;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMascota(): ?Mascota
    {
        return $this->mascota;
    }

    public function setMascota(Mascota $mascota): self
    {
        $this->mascota = $mascota;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getFechaAdopcion(): ?\DateTimeInterface
    {
        return $this->fechaAdopcion;
    }

    public function setFechaAdopcion(\DateTimeInterface $fechaAdopcion): self
    {
        $this->fechaAdopcion = $fechaAdopcion;

        return $this;
    }
}
