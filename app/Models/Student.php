<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    use HasFactory;
    protected $fillable=['code','full_name','date_of_birth','email','level'];
    public $timestamps = false;

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_courses', 'student_id', 'course_id')
            ->withPivot('id', 'grade_item_id', 'grade');
    }

    
}
