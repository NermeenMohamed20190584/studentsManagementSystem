<template>
  <div>
    <h1>Students' Grades for Course: {{ courseName }}</h1>

    <table>
      <thead>
        <tr>
          <th>Student Name</th>
          <th>Student Code</th>
          <th v-for="gradeItem in gradeItems" :key="gradeItem.id">
            {{ gradeItem.name }} <br>
            (Max: {{ gradeItem.max_degree }})
          </th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="studentGrades in studentsGrades" :key="studentGrades.student.id">
          <td>{{ studentGrades.student.full_name }}</td>
          <td>{{ studentGrades.student.code }}</td>
          <td v-for="(grade, index) in studentGrades.grades" :key="index">{{ grade }}</td>
          <td>{{ computeTotal(studentGrades.grades) }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    courseName: String,
    gradeItems: Array,
    studentsGrades: Array,
  },
  methods: {
    computeTotal(grades) {
      return grades.reduce((total, grade) => total + parseFloat(grade), 0).toFixed(2);
    },
  },
};
</script>
