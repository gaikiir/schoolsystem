<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
            'assignment_id',
            'question_text',
            'correct_answer',
            'marks'
    ];
    //for the question, get assignment for this question
    public function assignment(){
        return $this->belongsTo(Assignment::class);
    }

    //for the choices: get  choice for question

    public function choices(){
        return $this->hasMany(Choice::class);
    }

    //for submission 
    public function submissions(){
        return $this->hasMany(Submission::class);
    }
}
