<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(User::class, 10)->create();

        App\Models\User::create([
            'name' => 'enaut',
            'email' =>'enaut.irakasle@gmail.com',
            'password' => bcrypt('zubiri')
        ]);

        App\Models\User::create([
            'name' => 'sonia',
            'email' =>'sortizdearri@zubirimanteo.com',
            'password' => bcrypt('sortizdearri')
        ]);
    }
}
