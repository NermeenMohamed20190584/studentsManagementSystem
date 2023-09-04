<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\StudentGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class courseController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search_query');

        $coursesQuery = Course::query();

        if ($searchQuery) {
            $coursesQuery->where(function ($innerQuery) use ($searchQuery) {
                $innerQuery->where('name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('code', 'like', '%' . $searchQuery . '%');
            });
        }

        $courses = $coursesQuery->get();
        
        return view('Courses.displayCourse', compact('courses'));
        return response()->json($courses);
    }


    public function show($id)
    {
        $course = Course::findOrFail($id);
        $enrolledStudents = $course->students;
        $gradeItems = $course->grade_items;
   
        return view('Courses.courseDetails', compact('course', 'enrolledStudents','gradeItems'));
    }

 

    public function removeStudentFromCourse($courseId, $studentId)
{
    $course = Course::findOrFail($courseId);
    $course->students()->detach($studentId);

    return Redirect::route('courses.show', ['course' => $courseId])
    ->with('success', 'Student removed from course.');

}

public function addStudentToCourse(Request $request, $courseId)
{
    $studentId = $request->input('student_id');

    $course = Course::findOrFail($courseId);
    $student = Student::findOrFail($studentId);

    
    if($student){
        return 'student already exist';
    }
    else{
        $course->students()->attach($studentId);
    }

    return redirect()->route('courses.show', ['course' => $courseId]);
}
public function enrollStudent(Request $request,$courseId)
{
    $course = Course::findOrFail($courseId);
    $studentId = $request->input('student_id');
    $students = Student::all(); 

    return view('courses.enrollStudent', compact('course', 'students'));
    return response()->json(['message' => 'Enrollment successful']);
}




public function getStudentsGrades($courseId)
{
    $course = Course::findOrFail($courseId);
    $enrolledStudents = $course->students;
    $gradeItems = $course->gradeItems;
 
    $studentsGrades = [];
    
    foreach ($enrolledStudents as $student) {
        
        $studentGrades = [];
        foreach ($gradeItems as $gradeItem) {
            $grade = StudentGrade::where([
                'student_id' => $student->id,
                'grade_item_id' => $gradeItem->id,
                'course_id' => $course->id,
            ])->first();
            $score = $grade ? $grade->grade : 'no grade';
            $studentGrades[$gradeItem->id] = $score;
        }
        
    
        $studentsGrades[] = [
            'student' => $student,
            'grades' => $studentGrades,
        ];
    }

    return view('courses.studentCourseGrades', compact('course', 'studentsGrades', 'gradeItems'));
}

}