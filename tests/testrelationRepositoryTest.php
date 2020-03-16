<?php

use App\Models\testrelation;
use App\Repositories\testrelationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class testrelationRepositoryTest extends TestCase
{
    use MaketestrelationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var testrelationRepository
     */
    protected $testrelationRepo;

    public function setUp()
    {
        parent::setUp();
        $this->testrelationRepo = App::make(testrelationRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatetestrelation()
    {
        $testrelation = $this->faketestrelationData();
        $createdtestrelation = $this->testrelationRepo->create($testrelation);
        $createdtestrelation = $createdtestrelation->toArray();
        $this->assertArrayHasKey('id', $createdtestrelation);
        $this->assertNotNull($createdtestrelation['id'], 'Created testrelation must have id specified');
        $this->assertNotNull(testrelation::find($createdtestrelation['id']), 'testrelation with given id must be in DB');
        $this->assertModelData($testrelation, $createdtestrelation);
    }

    /**
     * @test read
     */
    public function testReadtestrelation()
    {
        $testrelation = $this->maketestrelation();
        $dbtestrelation = $this->testrelationRepo->find($testrelation->id);
        $dbtestrelation = $dbtestrelation->toArray();
        $this->assertModelData($testrelation->toArray(), $dbtestrelation);
    }

    /**
     * @test update
     */
    public function testUpdatetestrelation()
    {
        $testrelation = $this->maketestrelation();
        $faketestrelation = $this->faketestrelationData();
        $updatedtestrelation = $this->testrelationRepo->update($faketestrelation, $testrelation->id);
        $this->assertModelData($faketestrelation, $updatedtestrelation->toArray());
        $dbtestrelation = $this->testrelationRepo->find($testrelation->id);
        $this->assertModelData($faketestrelation, $dbtestrelation->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletetestrelation()
    {
        $testrelation = $this->maketestrelation();
        $resp = $this->testrelationRepo->delete($testrelation->id);
        $this->assertTrue($resp);
        $this->assertNull(testrelation::find($testrelation->id), 'testrelation should not exist in DB');
    }
}
