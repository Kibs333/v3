<?php
@require_once '../session_security.php';
@require_once '../config.php';

if(isset($_SESSION['student_id'] ) && $_SESSION['register-pdf']==true)
{

  // var_dump($_SESSION['student_id']);
  // var_dump($_SESSION['register-pdf']);
  // die();
  $reg = "SELECT registrar_approve FROM students_form WHERE  id = ? ";

  $stmt = $pdo->prepare($reg);
  $stmt->bindParam(1, $_SESSION['student_id']);
  $stmt->execute();
  $registrar = $stmt->fetch(PDO::FETCH_ASSOC);

  if($registrar){$registrarapproval=$registrar['registrar_approve'];}else{
    $registrarapproval='Not yet Approved';
  }

  $Query = "SELECT cleared_to_register_on FROM finance_form WHERE student_id = ?  ";

  $stmt = $pdo->prepare($Query);
  $stmt->bindParam(1, $_SESSION['student_id']);
  $stmt->execute();
  $datacleared = $stmt->fetch(PDO::FETCH_ASSOC);
  if($datacleared){
  $financeapproval=$datacleared['cleared_to_register_on'];
  }

 $select = "SELECT * FROM piu_registration_form_data  WHERE student_id = ?;";
 $stmt = $pdo->prepare($select);
 $stmt->bindParam(1, $_SESSION['student_id']);

 if($stmt->execute()){
  $data = $stmt->fetchALL(PDO::FETCH_ASSOC);
  if(!$data){ die("no registration data found");}
  foreach($data as $data ){
    $_SESSION['student_first_name'] = $data['student_first_name'];
    $_SESSION['student_second_name'] = $data['student_second_name'];
    $_SESSION['student_last_name'] = $data['student_last_name'];
    $_SESSION['course_admno'] = $data['course_admno'];
    $_SESSION['adm_idno'] = $data['adm_idno'];
    $_SESSION['adm_year'] = $data['adm_year'];
    $_SESSION['combined_adm_data'] = $data['combined_adm_data'];
    $_SESSION['school_email'] = $data['school_email'];
    $_SESSION['student_tel'] = $data['student_tel'];
    $_SESSION['student_tel_2'] = $data['student_tel_2'];
    $_SESSION['school'] = $data['school'];
    $_SESSION['level'] = $data['level'];
    $_SESSION['prog'] = $data['prog'];
    $_SESSION['specialization'] = $data['specialization'];
    $_SESSION['fsem'] = $data['fsem'];
    $_SESSION['clos'] = $data['clos'];
    
    $_SESSION['clos_cer_dip'] = $data['clos_cer_dip'];
    $_SESSION['fsem_year'] = $data['fsem_year'];
    $_SESSION['guardian1name'] = $data['guardian1name'];
    $_SESSION['guardian1tel'] = $data['guardian1tel'];
    $_SESSION['guardian1email'] = $data['guardian1email'];
    $_SESSION['guardian2name'] = $data['guardian2name'];
    $_SESSION['guardian2tel'] = $data['guardian2tel'];
    $_SESSION['guardian2email'] = $data['guardian2email'];
    $_SESSION['courses_completed_so_far'] = $data['courses_completed_so_far'];
    $_SESSION['new_courses_registered'] = $data['new_courses_registered'];
    $_SESSION['academic_advisor'] = $data['academic_advisor'];
    $_SESSION['id_number'] = $data['id_number'];
    $_SESSION['id_full_name'] = $data['id_full_name'];
    $_SESSION['id_dob'] = $data['id_dob'];
    $_SESSION['id_gender'] = $data['id_gender'];
    $_SESSION['id_district_of_birth'] = $data['id_district_of_birth'];
    $_SESSION['id_district'] = $data['id_district'];
    $_SESSION['id_location'] = $data['id_location'];

    $_SESSION['id_poi'] = $data['id_poi'];
    $_SESSION['id_division'] = $data['id_division'];
    $_SESSION['id_sub_location'] = $data['id_sub_location'];
    $_SESSION['nhif_member_name'] = $data['nhif_member_name'];
    $_SESSION['nhif_valid'] = $data['nhif_valid'];
    $_SESSION['medical_condition'] = $data['medical_condition'];
    
    $_SESSION['medical_condition_declared'] = $data['medical_condition_declared'];
    $_SESSION['course_1'] = $data['course_1'];
    $_SESSION['course_1_title'] = $data['course_1_title'];
    $_SESSION['course_2'] = $data['course_2'];
    $_SESSION['course_2_title'] = $data['course_2_title'];
    $_SESSION['course_3'] = $data['course_3'];
    $_SESSION['course_3_title'] = $data['course_3_title'];
    $_SESSION['course_4'] = $data['course_4'];
    $_SESSION['course_4_title'] = $data['course_4_title'];
    $_SESSION['course_5'] = $data['course_5'];
    $_SESSION['course_5_title'] = $data['course_5_title'];
    $_SESSION['course_6'] = $data['course_6'];
    $_SESSION['course_6_title'] = $data['course_6_title'];
    $_SESSION['course_7'] = $data['course_7'];
    $_SESSION['course_7_title'] = $data['course_7_title'];
    $_SESSION['course_8'] = $data['course_8'];
    $_SESSION['course_8_title'] = $data['course_8_title'];
    $_SESSION['professional_1'] = $data['professional_1'];
    $_SESSION['professional_1_title'] = $data['professional_1_title'];
    $_SESSION['professional_2'] = $data['professional_2'];
    $_SESSION['professional_2_title'] = $data['professional_2_title'];
    $_SESSION['professional_3'] = $data['professional_3'];
    $_SESSION['professional_3_title'] = $data['professional_3_title'];
    $_SESSION['professional_4'] = $data['professional_4'];
    $_SESSION['professional_4_title'] = $data['professional_4_title'];
    $_SESSION['professional_5'] = $data['professional_5'];
    $_SESSION['professional_5_title'] = $data['professional_5_title']; }}

$fieldsToSelect = array(
  'school',
  'level',
  'prog',
  'fsem',
  'clos',
  'nhif_member_name',
  'nhif_valid',
  'medical_condition'
);
foreach ($fieldsToSelect as $fieldName) {$_SESSION[$_SESSION[$fieldName]] = true;}
}

else{header('location:../portal.php');}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    <?php echo $_SESSION['combined_adm_data']; ?> - Semester Registration</title>
    <style>
      * {margin: 0;padding: 0;}.container{max-width: 50rem;margin: 0 auto;border: 0.1875rem solid black;padding: 1.875rem;}.info {text-align:center;}.info p {margin-left: 1rem;display: inline;}.piu {text-align: center;}.piu img, .piu p {display: inline;margin: 0;vertical-align: middle;}.logo {max-width: 10%;}img {width: 12.5rem;}.logo-text {font-weight: bold;text-transform: uppercase;font-size: 1.5rem;text-decoration: underline;margin-left: 1.25rem;}.formh1 {text-align: center;}.reg-sub {text-align: center;font-size: 10px;}.b {font-weight: bold;}.main-form tr td {padding-top: 6px;padding-left: 4px;}.main-form tr td:first-child {border:none;border-right:2px solid black;}table {width:100%;border: 0.125rem solid black;border-collapse: collapse;margin: 0 auto;margin-top: 0.625rem;}td{padding-left:4px;}td, th {border: 0.125rem solid black;border-collapse: collapse;}label {width: 8.125rem;}.tel-2 {all: unset;margin-left: 0.625rem;}.select-school {flex: 1;margin-left: 0.625rem;}.tel-1 {all: unset;margin-left: 0.625rem;}.ml-unset {margin-left: unset;}input[type="radio"] {display: none;}input[type="radio"] + label::before {content: '\2713';display: inline-block;width: 1.25rem;height: 1.25rem;text-align: center;border: 0.0625rem solid #000;border-radius: 0.1875rem;margin-right: 0.3125rem;font-size: 1rem;line-height: 1.25rem;background-color: transparent;color: transparent;}input[type="radio"]:checked + label::before {background-color: #00A0E4;color: #fff;}label {cursor: pointer;}.radioForm {max-width: 50rem;border: 0.125rem solid black;padding-left: 1.875rem;margin: 0 auto;margin-top: 0.625rem;}.br {border-right: 0.1875rem solid black;}.ml {margin-left: 0.625rem;}.radio-input {padding: 10px;padding-left: 0.625rem;}.radio-input label {border-right: none;}.b-r-n {border-right: none;}.prog-input label {margin-top: 0.25rem;}.clos label {margin-top: 0.25rem;}.label-guardian1 {justify-content: start;border: 0.1875rem solid black;width: 8.125rem;padding: 1.25rem;margin: 0.625rem;}.g-1 {display: inline-flex;width: 2.5rem;background-color: bisque;}.g-2 {display: inline-flex;width: 2.5rem;background-color: bisque;}.the-guardians {margin: 0.625rem;}.new-course-reg {max-width: 50rem;border: 0.125rem solid black;padding-left: 1.875rem;margin: 0 auto;margin-top: 0.625rem;}.medical-conditions, .nhif-details {border: 0.1875rem solid black;padding: 0.625rem;margin: 0.625rem;}.nhif-details p {text-align: center;}.mb-30 {margin-bottom: 1.875rem;}.courses-completed-so-far span {width: 16.5625rem;display: inline-flex;}.courses-completed-so-far {padding: 0.625rem;border: 0.0625rem solid black;margin: 0.625rem;}.cue-label {flex-direction: column;}.cue-data span {display: inline-flex;width: 8.5rem;}.cue-data {padding: 0.625rem;border: 0.0625rem solid black;margin: 0.625rem;}.proffessional-courses {margin-top: 1.875rem;margin-bottom: 3.125rem;}caption {background: #9e8f8f;}.nhif {width: 6.75rem;display: block;}.submit-button{margin-top: 20px;text-align: center;}.w-100{width: 120px;}.ilb{display: inline-block;vertical-align: middle;padding-block-start: 5px;padding: 5px;}.tel{background:#a52a2a61;}.inline_block{display: inline-block;vertical-align:middle;}
    </style>
</head>
<body>
 <div class="container">
  <div class="info">
   <p>Pioneer International University</p>
   <p>Semester Registration</p>
   <p>Piu/AAR/REG/003</p>
  </div>
  <div class="piu">
   <img class="logo" src="resources/img/cropped-PIU-ICON-512x512-2-1-192x192.png" alt="pioneer international university">
   <p class="logo-text">Pioneer international university</p>
  </div>
  <div class="formh1">
   <h1>Semester Registration Form</h1>
   <p class="reg-sub">This form <span class="b">must</span> be duly completed at the start of every new semester and returned to respective H.O.D's</p>
  </div>
  <table class="main-form">
   <tr>
    <td  class="w-100">Student name</td>
    <td><?php echo  $_SESSION['student_first_name'].' '.$_SESSION['student_second_name'].' '.$_SESSION['student_last_name'];?></td>
   </tr>
   <tr>
    <td  class="w-100">Student Adm</td>
    <td><?php echo $_SESSION['combined_adm_data'];?></td>
   </tr>
   <tr>
    <td class="w-100">School Email</td>
    <td><?php echo $_SESSION['school_email'];?></td>
   </tr>
   <tr>
    <td class="w-100">Student numbers</td>
    <td><span class="tel"> Tel 1:</span><?php echo $_SESSION['student_tel'];?><span class=tel>Tel 2:<?php echo $_SESSION['student_tel_2'];?></span></td>
   </tr>
  </table>
  <table>
   <tr>
    <td class="w-100">SCHOOL</td>
    <td>
    <div class="radio-input">
     <input type="radio" name="school" id="SBM" value="SBM" <?php if(isset($_SESSION['SBM'])){echo 'checked';}?>>
     <label  for="school-1">SCHOOL OF BUSINESS & MANAGEMENT (SBM)</label><br>
     <input type="radio" name="school" id="SICT" value="SICT" <?php if(isset($_SESSION['SICT'])){ echo 'checked';}?>>
     <label for="school-2">SCHOOL OF INFORMATION & COMMUNICATION TECHNOLOGY (SICT)</label><br>
     <input type="radio" name="school" id="SDSS" value="SDSS" <?php if(isset($_SESSION['SDSS'])){ echo 'checked';}?>>
     <label for="school-3">SCHOOL OF DEVELOPMENT & STRATEGIC STUDIES (SDSS)</label><br>
     <input type="radio" name="school" id="SEDU" value="SEDU" <?php if(isset($_SESSION['SEDU'])){ echo 'checked';}?>>
     <label for="school-4">SCHOOL OF EDUCATION (SEDU)</label><br>
     <input type="radio" name="school" id="SAMS" value="SAMS" <?php if(isset($_SESSION['SAMS'])){ echo 'checked';}?>>
     <label for="school-5">SCHOOL OF AEROSPACE & MARITIME STUDIES (SAMS)</label>
    </div>
    </td>
   </tr>
  </table>
  <table>
  <tr>
   <td class="w-100">Level Of Study</td>
   <td>
    <div class="radio-input">
    <div class="ilb"><input type="radio" name="level" id="certificate" value="certificate"<?php if(isset($_SESSION['certificate'])){echo 'checked';}?>>
    <label for="level-1">Certificate</label><br></div>
    <div class="ilb"><input type="radio" name ="level" id="diploma" value="diploma"<?php if(isset($_SESSION['diploma'])){ echo 'checked';}?>>
    <label for="level-2">Diploma</label><br></div>
    <div class="ilb"><input type="radio" name="level" id="degree" value="degree"<?php if(isset($_SESSION['degree'])){ echo 'checked';}?>>
    <label for="level-3">Degree</label><br></div>
    <div class="ilb"><input type="radio" name="level" id="masters" value="masters"<?php if(isset($_SESSION['masters'])){ echo 'checked';}?>>
    <label for="level-4">Masters</label><br></div>
    </div>
   </td>
  </tr>
  </table>
  <table>
   <tr>
   <td class="w-100">Programme</td>
   <td>
    <div class="radio-input flex-wrap prog-input">
     <div class="ilb"><input class="br" type="radio" name="prog" id="DBM" value="DBM"<?php if(isset( $_SESSION['DBM'])){ echo 'checked';}?>>
     <label for="level-6">DBM</label><br></div>
     <div class="ilb"><input type="radio" name="prog" id="DIT" value="DIT" <?php  if(isset( $_SESSION['DIT'])){ echo 'checked';}?>>
     <label for="level-7">DIT</label><br></div>
     <div class="ilb"><input type="radio" name="prog" id="DPGM" value="DPGM" <?php  if(isset( $_SESSION['DPMG'])){ echo 'checked';}?>>
     <label for="level-8">DPGM</label><br></div>
     <div class="ilb"><input type="radio" name="prog" id="DBIT" value="DBIT" <?php  if(isset( $_SESSION['DBIT'])){ echo 'checked';}?>>
     <label for="level-9"> DBIT</label><br></div>
     <div class="ilb"><input class="" type="radio" name="BCOM" id="BCOM" value="BCOM" <?php  if(isset( $_SESSION['BCOM'])){ echo 'checked';}?>>
     <label for="level-10">BCOM</label><br></div>
     <div class="ilb"><input type="radio" name="prog" id="BA-IR" value="BA-IR" <?php  if(isset( $_SESSION['BA-IR'])){ echo 'checked';}?>>
     <label for="level-11">BA-IR </label><br></div>
     <div class="ilb"><input type="radio" name="prog" id="DIR" value="DIR" <?php  if(isset( $_SESSION['DIR'])){ echo 'checked';}?>>
     <label for="level-12">DIR</label><br></div>
     <div class="ilb"><input type="radio" name="prog" id="DMTL" value="DMTL" <?php  if(isset( $_SESSION['DMTL'])){ echo 'checked';}?>>
     <label for="level-9">DMTL</label><br></div>
     <div class="ilb"><input type="radio" name="prog" id="DSWCD" value="DSWCD" <?php  if(isset( $_SESSION['DSWCD'])){ echo 'checked';}?>>
     <label for="level-10">DSWCD</label><br></div>
     <div class="ilb"><input type="radio" name="prog" id="DAAM" value="DAAM" <?php  if(isset( $_SESSION['DAAM'])){ echo 'checked';}?>>
     <label for="level-11">DAM</label><br></div>
     <div class="ilb"><input type="radio" name="prog" id="BSIT" value="BSIT" <?php  if(isset( $_SESSION['BSIT'])){ echo 'checked';}?>>
     <label for="level-12">BSIT</label><br>  </div>
     <div class="ilb"><input type="radio" name="prog" id="BED-A" value="BED-A" <?php  if(isset( $_SESSION['BED-A'])){ echo 'checked';}?>>
     <label for="level-13">BED-A</label></div>
    </div>
   </td>
   </tr>
  </table>
  <table>
  <tr>
    <td class="w-100">Specilization</td>
    <td>
     <input type="text" name="specialization" placeholder="What are you specializing in? " id="specialization" value="<?php echo $_SESSION['specialization'];?>">
    </td>
   </tr>
  </table>
  <table>
   <td class="w-100">First Sem At PIU</td>
   <td>
    <div class="radio-input  level-of-study"> 
     <div class="ilb"><input type="radio" name="fsem" id="JAN-APR" value="JAN-APR" <?php  if(isset( $_SESSION['JAN-APR'])){ echo 'checked';}?>>
      <label for="level-14">JAN-APR</label><br></div>
      <div class="ilb"> <input type="radio" name="fsem" id="MAY-AUG" value="MAY-AUG" <?php  if(isset( $_SESSION['MAY-AUG'])){ echo 'checked';}?>>
      <label for="level-15">MAY-AUG</label><br></div>
      <div class="ilb"> <input type="radio" name="fsem" id="SEP-DEC" value="SEP-DEC" <?php  if(isset( $_SESSION['SEP-DEC'])){ echo 'checked';}?>>
      <label for="level-16"> SEP-DEC</label><br></div>
      <p class="inline_block"> <span style=" background-color: bisque; border: 1px solid black;">Year:</span><?php echo $_SESSION['fsem_year'];?></p>       
     </div>
    </td>
   </table>
   <table>
    <tr>
     <td class="w-100">Current level of study</td>
     <td>
      <div class="radio-input  clos level-of-study flex-wrap">
       <div class="ilb"><input type="radio" name="clos" id="1.10" value="1.1"<?php if(isset( $_SESSION['1.10'])){ echo 'checked';}?>>
       <label for="level-17">1.1</label><br></div>
       <div class="ilb"><input type="radio" name="clos" id="1.20" value="1.2"<?php if(isset( $_SESSION['1.20'])){ echo 'checked';}?>>
       <label for="level-21">1.2</label><br></div>  
       <div class="ilb"><input type="radio" name="clos" id="2.10" value="2.1"<?php if(isset( $_SESSION['2.10'])){ echo 'checked';}?>>
       <label for="level-18">2.1</label><br></div>
       <div class="ilb"><input type="radio" name="clos" id="2.20" value="1.2"<?php if(isset( $_SESSION['2.20'])){ echo 'checked';}?>>
       <label for="level-21">2.2</label><br></div>   
       <div class="ilb"><input type="radio" name="clos" id="3.10" value="3.1"<?php if(isset( $_SESSION['3.10'])){ echo 'checked';}?>>
       <label for="level-19"> 3.1</label><br></div>
       <div class="ilb"><input type="radio" name="clos" id="1.20" value="3.2"<?php if(isset( $_SESSION['3.20'])){ echo 'checked';}?>>
       <label for="level-21">3.2</label><br></div>
       <div class="ilb"><input type="radio" name="clos" id="4.10" value="4.1"<?php if(isset( $_SESSION['4.10'])){ echo 'checked';}?>>
       <label for="level-20"> 4.1</label><br></div>
       <div class="ilb"><input type="radio" name="clos" id="4.20" value="4.2" <?php if(isset( $_SESSION['4.20'])){ echo 'checked';}?>>
       <label for="level-21">4.2</label><br></div>
       <p class="inline_block"><span style=" background-color: bisque; border: 1px solid black;">Certificate/Diploma: </span> <?php echo $_SESSION['clos_cer_dip'];?>  </p>
      </div>
     </td>
    </tr>
   </table>
   <table>
    <tr>
     <td class="w-100">Guardian Contacts<br><br>In case of emergency</td>
     <td>
      <div class="the-guardians inline_block"> 
       <div class="guardian1 specialization inline_block">
        <div class="guardian1-label flex">
         <label class="b-r-n" for="guardian1">Guardian 1</label>
        </div>
        <div class="guardian-1-input">
         <span class="g-1">Name:</span><input type="text" placeholder="guardian name"name="guardian1name" value="<?php  echo  $_SESSION['guardian1name'];?> "><br>
         <span class="g-1">Tel:</span><input type="text"  placeholder=" guardian number"name="guardian1tel" value="<?php  echo     $_SESSION['guardian1tel']; ?> "><br>
         <span class="g-1">Email:</span><input type="text"  placeholder=" guardian email"name="guardian1email" value="<?php  echo    $_SESSION['guardian1email']; ?>" ><br>
        </div>
       </div>
       <div class="guardian1 specialization inline_block ml">
        <div class="guardian1-label">
         <label class="b-r-n" for="guardian2">Guardian 2</label>
        </div>
        <div class="guardian-2-input">
         <span class="g-2">Name:</span><input type="text" placeholder="guardian name"name="guardian2name" value="<?php  echo     $_SESSION['guardian2name'];?>" ><br>
         <span class="g-2">Tel:</span><input type="text"  placeholder=" guardian number"name="guardian2tel"value="<?php  echo   $_SESSION['guardian2tel'];?>"><br>
         <span class="g-2">Email:</span><input type="text"  placeholder=" guardian email"name="guardian2email"value="<?php  echo  $_SESSION['guardian2email']; ?>"><br>
        </div>
       </div>
      </div>
     </td>
    </tr>
   </table>
   <table>
    <tr>
     <td class="w-100"> Academic Audit</td>
     <td>
      <div class="courses-completed-so-far"> 
       <span>Courses Completed so far:</span><input type="text" name="courses-completed-so-far"value="<?php echo $_SESSION['courses_completed_so_far'];?>"><br>
       <span>New courses registered this semester:</span><input type="text" name="new-courses-registered" value="<?php echo $_SESSION['new_courses_registered'];?>">
       <span>Academic Advisor:</span><input type="text" name="academic_advisor"value="<?php echo $_SESSION['academic_advisor'];?>"><br></div>
      </div>
     </td>
    </tr>
   </table>
   <table>
    <tr>
     <td class="w-100">Commision for University Education (CUE) Data Validation Information</label><br><sub>(To be completed as per your National Id card )</sub></td>
     <td>
      <div class="cue-data">
       <span>National ID Number:</span><input type="text"name="id-number" value="<?php echo $_SESSION['id_number'];?>"><br>
       <span>Full name:</span><input type="text" name="id-full-name" value="<?php echo $_SESSION['id_full_name'];?>"><br>
       <span>Date of Birth:</span><input type="text" name="id-dob"  value=" <?php echo $_SESSION['id_dob'];?>"><br>
       <span>Gender</span><input type="text"name="id-gender" value="<?php echo $_SESSION['id_gender'];?>"><br>
       <span>District Of Birth</span><input type="text"name="id-district-of-birth" value=" <?php  echo   $_SESSION['id_district_of_birth'];?> "   ><br>
       <span>District</span><input type="text"name="id-district"  value=" <?php  echo   $_SESSION['id_district']; ?> "  ><br>
       <span>Location</span><input type="text"name="id-location"  value=" <?php  echo $_SESSION['id_location']; ?> "  ><br>
       <span>Place of issue</span><input type="text"name="id-poi"value=" <?php  echo $_SESSION['id_poi']; ?> "   ><br>
       <span>Division</span><input type="text"name="id-division"value=" <?php  echo $_SESSION['id_division']; ?> "   ><br>
       <span>Sub Location</span><input type="text"name="id-sub-location"value=" <?php  echo $_SESSION['id_sub_location']; ?> "   ><br>
      </div>
     </td>
    </tr>
   </table>
   <table>
    <tr>
     <td class="w-100">Student Medical Clearance</td>
     <td>
      <div class="nhif-med">
       <div class="nhif-details">
        <p class="nhif-mem">NHIF MEMBERSHIP</p><br>
        <div class="membership-details inline_block">
         <div class="nhif-name inline_block">
          <div class="radio-input clos flex ">
            <span class="nhif">NHIF Member Name:</span>
            <input type="radio" name="nhif-member-name" id="Self" value="Self" <?php  if(isset( $_SESSION['Self'])){ echo 'checked';}?>>
            <label for="level-23">Self</label><br>
            <input type="radio" name="nhif-member-name" id="Guardian" value="Guardian"<?php  if(isset( $_SESSION['Guardian'])){ echo 'checked';}?>>
            <label for="level-24">Guardian</label><br>
           </div>
          </div>
          <div class="nhif-valid inline_block">
           <div class="radio-input clos flex ">
            <span class="nhif">Is card valid ?</span>
            <input type="radio" name="nhif-valid" id="yes" value="yes"<?php  if(isset( $_SESSION['yes'])){ echo 'checked';}?>>
            <label for="level-25">yes</label><br>
            <input type="radio" name="nhif-valid" id="none" value="no"<?php  if(isset( $_SESSION['none'])){ echo 'checked';}?>>
            <label for="level-26">no</label>
           </div>
          </div>
        </div>
      </div>
      <div class="medical-conditions">
       <div class="medical-label">
        <span class="medical-span">Do you have any <span class="b">medical conditions</span>to declare to the university</span><br><sub>(if yes, please indicate)</sub>
       </div>
       <div class="radio-input clos ">
        <div class="inline_block">
         <input type="radio" name="medical-condition" id="condition_1" value="condition_1"<?php if(isset( $_SESSION['condition_1'])){ echo 'checked';}?>>
         <label for="level-27">yes</label></div> 
         <div class="inline_block">
         <input type="radio" name="medical-condition" id="condition_0" value="condition_0"<?php if(isset( $_SESSION['condition_0'])){ echo 'checked';}?>>
         <label for="level-28">no</label><br></div> 
         <div class="inline_block"><textarea name="medical_condition_declared" cols="30" rows="10" placeholder="Indicate medical condition"><?php echo $_SESSION['medical_condition_declared'];?></textarea></div>
        </div>
       </div>
      </div>
     </td>
    </tr>
   </table>
   <div class="new-course-reg">
    <table>
     <caption>New Course Registration</caption>
     <tr>
      <th>S/N</th>
      <th>Course Code</th>
      <th style="width: 300px;">Course Title</th>
     </tr>
     <tr>
      <td>1</td>
      <td><?php echo $_SESSION['course_1'];?></td>
      <td><?php echo $_SESSION['course_1_title'];?></td>
     </tr>
     <tr>
      <td>2</td>
      <td><?php echo $_SESSION['course_2'];?></td>
      <td><?php echo $_SESSION['course_2_title'];?></td>
     </tr>
     <tr>
      <td>3</td>
      <td><?php echo $_SESSION['course_3'];?></td>
      <td><?php echo $_SESSION['course_3_title'];?></td>
     </tr>
     <tr>
      <td>4</td>
      <td><?php echo $_SESSION['course_4'];?></td>
      <td><?php echo $_SESSION['course_4_title']; ?></td>
     </tr>
     <tr>
      <td>5</td>
      <td><?php echo $_SESSION['course_5'];?></td>
      <td><?php echo $_SESSION['course_5_title']; ?></td>
     </tr>
     <tr>
      <td>6</td>
      <td><?php echo $_SESSION['course_6'];?></td>
      <td><?php echo $_SESSION['course_6_title'];?></td>
     </tr>
     <tr>
      <td>7</td>
      <td><?php echo $_SESSION['course_7'];?></td>
      <td><?php echo $_SESSION['course_7_title'];?></td>
     </tr>
     <tr>
      <td>8</td>
      <td><?php echo $_SESSION['course_8'];?></td>
      <td><?php echo $_SESSION['course_8_title'];?></td>
     </tr>
    </table>
    <table class="professional-courses">
     <caption>Professional Course Registration</caption>
     <tr>
      <th>S/N</th>
      <th>Course Code</th>
      <th style="width: 300px;">Course Title</th>
     </tr>
     <tr>
      <td>1</td>
      <td><?php echo $_SESSION['professional_1'];?></td>
      <td><?php echo $_SESSION['professional_1_title'];?></td>
     </tr>
     <tr>
     <td>2</td>
     <td><?php echo $_SESSION['professional_2'];?></td>
     <td><?php echo $_SESSION['professional_2_title']; ?> </td>
    </tr>
    <tr>
     <td>3</td>
     <td><?php echo $_SESSION['professional_3'];?></td>
     <td><?php echo $_SESSION['professional_3_title'];?></td>
    </tr>
    <tr>
     <td>4</td>
     <td><?php echo $_SESSION['professional_4'];?></td>
     <td><?php echo $_SESSION['professional_4_title'];?></td>
    </tr>
    <tr>
     <td>5</td>
     <td><?php echo $_SESSION['professional_5'];?></td>
     <td><?php echo $_SESSION['professional_5_title'];?></td>
    </tr>
  </table>
  <p>Cleared to register by finance on <?php echo $financeapproval;?></p>
  <br>
  <p>Cleared to register by the Registrar on <?php echo $registrarapproval;?></p>
  </div>
 </form>
 </div>
</body>
</html>