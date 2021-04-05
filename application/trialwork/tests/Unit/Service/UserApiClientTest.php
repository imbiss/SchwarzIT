<?php

namespace App\Tests;

use App\Service\UserApiClient;
use PHPUnit\Framework\TestCase;

class UserApiClientTest extends TestCase
{
    protected $testObj = null;



    protected function tearDown(): void
    {
        $this->testObj = null;
    }

    public function testCreateInstance()
    {
        $this->testObj = new UserApiClient();
        $this->assertTrue(is_object($this->testObj));
    }



}