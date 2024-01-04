<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" type="image/png" sizes="192x192" href="../resources/img/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="../resources/img/android-chrome-512x512.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../resources/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../resources/img/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../resources/img/favicon-32x32.png">
    <link rel="icon" href="../resources/img/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="../resources/img/site.webmanifest">
    <link rel="stylesheet" href="resources/css/student.css">
    <title>CAT MARKS</title>
    <title>Year and Semester Form</title>
</head>
<body>
<style>#preloader{background:#2E1353 url(../loader.gif);background-repeat:no-repeat;background-size:50%;background-position:center;height:100vh;width:100vw;z-index:100;position: fixed;}</style>
<div id="preloader"></div>
<script>
var loader = document.getElementById("preloader");
window.addEventListener("load", function() {
    loader.style.display = "none";
});
</script>
    <?php
include_once 'config.php';

function checksubmission($pdo,$table,$serialid){

$query = "SELECT serial_id FROM `$table` WHERE serial_id=?";

$stmt = $pdo->prepare($query);

$stmt->bindParam(1, $serialid);

$stmt->execute();

// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Output the result
if ($result) {
  //echo "data found";
  return true;
} else {
   // echo "No data found";
    return false;
}

}
session_start();

if(!isset($_SESSION['student_adm'])){
    header("location:../portal.php");
    return;
}else{
    
$adm=$_SESSION['student_adm']; 
$explodeAdmission=explode(',', $adm);
$dept=$explodeAdmission[0];
$directory = 'cat_marks';

// Check if the directory exists
if (is_dir($directory)) {
    
    // Get the list of files in the directory
    $files = scandir($directory);
    // Remove . and .. from the list
    $files = array_diff($files, array('..', '.'));
    $files = preg_grep('/\.json$/', $files);
    if($files){
    // Output the list of files
    foreach ($files as $file) {

        $jsonContent = file_get_contents($directory.'/'.$file);
            // Decode the JSON data into a PHP array
        $data = json_decode($jsonContent, true); // Set the second parameter to true for an associative array

    if(isset($data['grades'][$adm])){

        $table=$data['courseEvalTable'];
               
        $serialid=$_SESSION['student_id'];
        
        $submit=checksubmission($pdo,$table,$serialid);
       
        echo '<table>';
        echo '<tr>';
        echo '<th>UNIT NAME </th>';
        echo '<th>UNIT CODE </th>';
        echo '<th>LECTURER NAME </th>';
        echo '<th>CAT MARKS</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>'.$data['UnitName'].'</td>';
        echo '<td>'.$data['unitCode'].'</td>';
        echo '<td>'.$data['lecturer_name'].'</td>';
        echo '<td>' . ($submit ? $data['grades'][$adm] : ' <form action="student-handler.php" method="get">
        <input type="hidden" name="table" value="' . $table. '">
        <input type="hidden" name="unitcode" value="' . $data['unitCode'] . '">
        <input type="hidden" name="unitname" value="' . $data['UnitName'] . '">
        <input type="hidden" name="lecname" value="' . $data['lecturer_name'] . '">
        <input type="hidden" name="semester" value="' . $data['semester'] . '">
        <input type="hidden" name="yos" value="' . $data['yearOfStudy'] . '">
        <input type="hidden" name="year" value="' . $data['year'] . '">
        <button type="submit">Fill Evaluation Form</button>
    </form>') . '</td>';
    
        echo '</tr>';
        echo '</table>';

    }else{ echo 'No Cat marks uploaded yet.';}
     
    }}else{echo 'No Cat marks uploaded yet.' ;}

} else {echo 'No Cat marks uploaded yet.';}
    
} 
?>
</body>
</html>