<?php

use Faker\Factory as Faker;
use App\Models\testrelation;
use App\Repositories\testrelationRepository;

trait MaketestrelationTrait
{
    /**
     * Create fake instance of testrelation and save it in database
     *
     * @param array $testrelationFields
     * @return testrelation
     */
    public function maketestrelation($testrelationFields = [])
    {
        /** @var testrelationRepository $testrelationRepo */
        $testrelationRepo = App::make(testrelationRepository::class);
        $theme = $this->faketestrelationData($testrelationFields);
        return $testrelationRepo->create($theme);
    }

    /**
     * Get fake instance of testrelation
     *
     * @param array $testrelationFields
     * @return testrelation
     */
    public function faketestrelation($testrelationFields = [])
    {
        return new testrelation($this->faketestrelationData($testrelationFields));
    }

    /**
     * Get fake data of testrelation
     *
     * @param array $postFields
     * @return array
     */
    public function faketestrelationData($testrelationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'test1' => $fake->word,
            'test2' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $testrelationFields);
    }
}
