@extends('layouts.app')

@section('content')
    <h1>Students Management</h1>

    <body>
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('students.index') }}" method="get" class="mt-3" id="filterForm">
                <div class="form-group">
                    <label for="filter_level">Filter by Level:</label><br>
                    <select  id="filter_level" name="filter_level" class="form-control" onchange="document.getElementById('filterForm').submit();">
                        <option value="all">All</option>
                        <option value="1">Level 1</option>
                        <option value="2">Level 2</option>
                        <option value="3">Level 3</option>
                        <option value="4">Level 4</option>
                    </select>
                </div>
            </form>
        </div>
        
        <div class="col-md-6">
            <label for="filter_level">Search for student:</label>
            <form action="{{ route('students.index') }}" method="get" class="mt-3">
                <div class="input-group">
                    <input type="text" id="search_query" name="search_query" class="form-control" value="{{ old('search_query') }}" placeholder="Search by Code, Name, or Email" onkeydown="if (event.keyCode === 13) this.form.submit();">
                </div>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Date of birth</th>
                <th>Email</th>
                <th>Level</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->code }}</td>
                    <td>{{ $student->full_name }}</td>
                    <td>{{ $student->date_of_birth}}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->level }}</td>
                    
                    <td>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
    <a href="{{ route('courses.index') }}" class="btn btn-primary">View Courses</a>
</body>
@endsection
