<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class SalaryDetailsTest extends ApiTestCase
{
    public function testSalaryDetails(): void
    {
        $response = static::createClient()->request('GET', '/api/salary_details', [
        'headers' => ['Content-Type' => 'application/json'],
        ]);

        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseIsSuccessful();
        $this->assertIsObject($response);
        $this->assertNotNull($response);
    }   
}
