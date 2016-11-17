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
        \Sistema\Entities\Client::truncate();
        factory(\Sistema\Entities\Client::class, 10)->create();
    }
}
