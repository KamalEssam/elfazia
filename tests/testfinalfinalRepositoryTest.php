<?php

use App\Models\testfinalfinal;
use App\Repositories\testfinalfinalRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class testfinalfinalRepositoryTest extends TestCase
{
    use MaketestfinalfinalTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var testfinalfinalRepository
     */
    protected $testfinalfinalRepo;

    public function setUp()
    {
        parent::setUp();
        $this->testfinalfinalRepo = App::make(testfinalfinalRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatetestfinalfinal()
    {
        $testfinalfinal = $this->faketestfinalfinalData();
        $createdtestfinalfinal = $this->testfinalfinalRepo->create($testfinalfinal);
        $createdtestfinalfinal = $createdtestfinalfinal->toArray();
        $this->assertArrayHasKey('id', $createdtestfinalfinal);
        $this->assertNotNull($createdtestfinalfinal['id'], 'Created testfinalfinal must have id specified');
        $this->assertNotNull(testfinalfinal::find($createdtestfinalfinal['id']), 'testfinalfinal with given id must be in DB');
        $this->assertModelData($testfinalfinal, $createdtestfinalfinal);
    }

    /**
     * @test read
     */
    public function testReadtestfinalfinal()
    {
        $testfinalfinal = $this->maketestfinalfinal();
        $dbtestfinalfinal = $this->testfinalfinalRepo->find($testfinalfinal->id);
        $dbtestfinalfinal = $dbtestfinalfinal->toArray();
        $this->assertModelData($testfinalfinal->toArray(), $dbtestfinalfinal);
    }

    /**
     * @test update
     */
    public function testUpdatetestfinalfinal()
    {
        $testfinalfinal = $this->maketestfinalfinal();
        $faketestfinalfinal = $this->faketestfinalfinalData();
        $updatedtestfinalfinal = $this->testfinalfinalRepo->update($faketestfinalfinal, $testfinalfinal->id);
        $this->assertModelData($faketestfinalfinal, $updatedtestfinalfinal->toArray());
        $dbtestfinalfinal = $this->testfinalfinalRepo->find($testfinalfinal->id);
        $this->assertModelData($faketestfinalfinal, $dbtestfinalfinal->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletetestfinalfinal()
    {
        $testfinalfinal = $this->maketestfinalfinal();
        $resp = $this->testfinalfinalRepo->delete($testfinalfinal->id);
        $this->assertTrue($resp);
        $this->assertNull(testfinalfinal::find($testfinalfinal->id), 'testfinalfinal should not exist in DB');
    }
}
