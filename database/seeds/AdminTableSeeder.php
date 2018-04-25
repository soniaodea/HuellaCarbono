<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = new Admin();
        $admin->name = 'admin';
        $admin->code = '1234567890';
        $admin->password = bcrypt('password');
        $admin->save();
    }
}
