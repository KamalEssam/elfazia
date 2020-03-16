<?php

use Faker\Factory as Faker;
use App\Models\testfinalfinal;
use App\Repositories\testfinalfinalRepository;

trait MaketestfinalfinalTrait
{
    /**
     * Create fake instance of testfinalfinal and save it in database
     *
     * @param array $testfinalfinalFields
     * @return testfinalfinal
     */
    public function maketestfinalfinal($testfinalfinalFields = [])
    {
        /** @var testfinalfinalRepository $testfinalfinalRepo */
        $testfinalfinalRepo = App::make(testfinalfinalRepository::class);
        $theme = $this->faketestfinalfinalData($testfinalfinalFields);
        return $testfinalfinalRepo->create($theme);
    }

    /**
     * Get fake instance of testfinalfinal
     *
     * @param array $testfinalfinalFields
     * @return testfinalfinal
     */
    public function faketestfinalfinal($testfinalfinalFields = [])
    {
        return new testfinalfinal($this->faketestfinalfinalData($testfinalfinalFields));
    }

    /**
     * Get fake data of testfinalfinal
     *
     * @param array $postFields
     * @return array
     */
    public function faketestfinalfinalData($testfinalfinalFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'test2' => $fake->word,
            'test5' => $fake->word
        ], $testfinalfinalFields);
    }
}
