<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Geo;

/**
 * @ORM\Embeddable()
 */
class Address
{
    /**
     * @SerializedName("street")
     * @var string
     */
    private string $street;

    /**
     * @SerializedName("suite")
     * @var string
     */
    private string $suite;

    /**
     * @SerializedName("city")
     * @var string
     */
    private string $city;

    /**
     * @SerializedName("zipcode")
     * @var string
     */
    private string $zipcode;

    /**
     * @SerializedName("geo")
     * @var Geo
     */
    private Geo $geo;

}