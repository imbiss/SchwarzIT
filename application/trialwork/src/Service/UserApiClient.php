<?php
namespace App\Service;
use App\Service\Exception\Serialize;
use App\Service\Factory\UserSerializerFactoryInterface;
use App\ValueObject\User;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Service\Exception\Network;


class UserApiClient implements UserApiClientInterface
{
    /**
     * @var HttpClientInterface
     */
    private ?HttpClientInterface $client = null;

    private UserSerializerFactoryInterface $factory;

    private string $resourceUrl = '';


    public function __construct(HttpClientInterface $client, UserSerializerFactoryInterface $factory, string $url)
    {
        $this->client = $client;
        $this->factory = $factory;
        $this->resourceUrl = $url;
    }

    /**
     * Make http rest api call and return array of users objects.
     *
     * @return User[]
     */
    public function getUsers(): array
    {
        return $this->parseResponse($this->fetchUser());
    }


    protected function fetchUser(): string
    {
        try {
            return $this->client->request('GET',$this->resourceUrl)->getContent();
        } catch (\Exception $e) {
            throw new Network($e->getMessage());
        }
    }


    protected function parseResponse(string $json): array
    {
        try {
            return $this->factory->create()->deserialize($json, 'App\ValueObject\User[]','json');
        } catch (\Exception $e) {
            throw new Serialize($e->getMessage());
        }
    }

}