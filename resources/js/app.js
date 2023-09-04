import Vue from 'vue';
import courseDetails from '/resources/js/Components/Course/courseDetails.vue'
import displayCourse from '/resources/js/Components/Course/displayCourse.vue'
import enrollStudent from '/resources/js/Components/Course/enrollStudent.vue'
import studentCourseGrades from '/resources/js/Components/Course/studentCourseGrades.vue'
import createStudent from '/resources/js/Components/Student/createStudent.vue'
import editStudent from '/resources/js/Components/Student/editStudent.vue'
import showStudent from '/resources/js/Components/Student/showStudent.vue'
const cors=require('cors');
app.use(cors({
    origin:'*',
    methods:['GET','POST','PUT','DELETE']
}))


const app = new Vue({
    el: '#app',
    
    components: {
        courseDetails ,
        displayCourse ,
        enrollStudent,
        studentCourseGrades, 
        createStudent ,
        editStudent ,
        showStudent
    }
});
