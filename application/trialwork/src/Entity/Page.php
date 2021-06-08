<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass=PageRepository::class)
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $portalId;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @Assert\Type(type="App\Entity\Portal")
     * @Assert\Valid
     * @ORM\ManyToOne(targetEntity=Portal::class, inversedBy="pages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $portal;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    protected string $locale;

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getPortalId(): ?int
    {
        return $this->portalId;
    }

    public function setPortalId(int $portalId): self
    {
        $this->portalId = $portalId;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getLastmodify(): ?\DateTimeInterface
    {
        return $this->lastmodify;
    }

    public function setLastmodify(\DateTimeInterface $lastmodify): self
    {
        $this->lastmodify = $lastmodify;

        return $this;
    }

    public function getPortal(): ?Portal
    {
        return $this->portal;
    }

    public function setPortal(?Portal $portal): self
    {
        $this->portal = $portal;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
