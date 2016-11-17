<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Sistema\Client::truncate();
        factory(\Sistema\Client::class, 10)->create();
    }
}
