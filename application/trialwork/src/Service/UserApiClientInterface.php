<?php
namespace App\Service;

interface UserApiClientInterface {

    public function getUsers(): array;
}