<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class test2ApiTest extends TestCase
{
    use Maketest2Trait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatetest2()
    {
        $test2 = $this->faketest2Data();
        $this->json('POST', '/api/v1/test2s', $test2);

        $this->assertApiResponse($test2);
    }

    /**
     * @test
     */
    public function testReadtest2()
    {
        $test2 = $this->maketest2();
        $this->json('GET', '/api/v1/test2s/'.$test2->id);

        $this->assertApiResponse($test2->toArray());
    }

    /**
     * @test
     */
    public function testUpdatetest2()
    {
        $test2 = $this->maketest2();
        $editedtest2 = $this->faketest2Data();

        $this->json('PUT', '/api/v1/test2s/'.$test2->id, $editedtest2);

        $this->assertApiResponse($editedtest2);
    }

    /**
     * @test
     */
    public function testDeletetest2()
    {
        $test2 = $this->maketest2();
        $this->json('DELETE', '/api/v1/test2s/'.$test2->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/test2s/'.$test2->id);

        $this->assertResponseStatus(404);
    }
}
