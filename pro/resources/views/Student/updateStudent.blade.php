@extends('layouts.app')

@section('content')
    <h1>Edit Student</h1>

    <form action="{{ route('students.update', $student->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" id="code" name="code" class="form-control" value="{{ $student->code }}">
        </div>
        <div class="form-group">
            <label for="full_name">Name</label>
            <input type="text" id="full_name" name="full_name" class="form-control" value="{{ $student->full_name }}">
        </div>
        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ $student->date_of_birth }}">
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $student->email }}">
        </div>
        <div class="form-group">
            <label for="level">Level</label>
            <select id="level" name="level" class="form-control">
                <option value="1" {{ $student->level == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $student->level == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ $student->level == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ $student->level == 4 ? 'selected' : '' }}>4</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
