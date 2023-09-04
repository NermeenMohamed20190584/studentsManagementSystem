@extends('layouts.app')

@section('content')
    <h1>Enroll Student in {{ $course->name }}</h1>

    <form method="POST" action="{{ route('courses.addStudent', ['courseId' => $course->id]) }}">
        @csrf

        <label for="student_id">Select Student:</label>
        <select name="student_id" id="student_id" required>
            @foreach ($students as $student)
                <option value="{{ $student->id }}">{{ $student->full_name }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-success">Enroll Student</button>
    </form>

    <a href="{{ route('courses.show', ['course' => $course->id]) }}" class="btn btn-primary">Back to Course Details</a>
@endsection
