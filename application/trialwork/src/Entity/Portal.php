<?php

namespace App\Entity;

use App\Repository\PortalRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * @ApiResource(
 *     collectionOperations={},
 *     itemOperations={"get"},
 *     paginationEnabled=false
 * )
 * @ORM\Entity(repositoryClass=PortalRepository::class)
 */
class Portal
{
    /**
     * @ApiProperty(identifier=false)
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ApiProperty(identifier=true)
     *
     * @ORM\Column(type="string", length=2, unique=true)
     */
    private $locale;

    /**
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    private $imprint;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = strtolower($locale);

        return $this;
    }

    public function getImprint(): ?string
    {
        return $this->imprint;
    }

    public function setImprint(?string $imprint): self
    {
        $this->imprint = $imprint;

        return $this;
    }
}
