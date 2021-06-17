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
        $this->users();
    }

    protected function users()
    {
        $user = new \App\Models\User();
        $user->name = 'Administator';
        $user->email = 'admin@example.com';
        $user->mobile = '081234567890';
        $user->password = app('hash')->make('123456');
        $user->save();

        \App\Models\User::factory()->count(10)->create();
    }
}
