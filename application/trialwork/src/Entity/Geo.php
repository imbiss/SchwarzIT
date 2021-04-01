<?php
namespace App\Entity;
/**
 * @ORM\Embeddable()
 */
class Geo
{
    private float $lat;
    private float $lng;
}