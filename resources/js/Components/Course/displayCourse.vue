<template>
    <div>
      <h1>Courses Management</h1>
  
      <div>
        <label>Search for course:</label>
        <form @submit.prevent="searchCourses" class="mt-3">
          <div class="input-group">
            <input v-model="searchQuery" type="text" class="form-control" placeholder="Search by Course Code or Name" @keydown.enter="searchCourses">
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
          <tr v-for="course in courses" :key="course.id">
            <td>{{ course.name }}</td>
            <td>{{ course.code }}</td>
            <td>{{ course.description }}</td>
            <td>
              <router-link :to="`/courses/${course.id}`" class="btn btn-info">Course Details</router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        searchQuery: '',
        courses: [], 
      };
    },
    methods: {
  searchCourses() {
 
    axios.get(`/courses?search_query=${this.searchQuery}`)
      .then(response => {

        this.courses = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  },
},
  };
  </script>
  