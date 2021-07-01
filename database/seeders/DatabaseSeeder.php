<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->user();
        $this->factories();
    }

    protected function user()
    {
        $user = new \App\Models\User();
        $user->email = 'admin@example.com';
        $user->mobile = '081234567890';
        $user->password = app('hash')->make('123456');
        $user->ability = ['*'];
        $user->save();
    }

    public function factories()
    {
        \App\Models\User::factory()->count(10)->create()->each(function ($user) {
            $user->profile()->save(\App\Models\Profile::factory()->make());
        });

        \App\Models\Post::factory()->count(500)->create();
    }
}
