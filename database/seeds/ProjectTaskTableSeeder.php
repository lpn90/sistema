<?php

use Illuminate\Database\Seeder;
use Sistema\Entities\ProjectTask;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Project::truncate();*/
        factory(ProjectTask::class, 50)->create();
    }
}
