<?php

use Faker\Factory as Faker;
use App\Models\test55;
use App\Repositories\test55Repository;

trait Maketest55Trait
{
    /**
     * Create fake instance of test55 and save it in database
     *
     * @param array $test55Fields
     * @return test55
     */
    public function maketest55($test55Fields = [])
    {
        /** @var test55Repository $test55Repo */
        $test55Repo = App::make(test55Repository::class);
        $theme = $this->faketest55Data($test55Fields);
        return $test55Repo->create($theme);
    }

    /**
     * Get fake instance of test55
     *
     * @param array $test55Fields
     * @return test55
     */
    public function faketest55($test55Fields = [])
    {
        return new test55($this->faketest55Data($test55Fields));
    }

    /**
     * Get fake data of test55
     *
     * @param array $postFields
     * @return array
     */
    public function faketest55Data($test55Fields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'test' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $test55Fields);
    }
}
