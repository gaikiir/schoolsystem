<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    // Define fillable fields for mass assignment
    protected $fillable = [
        'title',
        'description',
        'total_marks',
        'deduction_per_wrong_answer',
    ];
    //defined relationship between the tables 

    //for the question: get question for this assignment
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    //for the student submission, get for the submission for assignment from the studetns
    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}
