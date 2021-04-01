<?php
namespace App\Entity;
/**
 * @ORM\Embeddable()
 */
class Company
{
    private string $name;
    private string $catchPhrase;
    private string $bs;
}