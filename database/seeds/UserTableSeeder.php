<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Usuario Normal',
            'email' => 'usuario@usuario.com',
            'password' => bcrypt('usuario'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'Usuario Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role_id' => 2,
        ]);
    }
}
