<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Embeddable()
 */
class Company
{
    private string $name;
    private string $catchPhrase;
    private string $bs;
}