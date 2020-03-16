<?php

use Faker\Factory as Faker;
use App\Models\test9992;
use App\Repositories\test9992Repository;

trait Maketest9992Trait
{
    /**
     * Create fake instance of test9992 and save it in database
     *
     * @param array $test9992Fields
     * @return test9992
     */
    public function maketest9992($test9992Fields = [])
    {
        /** @var test9992Repository $test9992Repo */
        $test9992Repo = App::make(test9992Repository::class);
        $theme = $this->faketest9992Data($test9992Fields);
        return $test9992Repo->create($theme);
    }

    /**
     * Get fake instance of test9992
     *
     * @param array $test9992Fields
     * @return test9992
     */
    public function faketest9992($test9992Fields = [])
    {
        return new test9992($this->faketest9992Data($test9992Fields));
    }

    /**
     * Get fake data of test9992
     *
     * @param array $postFields
     * @return array
     */
    public function faketest9992Data($test9992Fields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'test' => $fake->word
        ], $test9992Fields);
    }
}
