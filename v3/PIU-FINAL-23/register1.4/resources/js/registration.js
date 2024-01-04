window.onload = function() {
    var btn=document.getElementById("submit-btn");

      btn.addEventListener("click", function (event) {
    var course = document.getElementById("course").value;
    var idno = document.getElementById("idno").value;
    var year = document.getElementById("year").value;
    var email = document.getElementById("email").value;


    if (course === "" || idno === "" || year === "" || email === "") {
        alert("Please fill in all fields");
        event.preventDefault(); // Prevent form submission
        btn.style.background="red";
        return;
    }

    if (!isNaN(course)) {
        alert("Course must not be a number.");
        event.preventDefault(); // Prevent form submission
        return;
    }

    if (isNaN(idno) || isNaN(year)) {
        alert("ID No and Year must be numbers.");
        event.preventDefault(); // Prevent form submission
        return;
    }

    if (year >= 2024) {
        alert("Year must be before 2023.");
        event.preventDefault(); // Prevent form submission
        return;
    }
    
    if (idno.length < 3) {
        alert("ID No must be at least three characters long.");
        event.preventDefault(); // Prevent form submission
        return;
    }
    
    if (!email.endsWith("piu.ac.ke")) {
        alert("Email must end with 'piu.ac.ke'.");
        event.preventDefault(); // Prevent form submission
        return;
    }

    var combinedData = course + "/" + idno + "/" + year;
    document.getElementById("combinedData").value = combinedData;

    // Proceed with form submission or other actions.
    //alert(combinedData);
    
    function getSelectedValues(event) {
  let closGroup = document.getElementsByName("clos");
  let selectedclos = getSelectedValue(closGroup);

  if (selectedclos !== null) {
    let confirmation = confirm("You have chosen " + selectedclos + " as the semester for your application. Is this information correct?");
    if (!confirmation) {
      event.preventDefault();
    }
  }
}

function getSelectedValue(group) {
  for (let i = 0; i < group.length; i++) {
    if (group[i].checked) {
      return group[i].value;
    }
  }
  return null;
}

 getSelectedValues(event);   
});

var ids=[
    
    "student-first-name",
    "middle-name",
    "last-name",
    // "course",
    // "idno",
    // "year",
    // "email",
    "tel1",
    "tel-2",


"guardian-1-input-name",
"guardian-1-input-tel",
"guardian-1-input-email",
"guardian-2-input-name",
"guardian-2-input-tel",
"guardian-2-input-email",

"courses-completed-so-far",
"new-courses-registered",
"academic_advisor",



"id-number",
"id-full-name",
"id-dob",
"id-gender",
"id-district-of-birth",
"id-district",
"id-location",
"id-poi",
"id-division",
"id-sub-location",

"medical-condition",

"course-1",
"course-1-title",
"course-2",
"course-2-title",
"course-3",
"course-3-title",
"course-4",
"course-4-title",
"course-5",
"course-5-title",
"course-6",
"course-6-title",
"course-7",
"course-7-title",
"course-8",
"course-8-title",

"professional-1",
"professional-1-title",
"professional-2",
"professional-2-title",
"professional-3",
"professional-3-title",
"professional-4",
"professional-4-title",
"professional-5",
"professional-5-title"
];

// var namesradios=[

//     "school",
//     "level",
//     "prog",
//     "fsem",
//     "clos",
//     "nhif-member-name",
//     "nhif-valid"
// ];

function embeddvalue(){ 
    for (let i = 0; i <=sessionStorage.length; i++) {
        var element = document.getElementById(ids[i]);
        if (element === null) {element = document.getElementsByName(ids[i])[0];}
        // Corrected syntax to retrieve value from sessionStorage
        var sessionStorageValue = sessionStorage.getItem(ids[i]);
        //console.log(sessionStorageValue);
        element.value=sessionStorageValue;
        //sessionStorage.clear();
    }
}
embeddvalue();

// Check if the page is being reloaded
if (performance.navigation.type === 1) {
    //console.log("Page is being reloaded");
    //console.log(sessionStorage.getItem('values'));
    embeddvalue();
    
} else {
    //console.log("Page is not being reloaded");
}

for (let i = 0; i < ids.length; i++) {
    var element = document.getElementById(ids[i]);

    if (element === null) {
        element = document.getElementsByName(ids[i])[0];
    }

    // Add change event listener to the element
    element.addEventListener('change', function () {
        // 'this' refers to the element that triggered the change event
        // Use 'this.value' to get the value of the element
        console.log(`Change event triggered for element with ID ${ids[i]}. Value: ${this.value}`);
        sessionStorage.setItem(ids[i], this.value);
        setvalue.push(ids[i]);
        set();
    });
    function set(){sessionStorage.setItem("values", setvalue);}
    // Add click event listener to the element

}
var button = document.getElementById("submit-btn");
button.addEventListener('click', function (event) {
    var submitids=[
    
        "student-first-name",
        "middle-name",
        // "last-name",
        // "course",
        // "idno",
        // "year",
        // "email",
        "tel1",
        // "tel-2",
    
    "guardian-1-input-name",
    "guardian-1-input-tel",
    "guardian-1-input-email",
    // "guardian-2-input-name",
    // "guardian-2-input-tel",
    // "guardian-2-input-email",
    
    "courses-completed-so-far",
    "new-courses-registered",
    "academic_advisor",
    "id-number",
    "id-full-name",
    "id-dob",
    "id-gender",
    "id-district-of-birth",
    "id-district",
    "id-location",
    "id-poi",
    "id-division",
    "id-sub-location",
    
    // "medical-condition",
    
    // "course-1",
    // "course-1-title",
    // "course-2",
    // "course-2-title",
    // "course-3",
    // "course-3-title",
    // "course-4",
    // "course-4-title",
    // "course-5",
    // "course-5-title",
    // "course-6",
    // "course-6-title",
    // "course-7",
    // "course-7-title",
    // "course-8",
    // "course-8-title",
    
    // "professional-1",
    // "professional-1-title",
    // "professional-2",
    // "professional-2-title",
    // "professional-3",
    // "professional-3-title",
    // "professional-4",
    // "professional-4-title",
    // "professional-5",
    // "professional-5-title"
    
    ];

    for (let i = 0; i < submitids.length; i++) {
        var element = document.getElementById(submitids[i]);
        if (element === null) {
            element = document.getElementsByName(submitids[i])[0];
        }
        if (element.value === "") {
             alert("Please fill in all fields ");
            event.preventDefault();
            //console.log(element.value);
            element.style.border = '1px solid red';
            //element.style.color = 'red';
            return;
        }
    }
});
}