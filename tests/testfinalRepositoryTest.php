<?php

use App\Models\testfinal;
use App\Repositories\testfinalRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class testfinalRepositoryTest extends TestCase
{
    use MaketestfinalTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var testfinalRepository
     */
    protected $testfinalRepo;

    public function setUp()
    {
        parent::setUp();
        $this->testfinalRepo = App::make(testfinalRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatetestfinal()
    {
        $testfinal = $this->faketestfinalData();
        $createdtestfinal = $this->testfinalRepo->create($testfinal);
        $createdtestfinal = $createdtestfinal->toArray();
        $this->assertArrayHasKey('id', $createdtestfinal);
        $this->assertNotNull($createdtestfinal['id'], 'Created testfinal must have id specified');
        $this->assertNotNull(testfinal::find($createdtestfinal['id']), 'testfinal with given id must be in DB');
        $this->assertModelData($testfinal, $createdtestfinal);
    }

    /**
     * @test read
     */
    public function testReadtestfinal()
    {
        $testfinal = $this->maketestfinal();
        $dbtestfinal = $this->testfinalRepo->find($testfinal->id);
        $dbtestfinal = $dbtestfinal->toArray();
        $this->assertModelData($testfinal->toArray(), $dbtestfinal);
    }

    /**
     * @test update
     */
    public function testUpdatetestfinal()
    {
        $testfinal = $this->maketestfinal();
        $faketestfinal = $this->faketestfinalData();
        $updatedtestfinal = $this->testfinalRepo->update($faketestfinal, $testfinal->id);
        $this->assertModelData($faketestfinal, $updatedtestfinal->toArray());
        $dbtestfinal = $this->testfinalRepo->find($testfinal->id);
        $this->assertModelData($faketestfinal, $dbtestfinal->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletetestfinal()
    {
        $testfinal = $this->maketestfinal();
        $resp = $this->testfinalRepo->delete($testfinal->id);
        $this->assertTrue($resp);
        $this->assertNull(testfinal::find($testfinal->id), 'testfinal should not exist in DB');
    }
}
