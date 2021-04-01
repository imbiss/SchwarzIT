<?php
namespace App\ValueObject;
use Doctrine\ORM\Mapping as ORM,
    Symfony\Component\Serializer\Annotation\SerializedName;
/**
 * @ORM\Embeddable()
 */
class Geo
{
    /**
     * @SerializedName("lat")
     * @var float
     */
    private float $lat;

    /**
     * @SerializedName("lng")
     * @var float
     */
    private float $lng;

    public function __construct(float $lat, float $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    /**
     * @return float
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * @return float
     */
    public function getLng(): float
    {
        return $this->lng;
    }
}