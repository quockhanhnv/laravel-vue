<?php

use Illuminate\Database\Seeder;
use App\Models\Exam;

class ExamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Exam::class, 30)->create();
    }
}
