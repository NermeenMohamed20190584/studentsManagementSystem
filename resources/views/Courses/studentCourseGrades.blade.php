@extends('layouts.app')

@section('content')
    <h1>Students' Grades for Course: {{ $course->name }}</h1>
    
    <table>
        <thead>
            <tr>
                <th> Student Name <br></th>
                <th> Student Code <br></th>
                @foreach ($gradeItems as $gradeItem)
                    <th>{{ $gradeItem->name }}
                        <br>(Max: {{ $gradeItem->max_degree }})
                    </th>
                @endforeach
                <th>Total</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($studentsGrades as $studentGrades)
                <tr>
                    <td>{{ $studentGrades['student']->full_name }}</td>
                    <td>{{ $studentGrades['student']->code }}</td>
                    @foreach ($studentGrades['grades'] as $grade)
                        <td>{{ $grade }}</td>
                    @endforeach
                    <td>{{ array_sum($studentGrades['grades']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
