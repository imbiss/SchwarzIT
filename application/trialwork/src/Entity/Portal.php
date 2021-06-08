<?php

namespace App\Entity;

use App\Repository\PortalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @Assert\NotBlank
     */
    private $locale;

    /**
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    private $imprint;

    /**
     * @ORM\OneToMany(targetEntity=Page::class, mappedBy="portal", orphanRemoval=true)
     */
    private $pages;

    public function __construct()
    {
        $this->pages = new ArrayCollection();
    }


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

    /**
     * @return Collection|Page[]
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages[] = $page;
            $page->setPortal($this);
        }

        return $this;
    }

    public function removePage(Page $page): self
    {
        if ($this->pages->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getPortal() === $this) {
                $page->setPortal(null);
            }
        }

        return $this;
    }

    // Need to build form drop down select options
    public function __toString()
    {
        return sprintf("[%s] %s", $this->locale, $this->imprint);
    }
}
