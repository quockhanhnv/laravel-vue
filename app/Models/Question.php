<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function answers()
    {
    	return $this->hasMany(Answer::class);
    }

    public function exams()
    {
    	return $this->belongsToMany(Exam::class);
    }
}
