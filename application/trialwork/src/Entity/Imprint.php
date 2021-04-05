<?php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource,
    ApiPlatform\Core\Annotation\ApiProperty;


/**
 * @ApiResource(
 *     collectionOperations={},
 *     itemOperations={"get"},
 *     paginationEnabled=false
 * )
 */
class Imprint
{
    /**
     * @ApiProperty(identifier=true)
     */
    private string $locale;

    #[Groups(['imprint:item'])]
    private string $content;

    public function __construct(string $locale, string $content)
    {
        $this->locale = $locale;
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }
}