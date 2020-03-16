<?php

use Faker\Factory as Faker;
use App\Models\test2;
use App\Repositories\test2Repository;

trait Maketest2Trait
{
    /**
     * Create fake instance of test2 and save it in database
     *
     * @param array $test2Fields
     * @return test2
     */
    public function maketest2($test2Fields = [])
    {
        /** @var test2Repository $test2Repo */
        $test2Repo = App::make(test2Repository::class);
        $theme = $this->faketest2Data($test2Fields);
        return $test2Repo->create($theme);
    }

    /**
     * Get fake instance of test2
     *
     * @param array $test2Fields
     * @return test2
     */
    public function faketest2($test2Fields = [])
    {
        return new test2($this->faketest2Data($test2Fields));
    }

    /**
     * Get fake data of test2
     *
     * @param array $postFields
     * @return array
     */
    public function faketest2Data($test2Fields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'test' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $test2Fields);
    }
}
