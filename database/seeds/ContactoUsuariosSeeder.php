<?php

use Illuminate\Database\Seeder;
use App\Models\ContactoUsuario;

class ContactoUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(ContactoUsuario::class, 5)->create();
    }
}
