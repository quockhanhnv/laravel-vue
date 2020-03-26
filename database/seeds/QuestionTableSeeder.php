<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Question;
use App\Models\Answer;
class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        factory(Question::class, 1000)->create()->each(function($question) use ($faker) {
            $answers  = [];
            $corrects = [1,2,3,4];

            for ($i = 1; $i <= 4; $i++) {
                $answers[] = [
                    'question_id' => $question->id,
                    'content'     => $faker->text(50),
                    'correct'     => $i === array_rand($corrects),
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }

        	$question->answers()->insert($answers);
        });
    }
}
