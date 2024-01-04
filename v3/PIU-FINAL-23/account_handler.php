<?php
include "config.php";

include 'session_security.php';
$getDetails="SELECT * FROM students_form WHERE id=?";

$stmt=$pdo->prepare($getDetails);
$stmt->bindParam(1, $_SESSION['student_id']);

if($stmt->execute()){
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if($data){
        if(is_null($data['school']) || is_null($data['programme'])|| is_null($data['level_of_study'])){
           
             $adm=$data['admission_number'];
         }else{
            @require_once 'registration-handler.php';
            @require_once 'deadline-handler.php';

            header("location:portal.php");
            return;
         }
        
    }else{
        die('Error');
    }


 }



    

    if(isset($_POST['submit'])){

        if($_SERVER["REQUEST_METHOD"]=="POST"){
        }else{
            die('Invalid Request');
        }

       $name=htmlspecialchars($_POST['name']);
       $adm_no=htmlspecialchars($_POST['adm_no']);
       $no=htmlspecialchars($_POST['no']);

     
       $adm_no=htmlspecialchars($_POST['adm_no']);
       $School=htmlspecialchars($_POST['School']);
       $prog=htmlspecialchars($_POST['prog']);
       $LOS=htmlspecialchars($_POST['LOS']);




       // $academic_advisor= htmlspecialchars($_POST['academic_advisor']);
       $id_number = htmlspecialchars($_POST['nationalId']);
       $id_full_name = htmlspecialchars($_POST['fullName']);
       $id_dob = htmlspecialchars($_POST['dob']);
       $id_gender = htmlspecialchars($_POST['gender']);
       $id_district_of_birth = htmlspecialchars($_POST['districtOfBirth']);
       $id_district = htmlspecialchars($_POST['district']);
       $id_location = htmlspecialchars($_POST['location']);
       $id_poi= htmlspecialchars($_POST['placeOfIssue']);
       $id_division= htmlspecialchars($_POST['division']);
       $id_sub_location= htmlspecialchars($_POST['subLocationi']);


     
       $medical_condition = htmlspecialchars($_POST['medical-condition']);
       $medical_condition_declared = htmlspecialchars($_POST['medical_condition_declared']);
















       if(empty($adm_no)|| empty($School)|| empty($prog)|| empty($LOS)){

        echo "
        <script>alert('Some details are missing..')history.back();</script>";

       }

 //$adm_no=
       $Insert="UPDATE students_form SET school=?,programme=?,level_of_study=? WHERE id=? ";

       $stmt=$pdo->prepare($Insert);
       $stmt->bindParam(1,$School );
       $stmt->bindParam(2,$prog);
       $stmt->bindParam(3,$LOS);
       $stmt->bindParam(4, $_SESSION['student_id']);
       if($stmt->execute()){
         header("location:portal.php");
        // echo "<script>alert('Thank you for confirming your details. Please proceed by filling out the next form to complete the process.')window.location.href='portal.php';</script>";
       }

       if(!$adm==$adm_no){
          $update_adm="UPDATE students_form SET admission_number=? WHERE id=? ";
          $stmt=$pdo->prepare(1,$adm_no);
          $stmt=$pdo->prepare(2,$_SESSION['student_id']);
          $stmt->execute();

       }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <title>Account Detailss</title>
    <style>

select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            background-color: #fff;
            width: 300px;
            transition: border-color 0.3s ease;
        }

        /* Style the select box when focused */
        select:focus {
            border-color: #4caf50;
        }
        h1{font-size: 14px;}
    </style>
</head>
<body>

<div class="container"style="display:noe">
<form action="" method="post">
    
        <h1>Account Details</h1>

        <label for="name">Name</label>
        <input type="text" id="name" value="<?php echo $_SESSION['full_name'];?>" >

        <label for="email">Email</label>
        <input type="text" id="email" value="<?php echo $_SESSION['email'];?>" readonly>

        <label for="no">Telephone Number</label>
        <input type="text" id="no" name="no">
        

        <label for="adm_no">Admission Number</label>
        <input type="text"name="adm_no" id="adm_no" value="<?php  echo $data['admission_number'];?>">
        <label for="School">School</label>
        <!-- <input type="text" id="School" name="School" required> -->
        <select name="School" id="School" required>
        <option  value="" disabled selected>Select your school</option>
         <option value="SBM">SBM</option>
         <option value="SICT">SICT</option>
         <option value="SDSS">SDSS</option>
         <option value="SEDU">SEDU</option>
         <option value="SAMS">SAMS</option>
        </select>


        <label for="prog">Programme</label>
        <!-- <input type="email" id="prog" name="prog" required> -->

        <select name="prog" id="prog">
         <option value="" disabled selected >Select your programme</option>
         <option value="DBM">DBM</option>
         <option value="DIT">DIT</option>
         <option value="DPGM">DPGM</option>
         <option value="DBIT">DBIT</option>
         <option value="BCOM">BCOM</option>

        <option value="BA-IR">BA-IR</option>
        <option value="DIR">DIR</option>
        <option value="DMTL">DMTL</option>
        <option value="DSWCD">DSWCD</option>
        <option value="DAM">DAM</option>
        <option value="BSIT">BSIT</option>
        <option value="BED-A">BED-A</option>

       </select>

        <label for="LOS">Level of Study</label>
        <!-- <input type="text" id="LOS" name="LOS" required> -->
        <select name="LOS" id="LOS">
        <option value="" disabled selected>Select your level of study</option>
        <option value="Certificate">Certificate</option>
        <option value="Diploma">Diploma</option>
        <option value="Degree">Degree</option>
        <option value="Masters">Masters</option>
        </select>
      
<br>
        <h1>National ID Form</h1>

        <label for="nationalId">National ID Number:</label>
        <input type="number" id="nationalId" name="nationalId">

        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="">

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="">

        <label>Gender:</label>
        <input type="text" id="Gender" name="">

        <label for="districtOfBirth">District Of Birth:</label>
        <input type="text" id="districtOfBirth" name="">

        <label for="district">District:</label>
        <input type="text" id="district" name="">

        <label for="location">Location:</label>
        <input type="text" id="location" name="">

        <label for="placeOfIssue">Place of Issue:</label>
        <input type="text" id="placeOfIssue" name="">

        <label for="division">Division:</label>
        <input type="text" id="division" name="">

        <label for="subLocation">Sub Location:</label>
        <input type="text" id="subLocation"  name="">
        <button name="submit"id="submit"type="submit"style="margin-top: 20px;">Confirm</button>

    </form>
</div>
<script>

var btn = document.getElementById("submit");
btn.addEventListener("click", function(event) {



  var name = document.getElementById("name");

  var adm_no = document.getElementById("adm_no");

   var no = document.getElementById("no");

   var nationalId = document.getElementById("nationalId");

   var fullName = document.getElementById("fullName");
    
    var dob = document.getElementById("dob");
    
    var  Gender= document.getElementById("Gender");
    
    var districtOfBirth = document.getElementById("districtOfBirth");
    
    var  district= document.getElementById("district");
    
    var location = document.getElementById("location");

    var  placeOfIssue= document.getElementById("placeOfIssue");

    var  division= document.getElementById("division");

    var  subLocation= document.getElementById("subLocation");


   var school = document.getElementById("School");
   var programme = document.getElementById("prog");
   var los = document.getElementById("LOS");
   if(name.value=='' ){
      alert('Please fill in full name');
      event.preventDefault();
      return;
     }
     if(no.value=='' ){
      alert('Please fill in telephone number');
      event.preventDefault();
      return;
     }
     if(nationalId.value=='' ){
      alert('Please fill in  your national Id');
      event.preventDefault();
      return;
     }
     
     if(fullName.value=='' ){
      alert('Please fill in  your  ID full Name');
      event.preventDefault();
      return;
     }
     
     if(dob.value=='' ){
      alert('Please fill in  your  ID date of birth');
      event.preventDefault();
      return;
     }

     if(Gender.value=='' ){
      alert('Please fill in  your Gender');
      event.preventDefault();
      return;
     }

     if(districtOfBirth.value=='' ){
      alert('Please fill in  your district Of Birth');
      event.preventDefault();
      return;
     }
     if(district.value=='' ){
      alert('Please fill in  your district');
      event.preventDefault();
      return;
     }
     if(location.value=='' ){
      alert('Please fill in  your location');
      event.preventDefault();
      return;
     }

     if(placeOfIssue.value=='' ){
      alert('Please fill in  your place Of Issue');
      event.preventDefault();
      return;
     }


     if(division.value=='' ){
      alert('Please fill in  your division');
      event.preventDefault();
      return;
     }

     if(subLocation.value=='' ){
      alert('Please fill in  your sub Location');
      event.preventDefault();
      return;
     }



if(adm_no.value=='' ){

    alert('Please fill in Admission number details');
    event.preventDefault();
    return;
}

if(school.value==''){

    alert('Please fill in School details');
    event.preventDefault();
    return;
}


if(programme.value=='' ){
    alert('Please fill in Programme details');
    event.preventDefault();
    return;

}

if(los.value==''){
    alert('Please fill in Level of study details');
    event.preventDefault();
    return;

}





if(!name.value==fullName.value){
    alert('Name and id name do not match ');
    event.preventDefault();
    return;

}



    var isConfirmed = confirm("Please verify that the details below are accurate. Changes are not permitted.Do you confirm everything is correct?");

    if (isConfirmed) {
        return;
    } else {
        event.preventDefault();
        return;
    }
    event.preventDefault();
});

</script>
</body>
</html>
