<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class testfinalfinalApiTest extends TestCase
{
    use MaketestfinalfinalTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatetestfinalfinal()
    {
        $testfinalfinal = $this->faketestfinalfinalData();
        $this->json('POST', '/api/v1/testfinalfinals', $testfinalfinal);

        $this->assertApiResponse($testfinalfinal);
    }

    /**
     * @test
     */
    public function testReadtestfinalfinal()
    {
        $testfinalfinal = $this->maketestfinalfinal();
        $this->json('GET', '/api/v1/testfinalfinals/'.$testfinalfinal->id);

        $this->assertApiResponse($testfinalfinal->toArray());
    }

    /**
     * @test
     */
    public function testUpdatetestfinalfinal()
    {
        $testfinalfinal = $this->maketestfinalfinal();
        $editedtestfinalfinal = $this->faketestfinalfinalData();

        $this->json('PUT', '/api/v1/testfinalfinals/'.$testfinalfinal->id, $editedtestfinalfinal);

        $this->assertApiResponse($editedtestfinalfinal);
    }

    /**
     * @test
     */
    public function testDeletetestfinalfinal()
    {
        $testfinalfinal = $this->maketestfinalfinal();
        $this->json('DELETE', '/api/v1/testfinalfinals/'.$testfinalfinal->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/testfinalfinals/'.$testfinalfinal->id);

        $this->assertResponseStatus(404);
    }
}
