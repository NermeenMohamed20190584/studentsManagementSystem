<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    use HasFactory;

    protected $table = 'student_grade'; 

    protected $fillable = ['student_id', 'grade_item_id', 'course_id', 'grade'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function gradeItem()
    {
        return $this->belongsTo(Grade_item::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

