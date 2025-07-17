<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $fillable =[
            'title',
            'description',
            'create_by'
    ];
    //defined relationship between the tables 

    //for the question: get question for this assignment
    public function questions(){
        return $this->hasMany(Question::class);
    }

    //for the students: get this question for the student
    public function students(){
        return $this->belongsToMany(User::class, 'assignment_student', 'assignment_id', 'user_id');

    }
    //for the student submission, get for the submission for assignment from the studetns
    public function submissions(){
        return $this->hasMany(Submission::class);
    }
}
