<?php
namespace App\Repository;

use App\Entity\Imprint;

interface ImprintInterface
{
    public function find(string $locale): ?Imprint ;
}