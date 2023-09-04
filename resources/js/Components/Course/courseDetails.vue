<template>
  <div>
    <h1>Course Details</h1>

    <h2>{{ course.name }} Information</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Code</th>
          <th>Description</th>
          <th>Enrolled Students</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ course.name }}</td>
          <td>{{ course.code }}</td>
          <td>{{ course.description }}</td>
          <td class="enrolled-students">
            <ul class="no-bullets" v-if="enrolledStudents.length > 0">
              <li v-for="student in enrolledStudents" :key="student.id">
                <div>
                  {{ student.full_name }}
                  <button @click="removeStudent(student)">Remove</button>
                </div>
              </li>
            </ul>
            <p v-else>No enrolled students available.</p>
          </td>
        </tr>
      </tbody>
    </table>
    <button @click="addStudent" class="btn btn-success">Add Student</button>
    <a href="/courses" class="btn btn-primary">Back to Course List</a>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  props: {
    course: Object,
    enrolledStudents: Array,
  },
  methods: {
    removeStudent(student) {
      const courseId = this.course.id;
      const studentId = student.id;

      axios.post(`/courses/${courseId}/students/${studentId}/remove`)
        .then(response => {
     
          console.log(response.data); 
        })
        .catch(error => {

          console.error(error);
        });
    },

    addStudent() {
      const courseId = this.course.id;
      
      const studentData = {
        code:'',
        name: '',
        Date_Of_Birth:'',
        Email:'',
        Level:'',
        

      };

      axios.post(`/courses/${courseId}/students/add`, studentData)
        .then(response => {

          console.log(response.data); 
        })
        .catch(error => {

          console.error(error);
        });
    },
  },
};

</script>

<style>
  .no-bullets {
    list-style-type: none; 
  }
</style>
