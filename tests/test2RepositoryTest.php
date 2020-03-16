<?php

use App\Models\test2;
use App\Repositories\test2Repository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class test2RepositoryTest extends TestCase
{
    use Maketest2Trait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var test2Repository
     */
    protected $test2Repo;

    public function setUp()
    {
        parent::setUp();
        $this->test2Repo = App::make(test2Repository::class);
    }

    /**
     * @test create
     */
    public function testCreatetest2()
    {
        $test2 = $this->faketest2Data();
        $createdtest2 = $this->test2Repo->create($test2);
        $createdtest2 = $createdtest2->toArray();
        $this->assertArrayHasKey('id', $createdtest2);
        $this->assertNotNull($createdtest2['id'], 'Created test2 must have id specified');
        $this->assertNotNull(test2::find($createdtest2['id']), 'test2 with given id must be in DB');
        $this->assertModelData($test2, $createdtest2);
    }

    /**
     * @test read
     */
    public function testReadtest2()
    {
        $test2 = $this->maketest2();
        $dbtest2 = $this->test2Repo->find($test2->id);
        $dbtest2 = $dbtest2->toArray();
        $this->assertModelData($test2->toArray(), $dbtest2);
    }

    /**
     * @test update
     */
    public function testUpdatetest2()
    {
        $test2 = $this->maketest2();
        $faketest2 = $this->faketest2Data();
        $updatedtest2 = $this->test2Repo->update($faketest2, $test2->id);
        $this->assertModelData($faketest2, $updatedtest2->toArray());
        $dbtest2 = $this->test2Repo->find($test2->id);
        $this->assertModelData($faketest2, $dbtest2->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletetest2()
    {
        $test2 = $this->maketest2();
        $resp = $this->test2Repo->delete($test2->id);
        $this->assertTrue($resp);
        $this->assertNull(test2::find($test2->id), 'test2 should not exist in DB');
    }
}
