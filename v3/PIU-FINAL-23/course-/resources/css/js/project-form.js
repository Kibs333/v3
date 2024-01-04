document.addEventListener('DOMContentLoaded', function () {
    // Add the IDs of the input fields you want to make required
    var requiredFields = ['year', 'semester','course_code','course_title','course_lecturer'];
    // Loop through the array and set the "required" attribute for each input
    requiredFields.forEach(function (fieldId) {
        var inputField = document.getElementById(fieldId);
        if (inputField) {
            inputField.required = true;
        }
    });



//     var currentYear = new Date().getFullYear();

//     // Display the current year in the designated element
//     document.getElementById("year").value = currentYear;
//
 });