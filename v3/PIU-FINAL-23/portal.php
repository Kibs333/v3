<?php @require_once 'config.php';@require_once 'session_security.php';
if($_SESSION['allowed']==true && isset($_SESSION['student_id']) && isset($_SESSION['full_name']))  
{$reg_status_color="";$reg_button_color="";$reg_status=" ";$reg_button_status=" ";

    $getDetails="SELECT * FROM students_form WHERE id=?";
    
    $stmt=$pdo->prepare($getDetails);
    $stmt->bindParam(1, $_SESSION['student_id']);
    
    if($stmt->execute()){
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($data){
            if(is_null($data['school']) || is_null($data['programme'])|| is_null($data['level_of_study'])){
               
                 $adm=$data['admission_number'];
                 header('location:account_handler.php');

             }else{
                @require_once 'registration-handler.php';
                @require_once 'deadline-handler.php';
    
                // //header("location:portal.php");
                // return;
             }
            
        }else{
            die('Error');
        }
    
    
     }  
// @require_once 'registration-handler.php';
// @require_once 'deadline-handler.php';

}
else{header('location:log-in.php');}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal</title>
    <link rel="stylesheet" href="resources/css/index.css">
    <link rel="icon" type="image/png" sizes="192x192" href="resources/img/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="resources/img/android-chrome-512x512.png">
    <link rel="apple-touch-icon" sizes="180x180" href="resources/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="resources/img/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="resources/img/favicon-32x32.png">
    <link rel="icon" href="resources/img/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="resources/img/site.webmanifest">
    <style>  body{background:#7E57C2;} footer p ,footer a{color:white;} @media(max-width:400px){img{display:none;}.header{display:unset;}}



    .down {
 
      margin-top:30px;
    }

    h2 {color: black;}

    .download-link {
      display: block;
      margin: 20px 0;
      padding: 10px 20px;
      background-color: #3498db;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .download-link:hover {
      background-color: #2980b9;
    }





    .deadline-container {
   display: flex;
   justify-content:flex-start ;
   align-items:center;

    }

    .deadline-heading {
      font-size: 24px;
      margin-bottom: 10px;
      color: #333333;
    }

    .deadline-timer {
      font-size: 16px;
      font-weight: bold;
      color: #e44d26;
    }

    .download-link ,.feedback-link {background:#673AB7;}

</style>
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

    <div class="container">
        <div class="card">
         <div class="log_out">
          <i class="material-icons" title="log Out" id="logOut" style="font-size: 24px;cursor: pointer;color: purple;">logout</i>

          <div class="account" style="    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto;
    position: absolute;
    right: 24px;">
         <i class="material-icons" title="Manage Account" id="account" style="font-size: 24px;cursor: pointer;color: purple;">account_circle</i>
         </div>
         </div>

         <div class="header">
          <div class="grid-1">
           <img class="out" src="resources/img/PIU-LOGO-WHITE.png" alt="Pioneer International University">
          </div>
                <div class="grid-2">
                    <p class="welcome">
                        Welcome <span class="name">
                            <?php echo $_SESSION['full_name'] ?>
                            <p class="motto">Pioneer International University portal</p>
                            <p class="motto">Powered by Intellect Driven by Values</p>
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <?php
        if (isset($deadline_auth) && $deadline_auth==true){
echo '<div class="card ">

<div class="deadline-container">
Deadline:
<h2  class="deadline-heading"id="countdownInput"> '.$deadline.' </h2>   
<h2 class="deadline-timer" id="countdown"></h2>
</div>
    <div class="card-div m-0-a">
        <div class="registration">
            <h1>Registration</h1>
            <div class="status">
                <span>Registration Status:</span>
                <span class="' . $reg_status_color . '">
                    ' . $reg_status . '
                </span>
            </div>
            <div class="reg-btn">
                <form action="" method="post">
                    <button type="submit" class="' . $reg_button_color . '" ' . $reg_button_status . ' name="register">Register Now</button>
                </form>
            </div>
        </div>
    </div>
</div>';}else{
    echo '<div class="card">
    <div class="card-div m-0-a">
        <div class="registration">
            <h1>Registration</h1>
            <div class="status">
                <span>Registration Status:</span>
                <span class="' . $reg_status_color . '">
                    ' . $reg_status . '
                </span>
            </div>

        </div>
    </div>
</div>';



}
?>

        <div class="cat-container card">
         <h1>Cat Marks</h1>
         <a href="course-/student.php" target="_blank" title="get access to your cat marks" class="feedback-link">Access</a>
        </div> 

        <div class="down card">
         <h2>Downloads</h2>
          <a href="resources/downloads/Courses on Offer-Jan-Apr 2024"  target="_blank" rel="noopener noreferrer"  class="download-link" download>Courses on Offer-Jan-Apr 2024</a>
          <a href="resources/downloads/Fees_structure" target="_blank" rel="noopener noreferrer" class="download-link" >Download Fee Structure</a>
          <a href="resources/downloads/Document Form"  target="_blank" rel="noopener noreferrer"   class="download-link" download>Download Document Form</a>
       </div>
        <div class="feedback-container card">
         <h1>Give us your feedback!</h1>
         <p>We would love to hear from you. Click the link below to send us your feedback.</p>
         <a href="register1.4\send-feedback.php" target="_blank"  title="send feedback about the portal"class="feedback-link">Send Feedback</a>
        </div> 
       </div>
<footer>
   <div>
   <p>Developed by<a href="https://piu-ihub.sicklywall.com/" target="_blank" rel="noopener noreferrer">Research and Innovation hub</a></p>
    </div> 
</footer>
    <script  defer src="resources/js/portal.js">

    </script>


<script>
                function startCountdown() {
            // Get the user input time
            var InputTime = document.getElementById('countdownInput');
            userInputTime=InputTime.innerText;
     
            InputTime.style.display="none";
            // Calculate the remaining time in milliseconds
            var endTime = new Date(userInputTime).getTime();
            var now = new Date().getTime();
            var timeRemaining = endTime - now;

            // Update the countdown every second
            var countdownInterval = setInterval(function() {
                now = new Date().getTime();
                timeRemaining = endTime - now;



                            // Calculate days, hours, minutes, and seconds
            var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

            // Display the countdown
            var countdownElement = document.getElementById('countdown');
            countdownElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";


                // Check if the countdown is over
                if (timeRemaining < 0) {
                    clearInterval(countdownInterval);
                    document.getElementById('countdown').innerHTML = "Time's up!";
                }
            }, 1000);
        }
        startCountdown();
</script>
    
</body>
</html>