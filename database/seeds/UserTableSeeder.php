<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	Exam::insert([
    		['name' => 'Test one'],
    		['name' => 'Test two'],
    		['name' => 'Test three'],
    	]);

    	Question::insert([
    		['content' => 'Question 1'],
    		['content' => 'Question 2'],
    		['content' => 'Question 3'],
    		['content' => 'Question 4'],
    	]);

    	// $question = Question::all();

    	// $exam = Exam::all();

    	Answer::insert([
    		['question_id' => 1, 'content' => 'Answer 1', 'correct' => false],
    		['question_id' => 1, 'content' => 'Answer 2', 'correct' => false],
    		['question_id' => 1, 'content' => 'Answer 3', 'correct' => true],
    		['question_id' => 1, 'content' => 'Answer 4', 'correct' => false],

    		['question_id' => 2, 'content' => 'Answer 2.1', 'correct' => false],
    		['question_id' => 2, 'content' => 'Answer 2.2', 'correct' => false],
    		['question_id' => 2, 'content' => 'Answer 2.3', 'correct' => true],
    		['question_id' => 2, 'content' => 'Answer 2.4', 'correct' => false],

    		['question_id' => 3, 'content' => 'Answer 3.1', 'correct' => false],
    		['question_id' => 3, 'content' => 'Answer 3.2', 'correct' => false],
    		['question_id' => 3, 'content' => 'Answer 3.3', 'correct' => true],
    		['question_id' => 3, 'content' => 'Answer 3.4', 'correct' => false],

    		['question_id' => 4, 'content' => 'Answer 4.1', 'correct' => false],
    		['question_id' => 4, 'content' => 'Answer 4.2', 'correct' => false],
    		['question_id' => 4, 'content' => 'Answer 4.3', 'correct' => true],
    		['question_id' => 4, 'content' => 'Answer 4.4', 'correct' => false],
    	]);


    	// $users = DB::table('users')->first();

    	// $users = User::first();

    	// Model
    	// select, join, where, group, delete, update
    	// sub query

    }
}
