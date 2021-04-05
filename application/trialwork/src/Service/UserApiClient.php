<?php
namespace App\Service;
use App\Service\Factory\UserSerializerFactoryInterface;
use App\ValueObject\User;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class UserApiClient implements UserApiClientInterface
{
    /**
     * @var HttpClientInterface
     */
    private ?HttpClientInterface $client = null;

    private UserSerializerFactoryInterface $factory;

    const RESOURCE_USR_URL = "https://jsonplaceholder.typicode.com/users";

    public function __construct(HttpClientInterface $client, UserSerializerFactoryInterface $factory)
    {
        $this->client = $client;
        $this->factory = $factory;
    }

    /**
     * Make http rest api call and return array of users objects.
     *
     * @return User[]
     */
    public function getUsers(): array
    {
        return $this->factory
            ->create()
            ->deserialize(
                $this->client->request('GET',self::RESOURCE_USR_URL)->getContent(),
                'App\ValueObject\User[]',
                'json'
            );
    }
}