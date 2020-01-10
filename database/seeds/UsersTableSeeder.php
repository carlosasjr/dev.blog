<?php

use App\User;
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
        User::create([
            'name'          => 'Anonymo',
            'email'         => 'anonymo@email.com',
            'password'      =>  bcrypt('pl4c32k@'),
            'bibliograply'  => 'Usuário Anonymous'
        ]);

    }
}
