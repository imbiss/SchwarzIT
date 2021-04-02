<?php
namespace App\Repository;

use App\Entity\Imprint;

final class ImprintRepository implements ImprintInterface
{

    private const DATA_SOURCE = "imprints.csv";


    public function find(string $locale): ?Imprint
    {
        $fullPath = sprintf("%s/../../data/%s",  __DIR__ , self::DATA_SOURCE);
        if (!is_file($fullPath)) {
            throw new \RuntimeException(sprintf("Can not find data source: %s", $fullPath));
        }
        $file = file($fullPath);
        if (!is_array($file)) {
            throw new \RuntimeException(sprintf('Can not load data source %s', $fullPath));
        }

        foreach ($file as $line) {
            $data = str_getcsv($line, ';');
            if ($data[0] == $locale) {
                return new Imprint($locale, $data[1]);
            }
        }
        return null; // not found
    }

    protected function getEntity(): string
    {
        return Imprint::class;
    }


}