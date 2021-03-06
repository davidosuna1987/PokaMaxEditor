<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create addresses
        DB::table('addresses')->insert([
            'company' => 'Supermundano',
            'title' => 'Mr',
            'name' => 'David',
            'surnames' => 'Osuna Mondaca',
            'address_line_1' => 'C/ Bélgica 14, puerta 5',
            'address_line_2' => null,
            'city' => 'Valencia',
            'country' => 'España',
            'zip_code' => '46021',
            'birthday' => null,
        ]);

        DB::table('addresses')->insert([
            'company' => 'EmartiDent',
            'title' => 'Ms',
            'name' => 'Esther',
            'surnames' => 'Martínez Martínez',
            'address_line_1' => 'C/ Alcalá 5',
            'address_line_2' => null,
            'city' => 'Madrid',
            'country' => 'España',
            'zip_code' => '08080',
            'birthday' => null,
        ]);

        DB::table('addresses')->insert([
            'company' => 'PokaMax',
            'title' => 'Mr',
            'name' => 'Manuel',
            'surnames' => 'Schmid',
            'address_line_1' => 'C/ Alameda',
            'address_line_2' => null,
            'city' => 'Valencia',
            'country' => 'España',
            'zip_code' => '08080',
            'birthday' => null,
        ]);

        // Create users
        factory(App\User::class)->create([
            'email' => 'davidosuna1987@gmail.com',
            'username' => 'davidosuna1987',
            'password' => bcrypt('secret'),
            'api_token' => bcrypt('davidosuna1987@gmail.com'),
            'role_id' => 1,
            'address_id' => 1,
            'active' => true,
        ]);

        factory(App\User::class)->create([
            'email' => 'esthermaruiz@gmail.com',
            'username' => 'esthermaruiz',
            'password' => bcrypt('secret'),
            'api_token' => bcrypt('esthermaruiz@gmail.com'),
            'role_id' => 4,
            'address_id' => 2,
            'active' => true,
        ]);

        factory(App\User::class)->create([
            'email' => 'manuel@pokamax.com',
            'username' => 'manuelschmid',
            'password' => bcrypt('secret'),
            'api_token' => bcrypt('manuel@pokamax.com'),
            'role_id' => 2,
            'address_id' => 3,
            'active' => true,
        ]);

        // DB::table('address_lists')->insert([
        //     'company_id' => 1,
        //     'name' => 'Uncategorized'
        // ]);

        // DB::table('address_lists')->insert([
        //     'company_id' => 2,
        //     'name' => 'Uncategorized'
        // ]);

        // DB::table('address_lists')->insert([
        //     'company_id' => 3,
        //     'name' => 'Uncategorized'
        // ]);

        // //Create testing postcard
        // DB::table('postcards')->insert([
        //     'company_id' => 1,
        //     'status' => 'DRAFT',
        //     'product_name' => 'standard',
        //     'front_cropped_file_path' => 'http://pokasetbulma.test/images/postcards/1/postcard-front-cropped.jpg',
        //     'front_original_file_path' => 'http://pokasetbulma.test/images/postcards/1/postcard-front-original.jpg',
        //     'back_text' => 'Custom back text for testing lorem ipsum dolor sit amet...',
        //     'font_family' => 3,
        //     'font_size' => 24
        //     // 'sender_address_id' => 1,
        //     // 'reciever_address_id' => 2
        // ]);

        // //Create testing postcard addresses
        // DB::table('postcard_addresses')->insert([
        //     'postcard_id' => 1,
        //     'address_id' => 1,
        //     'type' => 'sender'
        // ]);

        // DB::table('postcard_addresses')->insert([
        //     'postcard_id' => 1,
        //     'address_id' => 2,
        //     'type' => 'reciever'
        // ]);
    }
}
