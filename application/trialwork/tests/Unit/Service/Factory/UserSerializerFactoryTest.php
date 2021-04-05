<?php
namespace App\Tests\Unit\Service\Factory;

use App\Service\Factory\UserSerializerFactory;
use Symfony\Component\Serializer\Serializer;
use PHPUnit\Framework\TestCase;

class UserSerializerFactoryTest extends TestCase
{
    protected $testObj = null;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testObj = new UserSerializerFactory();
    }

    protected function tearDown(): void
    {
        $this->testObj = null;
        parent::tearDown();
    }


    public function testCreate()
    {
        $retVal = $this->testObj->create();
        $this->assertInstanceOf(Serializer::class, $retVal);
    }
}