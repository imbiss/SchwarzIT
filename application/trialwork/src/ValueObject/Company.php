<?php
namespace App\ValueObject;
use Doctrine\ORM\Mapping as ORM,
    Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @ORM\Embeddable()
 */
class Company
{
    /**
     * @SerializedName("name")
     * @var string
     */
    private string $name;

    /**
     * @SerializedName("catchPhrase")
     * @var string
     */
    private string $catchPhrase;

    /**
     * @SerializedName("bs")
     * @var string
     */
    private string $bs;


    public function __construct(string $name, string $catchPhrase, string $bs)
    {
        $this->name = $name;
        $this->catchPhrase = $catchPhrase;
        $this->bs = $bs;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCatchPhrase(): string
    {
        return $this->catchPhrase;
    }

    /**
     * @return string
     */
    public function getBs(): string
    {
        return $this->bs;
    }
}