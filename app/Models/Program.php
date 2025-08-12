<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'duration',
        'mode',
        'level',
    ];

    public function applications()
    {
        return $this->hasMany(CourseApplication::class);
    }

    
    
    public function scopeRecent($query)
    {
        return $query->latest()->take(2);
    }
}
