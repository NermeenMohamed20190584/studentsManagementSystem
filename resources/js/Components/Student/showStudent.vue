<template>
    <div>
      <h1>Students Management</h1>
      <a @click="showAddStudentModal" class="btn btn-primary">Add Student</a>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="filter_level">Filter by Level:</label>
            <select v-model="filterLevel" id="filter_level" class="form-control" @change="applyFilter">
              <option value="">All</option>
              <option value="1">Level 1</option>
              <option value="2">Level 2</option>
              <option value="3">Level 3</option>
              <option value="4">Level 4</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-group">
            <input type="text" v-model="searchQuery" class="form-control" placeholder="Search by Code, Name, or Email" @keydown.enter="searchStudents">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button" @click="searchStudents">Search</button>
            </div>
          </div>
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
          <tr v-for="student in filteredStudents" :key="student.id">
            <td>{{ student.code }}</td>
            <td>{{ student.full_name }}</td>
            <td>{{ student.date_of_birth }}</td>
            <td>{{ student.email }}</td>
            <td>{{ student.level }}</td>
            <td>
              <button @click="editStudent(student)" class="btn btn-primary">Edit</button>
              <button @click="deleteStudent(student)" class="btn btn-danger">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- Add Student Modal -->
      <div v-if="showAddStudent" class="modal fade show" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Student</h5>
              <button type="button" class="close" @click="closeAddStudentModal">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
         
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        students: [], // Replace with your data
        filterLevel: '',
        searchQuery: '',
        showAddStudent: false,

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
    computed: {
      filteredStudents() {
        let filtered = this.students;
        if (this.filterLevel) {
          filtered = filtered.filter(student => student.level === this.filterLevel);
        }
        if (this.searchQuery) {
          const query = this.searchQuery.toLowerCase();
          filtered = filtered.filter(student =>
            student.code.toLowerCase().includes(query) ||
            student.full_name.toLowerCase().includes(query) ||
            student.email.toLowerCase().includes(query)
          );
        }
        return filtered;
      },
    },
    methods: {
      applyFilter() {
    
    const params = {
      filter_level: this.filterLevel, 
    };

    
    axios.get('/students', { params })
      .then(response => {
        
        this.students = response.data;
      })
      .catch(error => {
        console.error('Failed to filter students', error);
      });
  },
  searchStudents() {
    
    const params = {
      search_query: this.searchQuery, 
    };

    
    axios.get('/students', { params })
      .then(response => {
        
        this.students = response.data;
      })
      .catch(error => {
        console.error('Failed to search students', error);
      });
  },
      showAddStudentModal() {
        this.showAddStudent = true;
      },
      closeAddStudentModal() {
        this.showAddStudent = false;
      },
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
        const response = await axios.put(`/students/${studentId}`, this.student);

        
        console.log('Student updated successfully', response.data);
      } catch (error) {
        
        console.error('Student update failed', error);
      }
    },
  
    deleteStudent(student) {
    // Make an API request to delete the student by ID
    const studentId = student.id; 

    
    axios.delete(`/students/${studentId}`)
      .then(response => {
        
        console.log('Student deleted successfully', response.data);
      })
      .catch(error => {
  
        console.error('Failed to delete student', error);
      });
  },
    },
  };
  </script>
  