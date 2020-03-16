<?php

use Faker\Factory as Faker;
use App\Models\test3;
use App\Repositories\test3Repository;

trait Maketest3Trait
{
    /**
     * Create fake instance of test3 and save it in database
     *
     * @param array $test3Fields
     * @return test3
     */
    public function maketest3($test3Fields = [])
    {
        /** @var test3Repository $test3Repo */
        $test3Repo = App::make(test3Repository::class);
        $theme = $this->faketest3Data($test3Fields);
        return $test3Repo->create($theme);
    }

    /**
     * Get fake instance of test3
     *
     * @param array $test3Fields
     * @return test3
     */
    public function faketest3($test3Fields = [])
    {
        return new test3($this->faketest3Data($test3Fields));
    }

    /**
     * Get fake data of test3
     *
     * @param array $postFields
     * @return array
     */
    public function faketest3Data($test3Fields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'test' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $test3Fields);
    }
}
