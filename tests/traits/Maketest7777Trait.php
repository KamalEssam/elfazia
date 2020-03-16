<?php

use Faker\Factory as Faker;
use App\Models\test7777;
use App\Repositories\test7777Repository;

trait Maketest7777Trait
{
    /**
     * Create fake instance of test7777 and save it in database
     *
     * @param array $test7777Fields
     * @return test7777
     */
    public function maketest7777($test7777Fields = [])
    {
        /** @var test7777Repository $test7777Repo */
        $test7777Repo = App::make(test7777Repository::class);
        $theme = $this->faketest7777Data($test7777Fields);
        return $test7777Repo->create($theme);
    }

    /**
     * Get fake instance of test7777
     *
     * @param array $test7777Fields
     * @return test7777
     */
    public function faketest7777($test7777Fields = [])
    {
        return new test7777($this->faketest7777Data($test7777Fields));
    }

    /**
     * Get fake data of test7777
     *
     * @param array $postFields
     * @return array
     */
    public function faketest7777Data($test7777Fields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'test' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $test7777Fields);
    }
}
