<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    use HasFactory;
    protected $fillable=["name","code","description"];
    public $timestamps = false;

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_courses', 'course_id', 'student_id');
           
    }

    public function gradeItems()
    {
        return $this->hasMany(Grade_item::class,'course_id');
            
    }

   
}
