<?php
namespace App\ValueObject;
use Geo;

/**
 * @ORM\Embeddable()
 */
class Address
{
    private string $street;
    private string $suite;
    private string $city;
    private string $zipcode;
    private Geo $geo;

}