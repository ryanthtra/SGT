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

var entryId = 0;
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
        entry_id: 0,
        name: '',
        course: '',
        grade: 0
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
    // Add unique entry id
    newStudent.entry_id = entryId++;

    student_array[student_array.length] = newStudent;
    updateData();
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
    var val_avg = 0;

    for (var i = 0; i < student_array.length; i++)
    {
        val_avg += parseInt(student_array[i].grade);
    }

    if (student_array.length > 0)
        val_avg /= student_array.length;
    return Math.floor(val_avg);
}
/**
 * updateData - centralized function to update the average and call student list update
 */
function updateData()
{
    $('.avgGrade').text(calculateAverage());
    updateStudentList();

}
/**
 * updateStudentList - loops through global student array and appends each objects data into the student-list-container > list-body
 */
function updateStudentList()
{
    if (student_array.length > 0)
        $('#unavailable').remove();

    for (var i = 0; i < student_array.length; i++)
        addStudentToDom(student_array[i]);
}
/**
 * addStudentToDom - take in a student object, create html elements from the values and then append the elements
 * into the .student_list tbody
 * @param studentObj
 */
function addStudentToDom(studentObj)
{
    // If the student entry is already in the DOM, then don't add it
    var found = $('td.entry-id:contains(' + studentObj.entry_id + ')').text();
    if (found != "")
        return;

    var student_table = $('.student-list>tbody');

    var new_student = $('<tr>');
    new_student.append($('<td>').text(studentObj.name));
    new_student.append($('<td>').text(studentObj.course));
    new_student.append($('<td>').text(studentObj.grade));
    new_student.append($('<td>').append($('<button>',
        {
            type: 'button',
            class: 'btn btn-danger btn-xs',
        }).text('Delete')));


    // Adds invisible entry id
    var new_id = $('<td>',
        {
            class: 'hidden entry-id'
        });
    new_id.text(studentObj.entry_id);
    new_student.append(new_id);

    student_table.append(new_student);
}
/**
 * reset - resets the application to initial state. Global variables reset, DOM get reset to initial load state
 */
function reset()
{
    student_array = [];
    $('div.student-list-container').append($('<h3>', {id: 'unavailable'}).append($('<b>').text('User Info Unavailable')));
}

/**
 * Listen for the document to load and reset the data to the initial state
 */
//document.addEventListener("DOMContentLoaded", function(event)
$(document).ready(function()
{
    reset();
    updateData();
});