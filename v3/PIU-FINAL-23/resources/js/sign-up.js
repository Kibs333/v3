document.getElementById("sign").addEventListener("click", function () {
    window.location.href="log-in.php"});


document.getElementById("submit-btn").addEventListener("click", function (event) {
    var course = document.getElementById("course").value;
    var idno = document.getElementById("idno").value;
    var year = document.getElementById("year").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (course === "" || idno === "" || year === "" || email === "" || password === "") {
        alert("Please fill in all fields");
        event.preventDefault(); // Prevent form submission
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
        alert("Year must be before 2024.");
        event.preventDefault(); // Prevent form submission
        return;
    }
    
    if (idno.length < 4) {
        alert("ID No must be at least four characters long.");
        event.preventDefault(); // Prevent form submission
        return;
    }  
           if (idno.length > 5) {
        alert("You have exceeded the maximum length.Please refer to your admission number.");
        event.preventDefault(); // Prevent form submission
        return;
    } 
    var specialChars = /[!@#$%^&*(),.?":{}|<>\-_]/;
    if (specialChars.test(idno)) {
    alert('Special characters are not allowed.Please refer to your admission number.');
    event.preventDefault();
    return;
    }

    if (!email.endsWith("students.piu.ac.ke")) {
        alert("Email must be PIU school Email.");
        event.preventDefault(); 
        return;
    }
    function validateEmail(email) {
        // Regular expression to check for special characters other than '@' and '.'
        // var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
       

     var regex = /^[a-zA-Z.'"`_-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,6}$/;

        if (regex.test(email)) {
          //console.log('Email is valid');
        } else {
            alert("Email contains invalid characters.");
            event.preventDefault(); 
            return;
        }
      }

    validateEmail(email);
    var combinedData = course + "/" + idno + "/" + year;
    document.getElementById("combinedData").value = combinedData;

});
