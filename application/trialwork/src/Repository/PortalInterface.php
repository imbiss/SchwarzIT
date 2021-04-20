<?php
namespace App\Repository;

use App\Entity\Portal;

interface PortalInterface
{
    public function findAllPortals(): Array;
    public function findByLocale(string $locale): Portal;
    public function removeByLocale(string $locale): void;
    public function save(Portal $pe): void;
}