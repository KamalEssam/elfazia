<?php

use Faker\Factory as Faker;
use App\Models\test999;
use App\Repositories\test999Repository;

trait Maketest999Trait
{
    /**
     * Create fake instance of test999 and save it in database
     *
     * @param array $test999Fields
     * @return test999
     */
    public function maketest999($test999Fields = [])
    {
        /** @var test999Repository $test999Repo */
        $test999Repo = App::make(test999Repository::class);
        $theme = $this->faketest999Data($test999Fields);
        return $test999Repo->create($theme);
    }

    /**
     * Get fake instance of test999
     *
     * @param array $test999Fields
     * @return test999
     */
    public function faketest999($test999Fields = [])
    {
        return new test999($this->faketest999Data($test999Fields));
    }

    /**
     * Get fake data of test999
     *
     * @param array $postFields
     * @return array
     */
    public function faketest999Data($test999Fields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'test' => $fake->word
        ], $test999Fields);
    }
}
