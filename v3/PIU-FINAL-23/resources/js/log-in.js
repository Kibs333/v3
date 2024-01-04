document.getElementById("log").addEventListener("click", function () {
    window.location.href="sign-up.php"});

    
document.getElementById("submit-btn").addEventListener("click", function (event) {
  
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (email === "" || password === "") {
        alert("Please fill in all fields");
        event.preventDefault(); // Prevent form submission
        return;
    }
    if (!email.endsWith("piu.ac.ke")) {
        alert("Please use your school email.");
        event.preventDefault(); // Prevent form submission
        return;
    }

});