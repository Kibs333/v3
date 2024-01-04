<?php @include 'password_verify.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PIU Login Form</title>
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
<h2>PIU PORTAL LOGIN</h2>
<p>PIU PORTAL SIGN UP → <button type="button" id="log">Sign up</button></p>
<?php 
if(isset($error))
{foreach($error as $error){echo '<span class="err"> '.$error.' </span>';}}
?>
<form action="log-in.php" method="post">
    <label for="email">School Email*</label><br>
    <input type="text" id="email" name="email" autocomplete="email"placeholder="Example: name.lastname@students.piu.ac.ke"required><br>
    <label for="password">Password*</label><br>
    <input type="password" id="password" name="password" required><br>
    <input id="submit-btn" type="submit" name ="submit" value="Submit" >
    <a class="forgot-a" href="forgot.php"><p class="forgot">forgot password ?</p></a> 
     <a class="forgot-a" href="staff/staff.php"><p class="forgot">Staff log-in</p></a> 
</form>
<script src="resources/js/log-in.js"></script>
</body>
</html>