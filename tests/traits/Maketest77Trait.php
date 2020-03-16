<?php

use Faker\Factory as Faker;
use App\Models\test77;
use App\Repositories\test77Repository;

trait Maketest77Trait
{
    /**
     * Create fake instance of test77 and save it in database
     *
     * @param array $test77Fields
     * @return test77
     */
    public function maketest77($test77Fields = [])
    {
        /** @var test77Repository $test77Repo */
        $test77Repo = App::make(test77Repository::class);
        $theme = $this->faketest77Data($test77Fields);
        return $test77Repo->create($theme);
    }

    /**
     * Get fake instance of test77
     *
     * @param array $test77Fields
     * @return test77
     */
    public function faketest77($test77Fields = [])
    {
        return new test77($this->faketest77Data($test77Fields));
    }

    /**
     * Get fake data of test77
     *
     * @param array $postFields
     * @return array
     */
    public function faketest77Data($test77Fields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'text' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $test77Fields);
    }
}
