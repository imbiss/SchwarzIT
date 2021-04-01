<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM,
    Symfony\Component\Serializer\Annotation\SerializedName,
    Address,
    Company;

/**
 * @ORM\Entity()
 */
class User
{
    /**
     * @SerializedName("id")
     * @var int
     */
    private int $id;

    /**
     * @SerializedName("name")
     * @var string
     */
    private string $name;

    /**
     * @SerializedName("username")
     * @var string
     */
    private string $username;

    /**
     * @SerializedName("email")
     * @var string
     */
    private string $email;

    /**
     * @SerializedName("address")
     * @var Address
     */
    private Address $address;

    /**
     * @SerializedName("phone")
     * @var string
     */
    private string $phone;

    /**
     * @SerializedName("website")
     * @var string
     */
    private string $website;

    /**
     * @SerializedName("company")
     * @var Company
     */
    private Company $company;
}