<template>
    <div>
      <h1>Add Student</h1>
  
      <form @submit.prevent="addStudent">
        <div class="form-group">
          <label for="code">Code</label>
          <input v-model="student.code" type="text" id="code" name="code" class="form-control">
        </div>
        <div class="form-group">
          <label for="full_name">Name</label>
          <input v-model="student.full_name" type="text" id="full_name" name="full_name" class="form-control">
        </div>
        <div class="form-group">
          <label for="date_of_birth">Date of Birth</label>
          <input v-model="student.date_of_birth" type="date" id="date_of_birth" name="date_of_birth" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input v-model="student.email" type="email" id="email" name="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="level">Level</label>
          <select v-model="student.level" id="level" name="level" class="form-control">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        student: {
          code: '',
          full_name: '',
          date_of_birth: '',
          email: '',
          level: '',
        },
      };
    },
    methods: {
      addStudent() {
        // Send the student data to your backend for saving using an API call
        // For example:
        // this.saveStudentData();
        
      },
    },
  };
  </script>
  