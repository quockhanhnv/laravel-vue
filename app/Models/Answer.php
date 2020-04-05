<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	protected $fillable = [
		'id',
		'question_id',
		'content',
		'correct',
	];

    public function question()
    {
    	return $this->belongsTo(Question::class);
    }
}
