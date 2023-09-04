<template>
    <div>
      <h1>Edit Student</h1>
  
      <form @submit.prevent="updateStudent">
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
        <button type="submit" class="btn btn-primary">Update</button>
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
    mounted() {
      this.fetchStudentData();
      const studentId = this.$route.params.id;
      
    },
    methods: {
    
    async fetchStudentData(studentId) {
      try {
        const response = await axios.get(`/students/${studentId}`);

        
        this.student = response.data;
      } catch (error) {
        console.error('Failed to fetch student data', error);
      }
    },
    async updateStudent() {
      try {
        const studentId = this.$route.params.id;
        const response = await axios.post(`/students/${studentId}`, this.student);

        
        console.log('Student updated successfully', response.data);
      } catch (error) {
        
        console.error('Student update failed', error);
      }
    },
  },
  
};
  </script>
  