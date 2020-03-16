<?php

use App\Models\test3;
use App\Repositories\test3Repository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class test3RepositoryTest extends TestCase
{
    use Maketest3Trait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var test3Repository
     */
    protected $test3Repo;

    public function setUp()
    {
        parent::setUp();
        $this->test3Repo = App::make(test3Repository::class);
    }

    /**
     * @test create
     */
    public function testCreatetest3()
    {
        $test3 = $this->faketest3Data();
        $createdtest3 = $this->test3Repo->create($test3);
        $createdtest3 = $createdtest3->toArray();
        $this->assertArrayHasKey('id', $createdtest3);
        $this->assertNotNull($createdtest3['id'], 'Created test3 must have id specified');
        $this->assertNotNull(test3::find($createdtest3['id']), 'test3 with given id must be in DB');
        $this->assertModelData($test3, $createdtest3);
    }

    /**
     * @test read
     */
    public function testReadtest3()
    {
        $test3 = $this->maketest3();
        $dbtest3 = $this->test3Repo->find($test3->id);
        $dbtest3 = $dbtest3->toArray();
        $this->assertModelData($test3->toArray(), $dbtest3);
    }

    /**
     * @test update
     */
    public function testUpdatetest3()
    {
        $test3 = $this->maketest3();
        $faketest3 = $this->faketest3Data();
        $updatedtest3 = $this->test3Repo->update($faketest3, $test3->id);
        $this->assertModelData($faketest3, $updatedtest3->toArray());
        $dbtest3 = $this->test3Repo->find($test3->id);
        $this->assertModelData($faketest3, $dbtest3->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletetest3()
    {
        $test3 = $this->maketest3();
        $resp = $this->test3Repo->delete($test3->id);
        $this->assertTrue($resp);
        $this->assertNull(test3::find($test3->id), 'test3 should not exist in DB');
    }
}
