<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class test3ApiTest extends TestCase
{
    use Maketest3Trait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatetest3()
    {
        $test3 = $this->faketest3Data();
        $this->json('POST', '/api/v1/test3s', $test3);

        $this->assertApiResponse($test3);
    }

    /**
     * @test
     */
    public function testReadtest3()
    {
        $test3 = $this->maketest3();
        $this->json('GET', '/api/v1/test3s/'.$test3->id);

        $this->assertApiResponse($test3->toArray());
    }

    /**
     * @test
     */
    public function testUpdatetest3()
    {
        $test3 = $this->maketest3();
        $editedtest3 = $this->faketest3Data();

        $this->json('PUT', '/api/v1/test3s/'.$test3->id, $editedtest3);

        $this->assertApiResponse($editedtest3);
    }

    /**
     * @test
     */
    public function testDeletetest3()
    {
        $test3 = $this->maketest3();
        $this->json('DELETE', '/api/v1/test3s/'.$test3->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/test3s/'.$test3->id);

        $this->assertResponseStatus(404);
    }
}
