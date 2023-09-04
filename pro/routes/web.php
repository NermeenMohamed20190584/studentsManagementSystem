<?php

use App\Http\Controllers\courseController;
use App\Http\Controllers\studentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Redirect::route('students.index');
});

Route::resource('students', studentController::class);

Route::resource('courses',courseController::class);



Route::post('/courses/{courseId}/students/{studentId}/remove', [courseController::class, 'removeStudentFromCourse'])
    ->name('courses.removeStudent')
    ->where(['courseId' => '[0-9]+', 'studentId' => '[0-9]+']);

Route::post('/courses/{courseId}/students/add', [CourseController::class, 'addStudentToCourse'])
    ->name('courses.addStudent')
    ->where('courseId', '[0-9]+');


Route::get('/courses/{courseId}/students/enroll', [CourseController::class, 'enrollStudent'])
    ->name('students.enroll')
    ->where('courseId', '[0-9]+');
  


Route::get('/courses/{courseId}/students/{studentId}/grades', [courseController::class,'getStudentsGrades'])
    ->name('studentsGrades');

    