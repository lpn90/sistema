<?php

use Illuminate\Database\Seeder;
use \Sistema\Entities\ProjectNote;

class ProjectNoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Project::truncate();*/
        factory(ProjectNote::class, 50)->create();
    }
}
