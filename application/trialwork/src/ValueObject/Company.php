<?php
namespace App\ValueObject;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Company
{
    /**
     * @SerializedName("name")
     */
    private string $name;

    /**
     * @SerializedName("catchPhrase")
     */
    private string $catchPhrase;

    /**
     * @SerializedName("bs")
     */
    private string $bs;

    public function __construct(string $name, string $catchPhrase, string $bs)
    {
        $this->name = $name;
        $this->catchPhrase = $catchPhrase;
        $this->bs = $bs;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCatchPhrase(): string
    {
        return $this->catchPhrase;
    }

    public function getBs(): string
    {
        return $this->bs;
    }
}