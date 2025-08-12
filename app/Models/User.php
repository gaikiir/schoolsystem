<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class User extends Authenticatable
{
 
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeRecent($query)
    {
        return $query->latest()->take(2);
    }

    /**
     * Get assignments assigned to this user.
     */
    public function assignments()
    {
        return $this->belongsToMany(Assignment::class, 'student_assignments', 'student_id', 'assignment_id');
    }

    public function courseApplications()
    {
        return $this->hasMany(CourseApplication::class, 'student_id');
    }


    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    public function isStudent(){
        return $this->role === 'student';
    }
}