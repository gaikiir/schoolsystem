<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    // Define fillable fields for mass assignment
    protected $fillable = [
        'assignment_id',
        'question_text',
        'option_a',
        'option_b',
        'option_c',
        'correct_option',
        'marks',
    ];

    //for the question, get assignment for this question
    public function assignment(){
        return $this->belongsTo(Assignment::class);
    }


}
