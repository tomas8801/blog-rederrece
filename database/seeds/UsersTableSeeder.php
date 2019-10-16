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
        //ejecutamos el factory
        factory(App\User::class, 29)->create();

        App\User::create([
            'name' => 'Tomas Marsili',
            'email' => 'tomasmarsili.contacto@gmail.com',
            'password' => bcrypt('123')
        ]);
    }
}
