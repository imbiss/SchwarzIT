<?php
namespace App;
use App\ValueObject\User,
    Symfony\Component\Serializer\Encoder\JsonEncoder,
    Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter,
    Symfony\Component\Serializer\Normalizer\ArrayDenormalizer,
    Symfony\Component\Serializer\Normalizer\ObjectNormalizer,
    Symfony\Component\Serializer\Serializer,
    Symfony\Component\Serializer\SerializerInterface,
    Symfony\Contracts\HttpClient\HttpClientInterface,
    Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory,
    Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader,
    Doctrine\Common\Annotations\AnnotationReader;

class ApiClient
{
    /**
     * @var HttpClientInterface
     */
    private ?HttpClientInterface $client = null;

    /**
     * @var SerializerInterface|null
     */
    private ?SerializerInterface $serializer = null;

    const RESOURCE_USR_URL = "https://jsonplaceholder.typicode.com/users";

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Make http rest api call and return array of users objects.
     *
     * @return User[]
     */
    public function getUsers(): array
    {
        return $this
                ->getSerializer()
                ->deserialize(
                    $this->client->request('GET',self::RESOURCE_USR_URL)->getContent(),
                    'App\ValueObject\User[]',
                    'json'
                );
    }

    /**
     * @return Serializer
     */
    private function getSerializer(): SerializerInterface
    {
        if (null == $this->serializer) {
            $this->initSerializer();
        }
        return $this->serializer;
    }


    private function initSerializer(): self
    {
        $loader = new AnnotationLoader(new AnnotationReader());
        $classMetadataFactory = new ClassMetadataFactory($loader);
        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);
        $encoders = ['json' => new JsonEncoder()];
        $normalizers = [
            new ObjectNormalizer($classMetadataFactory, $metadataAwareNameConverter),
            new ArrayDenormalizer()
        ];
        $this->serializer = new Serializer($normalizers, $encoders);
        return $this;
    }
}