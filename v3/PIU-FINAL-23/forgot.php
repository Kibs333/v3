<?php
@require 'config.php';
@require_once 'session_security.php';

$_SESSION['otpShow']=false;
$_SESSION['formShow']=true;
$_SESSION['passShow'] =false;

if(isset($_POST['submit_forgot']))
{
    $email = htmlspecialchars($_POST['email']);
    $_SESSION['email']=$email;  
    try {
        $select = "SELECT * FROM students_form WHERE student_email= ? ";
        $stmt = $pdo->prepare($select);
        // Bind the value to the placeholder using execute
        $stmt->bindParam(1, $_SESSION['email']);
        $stmt->execute();
        // Fetch the result as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result)

         { $_SESSION['formShow']=false;
            $otp = rand(100000, 999999);
            $_SESSION['otp']=$otp;
            $otp;
            $_SESSION['otpShow']=true;
            include_once 'sign_up_email.php';
        }
          
         else {
                
                $error[] ='Email not found !';
            }

        }      

    catch (PDOException $e) { die("Failed: ".$e->getMessage());}

}

 if(isset($_POST['verify'])){
    
      $verifyotp=$_POST['otp'];

 if ( $verifyotp== $_SESSION['otp']) {
       $_SESSION['formShow']=false;
       $_SESSION['passShow'] =true;
       $_SESSION['otpShow']=false;
}
    else{ echo'wrong otp try again';
       
        $error[] ='Wrong OTP Try Again !';}
    }
    if(isset($_POST['forgot'])){

        $password =$_POST['password'];
        @require_once 'hashpassword.php';
        $_SESSION['password']= $hashedpwd;
    
        try {
            
            $update = "UPDATE students_form SET password=? WhERE student_email=? ;";
            $stmt=$pdo->prepare($update);
            $stmt->bindParam(1, $_SESSION['password']);
            $stmt->bindParam(2, $_SESSION['email']);
          
          
            if(  $stmt->execute()){
                session_unset();
                session_destroy();
            echo '<script>
                alert("password updated successfully. Please Log In !");
                setTimeout(function() {
                    window.location.href = "log-in.php";
                }, 500); 
            </script>';
            $pdo=null;
            $stmt=null; }
            } catch (PDOException $e) { die("Failed: ".$e->getMessage()); }
        }

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>PIU forgot password Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="resources/css/style.css">
</head>
<body>
<h2>PIU forgot password</h2>

<form id="signupform" action="forgot.php" <?php if ($_SESSION['formShow'] == false) { echo 'style="display:none;"'; } ?> method="post">
    <p>Already have an account → <button type="button" id="cancel">Sign in</button></p>
    <?php if (isset($error)) {foreach ($error as $error) {echo '<span class="err"> ' . $error . ' </span>';}}?>
    <label for="email">School Email*</label><br>
    <input type="email" id="email" name="email" class="input" autocomplete="email" placeholder="Example: name.lastname@students.piu.ac.ke"required><br>
    <input id="submit-btn" type="submit" name="submit_forgot" value="Submit">
</form>

<form id="hidden-field"  <?php if($_SESSION['otpShow'] ==true)
{ echo 'style="display:block;"';}
else { echo 'style="display:none;"';}?>action="forgot.php" method="post">
<h2>OTP sent to your Email</h2>
        <label for="otp">OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <input type="submit" name="verify" value="Verify">
</form>

<form id="hidden-field-2" action="forgot.php" <?php if ($_SESSION['passShow'] == false) { echo 'style="display:none;"'; } ?>method="post">
     <h2>Enter new password</h2>
             <label for="password">Password:</label>
             <input type="password" id="password" name="password" required>
             <input type="submit" name="forgot" value="confirm">
             
         </form>

<script>
    document.getElementById("cancel").addEventListener("click", function () {
    window.location.href="log-in.php"});
    document.getElementById("submit-btn").addEventListener("click", function (event) {
      var email = document.getElementById("email").value;
      if (email === "") {
        alert("Please fill in all fields");
        event.preventDefault(); // Prevent form submission
        return;
    }
    if (!email.endsWith("students.piu.ac.ke")) {
        alert("Please use your school email");
        event.preventDefault(); // Prevent form submission
        return;
    }
});
</script>
</body>
</html>