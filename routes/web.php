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

Route::post('/students', [StudentController::class, 'store'])
    ->name('students.store');

Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show'); 
Route::post('/students/{id}', [StudentController::class, 'update'])->name('students.update'); 

Route::delete('/students/{id}', [StudentController::class, 'destroy'])
    ->name('students.destroy');
    
Route::resource('courses',courseController::class);

Route::get('/courses', [courseController::class, 'index'])->name('courses.index');


Route::post('/courses/{courseId}/students/{studentId}/remove', [courseController::class, 'removeStudentFromCourse'])
    ->name('courses.removeStudent');
    

Route::post('/courses/{courseId}/students/add', [CourseController::class, 'addStudentToCourse'])
    ->name('courses.addStudent');
  


Route::get('/courses/{courseId}/students/enroll', [CourseController::class, 'enrollStudent'])
    ->name('students.enroll');

  

Route::get('/courses/{courseId}/students/{studentId}/grades', [courseController::class,'getStudentsGrades'])
    ->name('studentsGrades');

    