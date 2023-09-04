@extends('layouts.app')

@section('content')
    <h1>Courses Management</h1>
    <body>
        
  
    <div >
        <label >Search for course:</label>
        <form action="{{ route('courses.index') }}" method="POST" class="mt-3">
            <div class="input-group">
                <input type="text" id="search_query" name="search_query" class="form-control" value="{{ old('search_query') }}" placeholder="Search by Course Code or Name" onkeydown="if (event.keyCode === 13) this.form.submit();">
            </div>
        </form>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Description</th>
               
                
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->code }}</td>
                    <td>{{ $course->description}}</td>
                    <td>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-info">Course Details</a>
                    </td>
                    
                   
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('students.index') }}" class="btn btn-primary">Back to Students List</a>
</body>
@endsection
