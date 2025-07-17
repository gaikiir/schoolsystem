<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $guarded = [
        'student_id',
        'assignment_id',
        'question_id',
        'selected_answers',
        'score'
    ];

    //get this assignment belong to 
    public function assignment(){
        return $this ->belongsTo(Assignment::class);
    }

    //get this submission belong to
    public function student(){
        return $this ->belongsTo(User::class,'student_id');
    }

    //get this question submission answer belong to 
    public function question(){
        return $this ->belongsTo(Question::class);
    }

}
