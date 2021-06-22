<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class AddWorkerTest extends ApiTestCase
{
    public function testAddWorker(): void
    {
        
        $response = static::createClient()->request(
            'POST', 
            '/api/workers', [
                'headers' => ['Content-Type' => 'application/json'],
                array('[{
                    "name":"Piotr",
                    "surname":"Kowalski",
                    "salary": 6000,
                    "street_name": "Marszałkowska",
                    "house_no": "21/37",
                    "zip_code":"00-123",
                    "city":"Warszawa",
                    "worker_type":"Founder"
                }]')
            ]
        ); 

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseIsSuccessful();
    }
}
