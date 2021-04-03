<?php
namespace App\ValueObject;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Geo
{
    /**
     * @SerializedName("lat")
     */
    private float $lat;

    /**
     * @SerializedName("lng")
     */
    private float $lng;

    public function __construct(float $lat, float $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLng(): float
    {
        return $this->lng;
    }
}