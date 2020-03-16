<?php

use Faker\Factory as Faker;
use App\Models\test777;
use App\Repositories\test777Repository;

trait Maketest777Trait
{
    /**
     * Create fake instance of test777 and save it in database
     *
     * @param array $test777Fields
     * @return test777
     */
    public function maketest777($test777Fields = [])
    {
        /** @var test777Repository $test777Repo */
        $test777Repo = App::make(test777Repository::class);
        $theme = $this->faketest777Data($test777Fields);
        return $test777Repo->create($theme);
    }

    /**
     * Get fake instance of test777
     *
     * @param array $test777Fields
     * @return test777
     */
    public function faketest777($test777Fields = [])
    {
        return new test777($this->faketest777Data($test777Fields));
    }

    /**
     * Get fake data of test777
     *
     * @param array $postFields
     * @return array
     */
    public function faketest777Data($test777Fields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'test' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $test777Fields);
    }
}
