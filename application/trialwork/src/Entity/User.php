<?php
namespace App\Entity;
use Address, Company;

/**
 * @ORM\Entity
 */
class User
{
    private int $id;
    private string $name;
    private string $username;
    private string $email;

    private Address $address;
    private string $phone;
    private string $website;
    private Company $company;
}