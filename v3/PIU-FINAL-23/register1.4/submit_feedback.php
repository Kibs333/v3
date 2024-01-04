<?php
@require_once '../session_security.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
if( $_SESSION['allowed']==true &&  isset($_SESSION['student_id'] ) && isset($_SESSION['full_name']))  
{
    // Retrieve form data
    $feedback = htmlspecialchars($_POST["feedback"]);
    $device = htmlspecialchars($_POST["device"]);
    $browser = htmlspecialchars($_POST["browser"]);

    // Validate feedback (in this example, checking if it's not empty)
    if (empty($feedback)) {
        die("Error: Feedback cannot be empty.");
    }

    // Validate browser (in this example, checking if it's not empty)
    if (empty($browser)) {
        die("Error: Browser cannot be empty.");
    }

    @require_once '../config.php';
    $insert = "INSERT INTO  feedback_form (feedback,device,browser,student_id) VALUES (?,?,?,?) ";
    $stmt = $pdo->prepare($insert);
    $stmt->bindParam(1, $feedback);
    $stmt->bindParam(2, $device);
    $stmt->bindParam(3, $browser);
    $stmt->bindParam(4, $_SESSION['student_id']);
    
    if( $stmt->execute())
    {echo '<script>alert("Thank you for your feedback.");</script>';
     echo '<script>setTimeout(function() {window.location.href = "../portal.php";}, 10);</script>';
    }else{
        die("Error: Form not submitted.");    
    }
}else{ header('location:../log-in.php');}
} else {
    // If the form is not submitted via POST method, redirect or handle accordingly
    die("Error: Form not submitted.");
}

