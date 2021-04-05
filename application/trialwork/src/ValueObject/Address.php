<?php
namespace App\ValueObject;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Address
{
    /**
     * @SerializedName("street")
     */
    private string $street;

    /**
     * @SerializedName("suite")
     */
    private string $suite;

    /**
     * @SerializedName("city")
     */
    private string $city;

    /**
     * @SerializedName("zipcode")
     */
    private string $zipcode;

    /**
     * @SerializedName("geo")
     */
    private Geo $geo;


    public function __construct(string $street, string $suite, string $city, string $zipcode, Geo $geo)
    {
        $this->street = $street;
        $this->suite = $suite;
        $this->city = $city;
        $this->zipcode = $zipcode;
        $this->geo = $geo;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getSuite(): string
    {
        return $this->suite;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @return Geo
     */
    public function getGeo(): Geo
    {
        return $this->geo;
    }
}