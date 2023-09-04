<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $studentsQuery = Student::query();
        $students = [];
    

        if ($request->has('filter_level') && in_array($request->filter_level, ['1', '2', '3', '4'])) {
            $studentsQuery->where('level', $request->filter_level);
        }
       
        
        $students = $studentsQuery->get();
    
      
        $searchQuery = $request->input('search_query');
        if ($searchQuery) {
            $students = Student::where(function ($query) use ($searchQuery) {
                $query->where('code', 'like', '%' . $searchQuery . '%')
                      ->orWhere('full_name', 'like', '%' . $searchQuery . '%')
                      ->orWhere('email', 'like', '%' . $searchQuery . '%');
            })->whereIn('id', $students->pluck('id'))->get();
        }
    
        return view('Student.displayStudent', compact('students'));
    }
    
    public function create()
    {
        return view('Student.createStudent');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'code' => 'required|unique:students',
            'full_name' => 'required',
            'date_of_birth'=>'required',
            'email' => 'required|email|unique:students',
            'level'=>'required'
        ]);

        $validatedData['date_of_birth'] = Carbon::createFromFormat('Y-m-d', $validatedData['date_of_birth'])->format('Y-m-d');

        Student::create($validatedData);
    

        return redirect()->route('students.index')->with('success', 'Student created successfully');
        return response()->json(['message' => 'Student created successfully']);
    }

    
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('Student.updateStudent', compact('student'));
    }

   
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
    
        $validatedData = [];
    
        if ($request->has('code')) {
            $validatedData['code'] = $request->input('code');
        }
    
        if ($request->has('full_name')) {
            $validatedData['full_name'] = $request->input('full_name');
        }
    
        if ($request->has('date_of_birth')) {
            $validatedData['date_of_birth'] = Carbon::createFromFormat('Y-m-d', $request->input('date_of_birth'))->format('Y-m-d');
        }
    
        if ($request->has('email')) {
            $validatedData['email'] = $request->input('email');
        }
    
        if ($request->has('level')) {
            $validatedData['level'] = $request->input('level');
        }
    
        $student->update($validatedData);
    
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
        return response()->json(['message' => 'Student updated successfully']);
    }
    


    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
        
    }
}
