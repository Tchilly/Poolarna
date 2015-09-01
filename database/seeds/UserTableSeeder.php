<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Poolarna\User::class, 10)->create();

        DB::table('users')->insert([
            'name' => 'Maria',
            'email' => 'maria_kemvall@hotmail.com',
            'password' => Hash::make('secret'),
        ]);
    }
}
