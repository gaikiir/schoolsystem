<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'role',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
   

    public function scopeRecent($query)
    {
        return $query->latest()->take(2);
    }
}
