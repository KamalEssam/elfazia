<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class testrelationApiTest extends TestCase
{
    use MaketestrelationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatetestrelation()
    {
        $testrelation = $this->faketestrelationData();
        $this->json('POST', '/api/v1/testrelations', $testrelation);

        $this->assertApiResponse($testrelation);
    }

    /**
     * @test
     */
    public function testReadtestrelation()
    {
        $testrelation = $this->maketestrelation();
        $this->json('GET', '/api/v1/testrelations/'.$testrelation->id);

        $this->assertApiResponse($testrelation->toArray());
    }

    /**
     * @test
     */
    public function testUpdatetestrelation()
    {
        $testrelation = $this->maketestrelation();
        $editedtestrelation = $this->faketestrelationData();

        $this->json('PUT', '/api/v1/testrelations/'.$testrelation->id, $editedtestrelation);

        $this->assertApiResponse($editedtestrelation);
    }

    /**
     * @test
     */
    public function testDeletetestrelation()
    {
        $testrelation = $this->maketestrelation();
        $this->json('DELETE', '/api/v1/testrelations/'.$testrelation->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/testrelations/'.$testrelation->id);

        $this->assertResponseStatus(404);
    }
}
