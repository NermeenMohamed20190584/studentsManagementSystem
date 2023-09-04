<template>
    <div>
      <h1>Enroll Student in {{ courseName }}</h1>
  
      <form @submit.prevent="enrollStudent">
        <label for="student_id">Select Student:</label>
        <select v-model="selectedStudent" id="student_id" required>
          <option v-for="student in students" :key="student.id" :value="student.id">{{ student.full_name }}</option>
        </select>
  
        <button type="submit" class="btn btn-success">Enroll Student</button>
      </form>
  
      <router-link :to="`/courses/${courseId}`" class="btn btn-primary">Back to Course Details</router-link>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      courseName: String,
      courseId: Number,
      students: Array,
    },
    data() {
      return {
        selectedStudent: '',
      };
    },
    methods: {
    async enrollStudent() {
      try {
        const response = await axios.post(`/courses/${this.courseId}/students/enroll`, {
          student_id: this.selectedStudent,
        });

        
        console.log('Enrollment successful', response.data);
      } catch (error) {
        
        console.error('Enrollment failed', error);
      }
    },
  },
  };
  </script>
  