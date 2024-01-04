<?php
@require 'config.php';
@require_once 'session_security.php';

$_SESSION['otpShow']=false;
$_SESSION['formShow']=true;

if(isset($_POST['submit_sign_up']))
{
     if(!$_SERVER["REQUEST_METHOD"]=="POST"){
            die("Error.Try Again Later.");
           return;
     }
   function checkEmail($email) {
    // Check if the email ends with "@students.piu.ac.ke"
    $suffix = "@students.piu.ac.ke";
    $emailLength = strlen($email);
    $suffixLength = strlen($suffix);

    if ($emailLength >= $suffixLength && substr_compare($email, $suffix, -$suffixLength) === 0) {
        return true;
    } else {
        return false;
    }
}

function validateEmail($email) {
    // Decode HTML entities
    $email = html_entity_decode($email);

    // Remove all illegal characters from email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Validate email address
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if the email contains numbers or characters other than '@' and '.'
        if (preg_match('/[0-9]+/', $email) ||preg_match('/[^a-zA-Z0-9@."`\']+/', $email)) {
            //echo 'Email contains numbers or characters other than "@" and "."';
            return false;
        } else {
           // echo 'Email is valid';
           return true;
        }
    } else {
        //echo 'Email is not valid';
        return false;
    }
}

        $admno = htmlspecialchars($_POST['combinedData']);
        $email = htmlspecialchars($_POST['email']);
        $password =$_POST['password'];
        $dept=$_POST['course-no'];
        
        if(empty($admno)){
            $error[] ='Admission number incomplete';
            return;
        }
         if(empty($password)){
            $error[] ='Admission number incomplete';
            return;
        } if(empty($email)){
            $error[] ='Admission number incomplete';
            return;
        } if(empty($dept)){
            $error[] ='Admission number incomplete';
            return;
        }

        $userEmail = $email ;

       if (checkEmail($userEmail) && validateEmail($userEmail)) {
        
        @require_once 'hashpassword.php';

        $_SESSION['admno']=$admno;
        $_SESSION['email']=$email ;
 
        $_SESSION['password']= $hashedpwd;
        $_SESSION['dept']=$dept;

        try {
             $select = "SELECT * FROM students_form WHERE student_email= ? OR admission_number=?";
             $stmt = $pdo->prepare($select);

             // Bind the value to the placeholder using execute
             $stmt->bindParam(1, $_SESSION['email']);
             $stmt->bindParam(2, $_SESSION['admno']);
             $stmt->execute();

             // Fetch the result as an associative array
             $result = $stmt->fetch(PDO::FETCH_ASSOC);
             if ($result){
                          $result['student_email'];
                          $result['admission_number'];
                          $error[] ='Admission number or Email is already used !';
                        }

                        else {
                              $_SESSION['formShow']=false;
                              $otp = rand(100000, 999999);
                              $_SESSION['otp']=$otp;
                              $_SESSION['otpShow']=true;
                              $_SESSION['otp_attempts']=3;
                              include_once 'sign_up_email.php';
                             }

            }      

        catch (PDOException $e) { die("Failed: ".$e->getMessage());}
        
        
} else {
    $error[] ='Enter Valid email address.';
} 

   
}

if (isset($_POST['verify']) && $_SERVER["REQUEST_METHOD"]=="POST") {
                               $verifyotp = str_replace(' ', '', $_POST['otp']); // Remove spaces from OTP input
                               $remaining_attempts = $_SESSION['otp_attempts'];

                               if ($remaining_attempts > 1) {
                                                             if ($verifyotp == $_SESSION['otp']) {
                                                             // OTP is correct; proceed with account creation
                                                                                                    try {
                                                                                                         $insert = "INSERT INTO students_form (admission_number, student_email, password,dept) VALUES(?,?,?,?);";
                                                                                                         $stmt = $pdo->prepare($insert);
                                                                                                         $stmt->bindParam(1, $_SESSION['admno']);
                                                                                                         $stmt->bindParam(2, $_SESSION['email']);
                                                                                                         $stmt->bindParam(3, $_SESSION['password']);
                                                                                                         $stmt->bindParam(4, $_SESSION['dept']);
                                                                                                         if ($stmt->execute()) {
                                                                                                                                
                                                                                                                                echo '<script>
                                                                                                                                alert("Account created successfully. Please Log In !");
                                                                                                                                setTimeout(function() {
                                                                                                                                window.location.href = "log-in.php";
                                                                                                                                 }, 100); 
                                                                                                                                </script>';
                                                                                                                                session_unset();
                                                                                                                                session_destroy();
                                                                                                                                $_SESSION['otp_attempts'] = 3; // Reset OTP attempts
                                                                                                                                $pdo = null;
                                                                                                                                $stmt = null;
                                                                                                                                }else{die('Error.Try Again Later');}

               
                                                                                                        } catch (PDOException $e) {
                                                                                                                                   die("Failed: " . $e->getMessage());
                                                                                                                                  }
                                                                                                 } else {
                                                                                                          // Wrong OTP
                                                                                                         $remaining_attempts--;
                                                                                                         $_SESSION['otp_attempts'] = $remaining_attempts;
                                                                                                         echo '<script>alert("Wrong OTP. ' . $remaining_attempts . ' attempts remaining.");</script>';
                                                                                                         $_SESSION['otpShow']=true;
                                                                                                         $_SESSION['formShow']=false;
           
                                                                                                        }
                                                             } else {
                                                                     $_SESSION['otp_attempts'] = 3;
                                                                      // Maximum attempts reached
                                                                      echo '<script>
                                                                      alert("Maximum OTP attempts reached.. Please Retry again later !");
                                                                      setTimeout(function() {
                                                                      window.location.href = "sign-up.php";
                                                                      }, 100); 
                                                                     </script>';
                                                            
                                                                     }
                             }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PIU SIGN UP FORM</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="resources/css/style.css">
    <link rel="icon" type="image/png" sizes="192x192" href="resources/img/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="resources/img/android-chrome-512x512.png">
    <link rel="apple-touch-icon" sizes="180x180" href="resources/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="resources/img/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="resources/img/favicon-32x32.png">
    <link rel="icon" href="resources/img/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="resources/img/site.webmanifest">
</head>
<body>
<style>#preloader{background:#2E1353 url(loader.gif);background-repeat:no-repeat;background-size:50%;background-position:center;height:100vh;width:100vw;z-index:100;position: fixed;}</style>
<div id="preloader"></div>
<script>
var loader = document.getElementById("preloader");
window.addEventListener("load", function() {
    loader.style.display = "none";
});
</script>
<h2>PIU PORTAL SIGN UP</h2>
<form id="signupform" action="sign-up.php" <?php if ($_SESSION['formShow'] == false) { echo 'style="display:none;"'; } ?> method="post">
    <p>Already have an account → <button type="button" id="sign">Sign in</button></p>
    <?php if (isset($error)) {foreach ($error as $error) {echo '<span class="err"> ' . $error . ' </span>';}}?>
    <label for="course">Admission number*</label><br>
    <div class="example">example: BAIR/0000/2023</div>
    <div class="input-container">
        <select class="select" id="course" name="course-no" class="input-box" required>
            <option value="" disabled selected>Course</option>
            <option value="BIT">BIT</option>
            <option value="BAIR">BAIR</option>
            <option value="BEDA">BEDA</option>
            <option value="BCOM">BCOM</option>
            <option value="DIT">DIT</option>
            <option value="DIR">DIR</option>
            <!-- ask for more course options here -->
        </select>
        <span>/</span>
        <input type="number" id="idno" name="idno" class="input-box" placeholder="0000" required>
        <span>/</span>
        <input type="number" id="year" name="year" class="input-box" placeholder="2023" required>
        <input type="hidden" id="combinedData" name="combinedData" value="">
    </div><br>
    <label for="email">School Email*</label><br>
    <input type="email" id="email" name="email" class="input" autocomplete="email" placeholder="Example: name.lastname@students.piu.ac.ke"required><br>
    <label for="password">Password*</label><br>
    <input type="password" id="password" name="password"  required><br>
    <input id="submit-btn" type="submit" name="submit_sign_up" value="Submit">
</form>
<form id="hidden-field" <?php if($_SESSION['otpShow'] ==true)
{ echo 'style="display:block;"';}
else { echo 'style="display:none;"';}?>action="sign-up.php" method="post">
<h2 class="email">OTP sent to <?php echo $_SESSION['email'];?>. Please check your Outlook email for the OTP. If you don't see it in your inbox, kindly check your junk or spam folder.</h2>

        <label for="otp">OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <input type="submit" name="verify" value="Verify">
    </form>
<script src="resources/js/sign-up.js"></script>
</body>
</html>