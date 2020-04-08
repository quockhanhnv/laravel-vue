<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'id',
        'exam_id',
        'question_id',
        'answer_id',
        'user_id',
    ];
}
