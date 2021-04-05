<?php
namespace App\Service\Factory;

use Symfony\Component\Serializer\Serializer;

interface UserSerializerFactoryInterface
{
    public function create(): Serializer;
}