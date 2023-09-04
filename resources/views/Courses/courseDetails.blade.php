@extends('layouts.app')

@section('content')
    <h1>Course Details</h1>

    <h2>{{$course->name}} Information</h2>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Code</th>
            <th>Description</th>
            <th>Enrolled Students</th>
        </tr>
        <tr>
            <td>{{ $course->name }}</td>
            <td>{{ $course->code }}</td>
            <td>{{ $course->description }}</td>
            <td class="enrolled-students">
                @if ($enrolledStudents->count() > 0)
                    <ul class="no-bullets">
                        @foreach($enrolledStudents as $student)
                            <div>
                                
                                {{ $student->full_name }}
                                
                                 <form method="POST" action="{{ route('courses.removeStudent', ['courseId' => $course->id, 'studentId' => $student->id]) }}">
                                 @csrf
                                 @method('POST')
                                    <button type="submit">Remove</button>
                                 </form>
                            </div>
                        @endforeach
                    </ul>
                @else
                    No enrolled students available.
                @endif
            </td>
        </tr>
    </table>
    <a href="{{ route('students.enroll', ['courseId' => $course->id]) }}" class="btn btn-success">Add Student</a>

    <a href="{{ route('courses.index') }}" class="btn btn-primary">Back to Course List</a>
    <a href="{{ route('studentsGrades', ['courseId' => $course->id, 'studentId' => $student->id]) }}" class="btn btn-primary">
    show students grades in this course</a>
@endsection

<style>
    .no-bullets {
        list-style-type: none; /* Remove bullets from the list */
    }
</style>
