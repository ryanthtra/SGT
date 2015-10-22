/**
 * Define all global variables here
 */
/**
 * student_array - global array to hold student objects
 * @type {Array}
 */
var student_array = [];
/**
 * inputIds - id's of the elements that are used to add students
 * @type {string[]}
 */
var inputIds = ["studentName", "course", "studentGrade"];
/**
 * addClicked - Event Handler when user clicks the add button
 */
function addClicked()
{
    // Add values inside the form into an object and store that object in the student_array global variable
    addStudent();
    clearAddStudentForm();
}
/**
 * cancelClicked - Event Handler when user clicks the cancel button, should clear out student form
 */
function cancelClicked()
{
    clearAddStudentForm();
}
/**
 * addStudent - creates a student objects based on input fields in the form and adds the object to global student array
 *
 * @return undefined
 */
function addStudent()
{
    var newStudent =
    {
        name: '',
        course: '',
        grade: ''
    };

    var temp_selector = null;
    for (var i = 0; i < inputIds.length; i++)
    {
        temp_selector = $('#' + inputIds[i]);
        console.log(temp_selector);
        switch (i)
        {
            case 0:
                newStudent.name = temp_selector.val();
                break;
            case 1:
                newStudent.course = temp_selector.val();
                break;
            case 2:
                newStudent.grade = temp_selector.val();
                break;
        }
    }
    student_array.push(newStudent);
    return undefined;
}
/**
 * clearAddStudentForm - clears out the form values based on inputIds variable
 */
function clearAddStudentForm()
{
    for (var i = 0; i < inputIds.length; i++)
    {
        $('#' + inputIds[i]).val('');
    }
}
/**
 * calculateAverage - loop through the global student array and calculate average grade and return that value
 * @returns {number}
 */
function calculateAverage()
{
    val avg = 0;

    for (var i = 0; i < student_array.length; i++)
    {
        val_avg += student_array[i].grade;
    }

    val_avg /= student_array.length;
    return val_avg;
}
/**
 * updateData - centralized function to update the average and call student list update
 */
function updateData()
{

}
/**
 * updateStudentList - loops through global student array and appends each objects data into the student-list-container > list-body
 */
function updateStudentList()
{

}
/**
 * addStudentToDom - take in a student object, create html elements from the values and then append the elements
 * into the .student_list tbody
 * @param studentObj
 */
function addStudentToDom(studentObj)
{

}
/**
 * reset - resets the application to initial state. Global variables reset, DOM get reset to initial load state
 */
function reset()
{
    student_array = [];
}

/**
 * Listen for the document to load and reset the data to the initial state
 */
//document.addEventListener("DOMContentLoaded", function(event)
$(document).ready(function()
{

});