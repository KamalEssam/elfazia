<?php

use Faker\Factory as Faker;
use App\Models\testfinal;
use App\Repositories\testfinalRepository;

trait MaketestfinalTrait
{
    /**
     * Create fake instance of testfinal and save it in database
     *
     * @param array $testfinalFields
     * @return testfinal
     */
    public function maketestfinal($testfinalFields = [])
    {
        /** @var testfinalRepository $testfinalRepo */
        $testfinalRepo = App::make(testfinalRepository::class);
        $theme = $this->faketestfinalData($testfinalFields);
        return $testfinalRepo->create($theme);
    }

    /**
     * Get fake instance of testfinal
     *
     * @param array $testfinalFields
     * @return testfinal
     */
    public function faketestfinal($testfinalFields = [])
    {
        return new testfinal($this->faketestfinalData($testfinalFields));
    }

    /**
     * Get fake data of testfinal
     *
     * @param array $postFields
     * @return array
     */
    public function faketestfinalData($testfinalFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'test1' => $fake->word,
            'test2' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word,
            'test_id' => $fake->randomDigitNotNull
        ], $testfinalFields);
    }
}
