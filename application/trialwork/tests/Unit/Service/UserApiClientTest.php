<?php

namespace App\Tests\Unit\Service;

use App\Service\UserApiClient;
use App\ValueObject\User;
use App\ValueObject\Company;
use App\ValueObject\Address;
use App\ValueObject\Geo;
use PHPUnit\Framework\TestCase;
use App\Service\Factory\UserSerializerFactory;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Component\HttpFoundation\Response;


class UserApiClientTest extends TestCase
{
    protected $testObj = null;



    protected function tearDown(): void
    {
        $this->testObj = null;
    }

    /**
     * @dataProvider jsonDataProvider
     */
    public function testGetUsersFromJson($jsonResponse, $originalUser, $originalAddress, $origianlGeo, $originalCompany)
    {
        $factory = new UserSerializerFactory();
        $response = new MockResponse($jsonResponse);
        $client = new MockHttpClient($response);
        $url = "http://foo/bar";
        $this->testObj = new UserApiClient($client, $factory, $url);
        $this->assertTrue(is_object($this->testObj));

        $retVal = $this->testObj->getUsers();
        $this->assertTrue(is_array($retVal));
        $this->assertEquals(count($retVal), 1);
        $user = array_shift($retVal);
        $this->assertEquals($user, $originalUser);
        $this->assertEquals($user->getAddress(), $originalAddress);
        $this->assertEquals($user->getAddress()->getGeo(), $origianlGeo);
        $this->assertEquals($user->getCompany(), $originalCompany);
    }


    public function jsonDataProvider(): array
    {
        $lat = -37.3159;
        $lng =  81.1496;
        $geo = new Geo($lat, $lng);

        $street = "test straße";
        $suite = "test suite";
        $city = "test city";
        $zipcode = "123123";
        $address = new Address(
            $street,
            $suite,
            $city,
            $zipcode,
            $geo
        );

        $companyName = "Test Ltd";
        $catchPhrase = "catch parse";
        $bs = "foo bar";
        $company = new Company($companyName, $catchPhrase, $bs);

        $id = 123;
        $email = 'babla@email.com';
        $name = "max.mustermann";
        $username = "mmustermann";
        $phone = "123123123";
        $website = "http://www.foo.bar";
        $exampleUser = new User($id, $name, $username, $email, $address, $phone, $website, $company);

        $factory = new UserSerializerFactory();
        $serializer = $factory->create();
        $jsonResponse = $serializer->serialize([$exampleUser], 'json');

        return [
            [$jsonResponse, $exampleUser, $address, $geo, $company]
        ];
    }


}