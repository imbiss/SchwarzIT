<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Embeddable()
 */
class Geo
{
    private float $lat;
    private float $lng;
}