<?php

use Illuminate\Database\Seeder;

class OAuthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            [
                'id' => 'appid1',
                'secret' => 'secret',
                'name' => 'Sistema',
                'created_at' =>  '01/12/2016',
                'updated_at' =>  '01/12/2016',
            ]
        ]);
    }
}
