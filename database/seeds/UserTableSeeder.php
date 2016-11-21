<?php

use Illuminate\Database\Seeder;
use \Sistema\Entities\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*User::truncate();*/
        factory(User::class)->create([
            'name' => 'Leonardo Pinheiro',
            'email' => 'leonardo.pinheiro@pintech.com.br',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);

        factory(User::class, 10)->create();
    }
}
