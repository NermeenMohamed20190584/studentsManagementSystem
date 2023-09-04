@extends('layouts.app')

@section('content')
    <h1>Add Student</h1>

    <form action="{{ route('students.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" id="code" name="code" class="form-control">
        </div>
        <div class="form-group">
            <label for="full_name">Name</label>
            <input type="text" id="full_name" name="full_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" id="date_of_birth" name="date_of_birth" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="level">Level</label>
            <select id="level" name="level" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
