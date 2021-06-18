<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class ListWorkersTest extends ApiTestCase
{
    public function testGetWorkers(): void
    {
        $response = static::createClient()->request('GET', '/api/workers', [
        'headers' => ['Content-Type' => 'application/json'],
        ]);

        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseIsSuccessful();
        $this->assertIsObject($response);
        $this->assertNotNull($response);
    }
}
