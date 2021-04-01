<?php
namespace App\ValueObject;
use Symfony\Component\Serializer\Annotation\SerializedName;

class User
{
    /**
     * @SerializedName("id")
     */
    private int $id;

    /**
     * @SerializedName("name")
     */
    private string $name;

    /**
     * @SerializedName("username")
     */
    private string $username;

    /**
     * @SerializedName("email")
     */
    private string $email;


    /**
     * @SerializedName("address")
     */
    private Address $address;

    /**
     * @SerializedName("phone")
     */
    private string $phone;


    /**
     * @SerializedName("website")
     */
    private string $website;

    /**
     * @SerializedName("company")
     */
    private Company $company;

    public function __construct(
        int $id,
        string $name,
        string $username,
        string $email,
        Address $address,
        string $phone,
        string $website,
        Company $company)
    {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->address = $address;
        $this->phone = $phone;
        $this->website = $website;
        $this->company = $company;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function getUsername(): string
    {
        return $this->username;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function getAddress(): Address
    {
        return $this->address;
    }


    public function getCompany(): Company
    {
        return $this->company;
    }


    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }
}