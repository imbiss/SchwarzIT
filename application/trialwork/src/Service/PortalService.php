<?php
namespace App\Service;

use App\Repository\PortalRepository;
use App\Entity\Portal;

final class PortalService
{
    private PortalRepository $portalRepo;

    // inject repository
    public function __construct(PortalRepository $portalRepo)
    {
        $this->portalRepo = $portalRepo;
    }

    public function getAllPoral(): array
    {
        return $this->portalRepo->findAllPortals();
    }

    public function updatePortal(Portal $p): void
    {
        $this->portalRepo->save($p);
    }

    public function addPortal(Portal $p): void
    {
        $this->portalRepo->save($p);
    }

    public function removePortalByLocale(string $locale)
    {
        $this->portalRepo->removeByLocale($locale);
    }

    public function findPortalByLocale(string $locale): Portal
    {
        return $this->portalRepo->findByLocale($locale);
    }
}