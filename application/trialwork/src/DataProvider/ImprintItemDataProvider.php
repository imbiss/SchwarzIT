<?php
namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Repository\ImprintInterface;
use App\Entity\Imprint;

final class ImprintItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{

    private ImprintInterface $responsitory;

    public function __construct(ImprintInterface $responsitory)
    {
        $this->responsitory = $responsitory;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Imprint::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $locale, string $operationName = null, array $context = []): ?Imprint
    {
        return $this->responsitory->find($locale);
    }
}