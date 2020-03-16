<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class testfinalApiTest extends TestCase
{
    use MaketestfinalTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatetestfinal()
    {
        $testfinal = $this->faketestfinalData();
        $this->json('POST', '/api/v1/testfinals', $testfinal);

        $this->assertApiResponse($testfinal);
    }

    /**
     * @test
     */
    public function testReadtestfinal()
    {
        $testfinal = $this->maketestfinal();
        $this->json('GET', '/api/v1/testfinals/'.$testfinal->id);

        $this->assertApiResponse($testfinal->toArray());
    }

    /**
     * @test
     */
    public function testUpdatetestfinal()
    {
        $testfinal = $this->maketestfinal();
        $editedtestfinal = $this->faketestfinalData();

        $this->json('PUT', '/api/v1/testfinals/'.$testfinal->id, $editedtestfinal);

        $this->assertApiResponse($editedtestfinal);
    }

    /**
     * @test
     */
    public function testDeletetestfinal()
    {
        $testfinal = $this->maketestfinal();
        $this->json('DELETE', '/api/v1/testfinals/'.$testfinal->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/testfinals/'.$testfinal->id);

        $this->assertResponseStatus(404);
    }
}
