<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        //Crear roles
        DB::table('roles')->insert([
            'name' => 'The fu**ing god!',
            'slug' => 'god'
        ]);
        DB::table('roles')->insert([
            'name' => 'Developer',
            'slug' => 'developer'
        ]);
        DB::table('roles')->insert([
            'name' => 'Admin',
            'slug' => 'admin'
        ]);
        DB::table('roles')->insert([
            'name' => 'Enterprise',
            'slug' => 'enterprise'
        ]);
        DB::table('roles')->insert([
            'name' => 'Usuario básico',
            'slug' => 'basic'
        ]);
    }
}
