<?php

namespace App\Tests\ValueObject;

use PHPUnit\Framework\TestCase,
    App\ValueObject\User,
    App\ValueObject\Company,
    App\ValueObject\Address,
    App\ValueObject\Geo,
    Symfony\Component\Serializer\Encoder\JsonEncoder,
    Symfony\Component\Serializer\Serializer,
    Symfony\Component\Serializer\Normalizer\ObjectNormalizer,
    Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;

use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Doctrine\Common\Annotations\AnnotationReader;

class UserTest extends TestCase
{
    protected $testObj = null;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
        $this->testObj = null;
    }

    public function testCreateInstance()
    {
        $company = new Company('cname', 'cp', 'bs');
        $address = new Address('streetA', 'suiteA', 'cityA', 'zipcodeA', new Geo(100.00, 200.00));
        $this->testObj = new User(1, 'foo', 'userfoo', 'email', $address, 'phone1', 'web', $company);
        $this->assertTrue(is_object($this->testObj));
    }

    public function testSerializeToJson()
    {
        $company = new Company('cname', 'cp', 'bs');
        $address = new Address('street', 'suite', 'city', 'zipCode', new Geo(123, 12));
        $user = new User(1, 'foo', 'username', 'email', $address, 'phone1', 'web', $company);

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(), new ArrayDenormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $result = $serializer->serialize($user, 'json');
        $this->assertTrue(is_string($result));
        $json = json_decode($result);
        $this->assertEquals($user->getId(), $json->id);
        $this->assertEquals($user->getName(), $json->name);
        $this->assertEquals($user->getUsername(), $json->username);
        $this->assertEquals($user->getEmail(), $json->email);
        // check address
        $this->assertEquals($user->getAddress()->getCity(), $json->address->city);
        $this->assertEquals($user->getAddress()->getStreet(), $json->address->street);
        $this->assertEquals($user->getAddress()->getSuite(), $json->address->suite);
        $this->assertEquals($user->getAddress()->getZipcode(), $json->address->zipcode);
        // check address geo
        $this->assertEquals($user->getAddress()->getGeo()->getLat(), $json->address->geo->lat);
        $this->assertEquals($user->getAddress()->getGeo()->getLng(), $json->address->geo->lng);
        // check company
        $this->assertEquals($user->getCompany()->getName(), $json->company->name);
        $this->assertEquals($user->getCompany()->getCatchPhrase(), $json->company->catchPhrase);
        $this->assertEquals($user->getCompany()->getBs(), $json->company->bs);

        $this->assertEquals($user->getPhone(), $json->phone);
        $this->assertEquals($user->getWebsite(), $json->website);

    }

    /**
     * @param $jsonString
     * @dataProvider fromJsonDataProvider
     */
    public function testUnserializeFromJson(string $jsonString)
    {
        $json = json_decode($jsonString);
        $this->assertTrue(is_array($json));

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

        $encoders = [new JsonEncoder()];
        $normalizers = [
            new ObjectNormalizer($classMetadataFactory,$metadataAwareNameConverter),
            new ArrayDenormalizer()
        ];
        $serializer = new Serializer($normalizers, $encoders);
        $retVal = $serializer->deserialize($jsonString, 'App\ValueObject\User[]', 'json');
        $this->assertTrue(is_array($retVal));

        $json = array_shift($json);
        $retVal = array_shift($retVal);

        $this->assertEquals($json->id, $retVal->getId());
        $this->assertEquals($json->name, $retVal->getName());
        $this->assertEquals($json->username, $retVal->getUsername());
        $this->assertEquals($json->email, $retVal->getEmail());
        $this->assertEquals($json->company->name, $retVal->getCompany()->getName());
        $this->assertEquals($json->company->catchPhrase, $retVal->getCompany()->getCatchPhrase());
        $this->assertEquals($json->company->bs, $retVal->getCompany()->getBs());
        $this->assertEquals($json->address->street, $retVal->getAddress()->getStreet());
        $this->assertEquals($json->address->suite, $retVal->getAddress()->getSuite());
        $this->assertEquals($json->address->city, $retVal->getAddress()->getCity());
        $this->assertEquals($json->address->zipcode, $retVal->getAddress()->getZipcode());
        $this->assertEquals($json->address->geo->lat, $retVal->getAddress()->getGeo()->getLat());
        $this->assertEquals($json->address->geo->lng, $retVal->getAddress()->getGeo()->getLng());
        $this->assertEquals($json->phone, $retVal->getPhone());
        $this->assertEquals($json->website, $retVal->getWebsite());
    }

    public function fromJsonDataProvider(): array
    {
        return [
            [<<<EOF
                [{
                    "id": 1,
                    "name": "Leanne Graham",
                    "username" : "Bret",
                    "email" : "Sincere@april.biz",
                    "address": {
                      "street": "Kulas Light",
                      "suite": "Apt. 556",
                      "city": "Gwenborough",
                      "zipcode": "92998-3874",
                      "geo": {
                        "lat": "-37.3159",
                        "lng": "81.1496"
                      }
                    },
                    "phone": "(775)976-6794 x41206",
                    "website": "conrad.com",
                    "company": {
                        "name": "Romaguera-Crona",
                        "catchPhrase": "Multi-layered client-server neural-net",
                        "bs": "harness real-time e-markets"
                    }              
                }]
                EOF
            ],
            [<<<EOF
                [{
                    "id": 10,
                    "name": "Clementina DuBuque",
                    "username": "Moriah.Stanton",
                    "email": "Rey.Padberg@karina.biz",
                    "address": {
                      "street": "Kattie Turnpike",
                      "suite": "Suite 198",
                      "city": "Lebsackbury",
                      "zipcode": "31428-2261",
                      "geo": {
                        "lat": "-38.2386",
                        "lng": "57.2232"
                      }
                    },
                    "phone": "024-648-3804",
                    "website": "ambrose.net",
                    "company": {
                      "name": "Hoeger LLC",
                      "catchPhrase": "Centralized empowering task-force",
                      "bs": "target end-to-end models"
                    }
                  }]
                EOF
            ]

        ];
    }
}