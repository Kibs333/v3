<?php
@require_once '../session_security.php';
if(isset($_SESSION['student_id']) && $_SESSION['allowed']== 1 &&  $_SESSION['register-token']==true ){@require_once 'registration-handler.php';}else{header('location:../portal.php');}?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="resources/css/register.css">
 <script src="resources/js/registration.js"></script>
 <title>Semester Registration</title>
 
     <link rel="stylesheet" href="resources/css/finance.css">
    <link rel="icon" type="image/png" sizes="192x192" href="resources/img/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="resources/img/android-chrome-512x512.png">
    <link rel="apple-touch-icon" sizes="180x180" href="resources/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="resources/img/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="resources/img/favicon-32x32.png">
    <link rel="icon" href="resources/img/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="resources/img/site.webmanifest">
</head>
<body>
 <div class="info">
  <p>Pioneer International University</p>
  <p>Semester Registration</p>
  <p>Piu/AAR/REG/003</p>
 </div>
 <div class="piu">
  <div class="logo"><img src="resources/img/cropped-PIU-ICON-512x512-2-1-192x192.png" alt="pioneer international university"></div>
  <div class="logo-text"><p>Pioneer international university</p></div>
 </div>
 <div class="formh1">
 <h1>Semester Registration Form</h1>
 <sub class="reg-sub">This form<span class="b"> must </span>be duly completed at the start of every new semester and returned to respective H.O.D's</sub> 
 </div>  
 <form  method="post">
  <div class="main-form">
   <div class="input-container">
    <label for="student-first-name">Student name</label>
    <input type="text" id="student-first-name" name="student-first_name" placeholder="first Name">
    <span>/</span>
    <input type="text" id="middle-name" name="student-second_name" class="input-box ml-unset" placeholder="Middle Name"  >
    <span>/</span> 
    <input type="text" id="last-name" name="student-last_name" class="input-box ml-unset" placeholder="Surname"  >
    </div>
    <div class="input-container">
     <label for="course">Student Adm</label>
     <input class="select" id="course" name="course-admno" class="input-box" value="<?php echo $_SESSION['std-db-course'];?>" readonly selected>
      <!-- ask for more course options here -->
      </select>
      <span>/</span>
      <input type="number" id="idno" name="adm-idno" class="input-box ml-unset" value="<?php echo $_SESSION['std-db-id'];?>" placeholder="Adm No"readonly  >
      <span>/</span>
      <input type="number" id="year" name="adm-year" class="input-box ml-unset" value="<?php echo $_SESSION['std-db-year'];?>" placeholder="Year" readonly ><br>
      <input type="hidden" id="combinedData" name="combined-adm-Data" value=""></div>
      <div class="input-container">
       <label for="email">School Email</label>
       <input type="email" id="email" name="school-email" class="input"value="<?php echo $_SESSION['email'];?>" placeholder="Example: name.lastname@students.piu.ac.ke" readonly><br>
      </div>
      <div class="input-container">
       <label for="tel1">Student Numbers</label>     
       <input type="number" id="tel1" name="student-tel" placeholder="telephone 1" ><span>/</span>
       <input class="ml-unset"type="number" id="tel-2" name="student-tel-2"placeholder="telephone 2"><br>
      </div>
     </div>
     <div class="radioForm">
      <div class="radio-label flex br"><label  class="b-r-n"for="school">SCHOOL</label><br></div>
       <div id="school" class="radio-input">
       <?php
            switch ($dataDetails['school']) {
                case 'SBM':
                    echo '<input type="radio" name="school" id="school-1" value="SBM" checked>
                          <label for="school-1">SCHOOL OF BUSINESS & MANAGEMENT (SBM)</label><br>';
                    break;
                case 'SICT':
                    echo '<input type="radio" name="school" id="school-2" value="SICT" checked>
                          <label for="school-2">SCHOOL OF INFORMATION & COMMUNICATION TECHNOLOGY (SICT)</label><br>';
                    break;
                case 'SDSS':
                    echo '
                    <input type="radio" name="school" id="school-3" value="SDSS" checked>
        <label for="school-3">SCHOOL OF DEVELOPMENT & STRATEGIC STUDIES (SDSS)</label><br>';
                    break;
                case 'SEDU':
                    echo '
                    <input type="radio" name="school" id="school-4" value="SEDU" checked>
                    <label for="school-4">SCHOOL OF EDUCATION (SEDU)</label><br>';
                    break;
                case 'SAMS':
                    echo '
                    <input type="radio" name="school" id="school-5" value="SAMS"checked>
                    <label for="school-5">SCHOOL OF AEROSPACE & MARITIME STUDIES (SAMS)</label><br>';
                    break;
                default:
                    //echo 'Unknown School';
            }
            ?>

       </div>
      </div>
      <div class="level radioForm ">
       <div class="flex br"><label class="b-r-n" for="leve-of-study">Level Of Study</label><br></div>
       <div id="leve-of-study" class="radio-input flex level-of-study">

       <?php
            switch ($dataDetails['level_of_study']) {
                case 'Certificate':
                    echo '<input class="" type="radio" name="level" id="level-1" value="certificate"checked>
                          <label for="level-1">Certificate</label><br>';
                    break;
                case 'Diploma':
                    echo '        <input type="radio" name="level" id="level-2" value="diploma"checked>
                    <label for="level-2">Diploma</label><br>';
                    break;
                case 'Degree':
                    echo '
                    <input type="radio" name="level" id="level-3" value="degree"checked>
                    <label for="level-3">Degree</label><br>';
                    break;
                case 'Masters':
                    echo '
                    <input type="radio" name="level" id="level-4" value="masters"checked>
                    <label for="level-4">Masters</label><br>';
                    break;
                default:
                    //echo 'Unknown School';
            }
            ?>




       </div>
      </div>
      <div class="programme">
       <div class=" flex br"><label class="b-r-n" for="leve-of-study">Programme</label><br></div>
       <div id="programme"class="radio-input flex-wrap prog-input">


       <?php



switch ($dataDetails['programme']) {
    case 'DIT':

        echo '
        <input type="radio" name="prog" id="DIT" value="DIT" checked>
        <label for="DIT">DIT </label><br>
        ';
        break;

    case 'DPGM':

        echo '
        <input type="radio" name="prog" id="DPGM" value="DPGM" checked>
        <label for="DPGM">DPGM </label><br>';
        break;

    case 'DBIT':
      echo '
      <input type="radio" name="prog" id="DBIT" value="DBIT" checked>
      <label for="DBIT">DBIT </label><br>';
        break;

    case 'BCOM':
      echo '
      <input type="radio" name="prog" id="BCOM" value="BCOM" checked>
      <label for="BCOM">BCOM </label><br>';
        break;

    case 'BA-IR':
      echo '
      <input type="radio" name="prog" id="DPGBA-IRM" value="BA-IR" checked>
      <label for="BA-IR">BA-IR </label><br>';
        break;

    case 'DIR':
      echo '
      <input type="radio" name="prog" id="DIR" value="DIR" checked>
      <label for="DIR">DIR </label><br>';
        break;

    case 'DMTL':
      echo '
      <input type="radio" name="prog" id="DMTL" value="DMTL" checked>
      <label for="DMTL">DMTL </label><br>';
        break;

    case 'DSWCD':
      echo '
      <input type="radio" name="prog" id="DSWCD" value="DSWCD" checked>
      <label for="DSWCD">DSWCD </label><br>';
        break;

    case 'DAM':
      echo '
      <input type="radio" name="prog" id="DAM" value="DAM" checked>
      <label for="DAM">DAM </label><br>';
        break;

    case 'BSIT':
      echo '
      <input type="radio" name="prog" id="BSIT" value="BSIT" checked>
      <label for="BSIT">BSIT </label><br>';
        break;

    case 'BED-A':
      echo '
      <input type="radio" name="prog" id="BED-A" value="BED-A" checked>
      <label for="BED-A">BED-A </label><br>';
        break;

    default:
        // Code to execute if none of the cases match
        echo 'Unknown Program';
}
?>


       <!-- <input type="radio" name="prog" id="DIT" value="DIT">
       <label for="DIT">DIT </label><br>
       <input type="radio" name="prog" id="DPGM" value="DPGM">
       <label for="DPGM">DPGM</label><br>
       <input type="radio" name="prog" id="DBIT" value="DBIT">
       <label for="DBIT">DBIT</label><br>
       <input type="radio" name="prog" id="BCOM" value="BCOM">
       <label for="BCOM">BCOM</label><br>
       <input type="radio" name="prog" id="BA-IR" value="BA-IR">
       <label for="BA-IR">BA-IR </label><br>
       <input type="radio" name="prog" id="DIR" value="DIR">
       <label for="DIR">DIR</label><br>
       <input type="radio" name="prog" id="DMTL" value="DMTL">
       <label for="DMTL">DMTL</label><br>
       <input type="radio" name="prog" id="DSWCD" value="DSWCD">
       <label for="DSWCD">DSWCD</label><br>
       <input type="radio" name="prog" id="DAM" value="DAAM">
       <label for="DAM">DAM</label><br>
       <input type="radio" name="prog" id="BSIT" value="BSIT">
       <label for="BSIT">BSIT</label><br>
       <input type="radio" name="prog" id="BED-A" value="BED-A">
       <label for="BED-A">BED-A</label> -->
      </div>
     </div> 
     <div class="specialization">
     <label for="specialization">Specialization</label>
     <input type="text" name="specialization" placeholder="What are you specializing in? " id="specialization">
    </div>
    <div class="first-sem specialization">
     <div class="flex br"><label  class="b-r-n" >First Sem At PIU</label><br></div>
     <div class="radio-input flex level-of-study">
     <input type="radio" name="fsem" id="level-14" value="JAN-APR">
     <label for="level-14">JAN-APR</label><br>
     <input type="radio" name="fsem" id="level-15" value="MAY-AUG">
     <label for="level-15">MAY-AUG</label><br>
     <input type="radio" name="fsem" id="level-16" value="SEP-DEC">
     <label for="level-16">SEP-DEC</label><br>
     <div class="year" style="border:2px solid black;">
      <label for="fsem_year" style=" background-color: bisque; border: 1px solid black;">Year:</label>
      <input style="margin:0;" type="number" placeholder="Year:eg 2021" name="fsem_year" id=" "> 
     </div>
    </div>
   </div>
   <div class="current-level-of-study specialization">
    <div class="flex br"><label  class="b-r-n" >Current level of study</label><br></div>
    <div class="radio-input  clos flex level-of-study flex-wrap">
     <input type="radio" name="clos" id="clos1.1" value="1.1">
      <label for="clos1.1">1.1</label><br>
      <input type="radio" name="clos" id="clos1.2" value="1.2">
      <label for="clos1.2">1.2</label><br>
      <input type="radio" name="clos" id="clos2.1" value="2.1">
      <label for="clos2.1">2.1</label><br>
      <input type="radio" name="clos" id="clos2.2" value="2.2">
      <label for="clos2.2">2.2</label><br>
      <input type="radio" name="clos" id="clos3.1" value="3.1">
      <label for="clos3.1">3.1</label><br>
      <input type="radio" name="clos" id="clos3.2" value="3.2">
      <label for="clos3.2">3.2</label><br>
      <input type="radio" name="clos" id="clos4.1" value="4.1">
      <label for="clos4.1">4.1</label><br>
      <input type="radio" name="clos" id="clos4.2" value="4.2">
      <label for="clos4.2">4.2</label><br>
      <div class="cer_dip" style="display: inline-flex;padding: 10px;">
       <p  style=" background-color: bisque; border: 1px solid black;">Certificate/Diploma:</p>
       <input  placeholder="semester of study" type="number" name="clos_cer_dip" id="">
      </div>
     </div>
    </div>
    <div class="guardian specialization">
     <div class="guardian-label flex br"><label  class="b-r-n" for="guardian">Guardian Contacts <!--<sub>in case of emergency</sub> --></label></div>
     <div class="the-guardians"> 
      <div class="guardian1 specialization">
       <div class="guardian1-label flex br"><label  class="b-r-n" for="guardian1">Guardian 1 </label></div>
       <div class="guardian-1-input">
        <span class="g-1">Name:</span><input type="text"id="guardian-1-input-name" placeholder="guardian name"name="guardian1name"  ><br>
        <span class="g-1">Tel:</span><input type="number"id="guardian-1-input-tel"  placeholder=" guardian number"name="guardian1tel"  ><br>
        <span class="g-1">Email:</span><input type="email"id="guardian-1-input-email"   placeholder=" guardian email"name="guardian1email"  ><br>
       </div>
      </div>
      <div class="guardian1 specialization">
       <div class="guardian1-label flex br"><label  class="b-r-n" for="guardian2">Guardian 2</label></div>
       <div class="guardian-2-input">
       <span class="g-2">Name:</span><input type="text"id="guardian-2-input-name"  placeholder="guardian name"name="guardian2name"><br>
       <span class="g-2">Tel:</span><input type="number"id="guardian-2-input-tel"   placeholder=" guardian number"name="guardian2tel"><br>
       <span class="g-2">Email:</span><input type="email"id="guardian-2-input-email"   placeholder=" guardian email"name="guardian2email"><br>
      </div>
     </div>
    </div>
   </div>
   <div class="academic-audit specialization">
    <div class="academic-audit-label flex br"><label class="b-r-n"for="academic-audit">Academic Audit</label></div>
    <div class="courses-completed-so-far">
     <span>Courses Completed so far:</span><input type="number" name="courses-completed-so-far"id="courses-completed-so-far"><br>
     <span>New courses registered this semester:</span><input type="number" name="new-courses-registered"id="new-courses-registered">
     <div class="courses-completed-so-far flex">
      <span style="width:unset;">Academic Advisor:</span><input type="text" name="academic_advisor"id="academic_advisor"  placeholder="please check with your H.O.D" ><br>
     </div>
    </div>
   </div>
   <div class="cue specialization">
    <div class="cue-label flex br"><label  class="b-r-n" for="cue">Commision for University Education (CUE) Data Validation Information</label><br><sub>(To be completed as per your National Id card )</sub></div>
    <div class="cue-data">
     <span>National ID Number:</span><input type="number"name="id-number"  ><br>
     <span>Full name:</span><input type="text" name="id-full-name" ><br>
     <span>Date of Birth:</span><input type="date" name="id-dob" ><br>
     <span>Gender</span><input type="text"name="id-gender" ><br>
     <span>District Of Birth</span><input type="text"name="id-district-of-birth" ><br>
     <span>District</span><input type="text"name="id-district" ><br>
     <span>Location</span><input type="text"name="id-location" ><br>
     <span>Place of issue</span><input type="text"name="id-poi" ><br>
     <span>Division</span><input type="text"name="id-division" ><br>
     <span>Sub Location</span><input type="text"name="id-sub-location" ><br>
    </div>
   </div>
   <div class="student-med specialization">
    <div class="sudent-med-label flex br">
     <label for="student-medical" class="b-r-n">Student Medical Clearance</label></div>
     <div class="nhif-med">
      <div class="nhif-details">
       <p class="nhif-mem">NHIF MEMBERSHIP</p><br>
       <div class="membership-details">
        <div class="nhif-name">
         <div class="radio-input clos flex level-of-study flex-wrap mb-30">
          <span class="nhif">NHIF Member Name:</span> 
          <input type="radio" name="nhif-member-name" id="level-23" value="Self">
          <label for="level-23">Self</label><br>
          <input type="radio" name="nhif-member-name" id="level-24" value="Guardian">
          <label for="level-24">Guardian</label><br>
         </div>
        </div>
        <div class="nhif-valid"> 
         <div class="radio-input clos flex level-of-study flex-wrap">
          <span class="nhif">Is card valid ?</span> 
          <input type="radio" name="nhif-valid" id="level-25" value="yes">
          <label for="level-25">yes</label><br>
          <input type="radio" name="nhif-valid" id="level-26" value="no">
         <label for="level-26">no</label><br>
        </div>
       </div>
      </div>
     </div>
     <div class="medical-conditions">
      <div class="medical-label mb-30"><span class="medical-span">Do you have any <span class="b">medical conditions</span> to declare to the university</span><br><sub>(if yes, please indicate)</sub></div>
       <div class="radio-input clos flex level-of-study flex-wrap">
        <input type="radio" name="medical-condition" id="level-27" value="condition_1">
        <label for="level-27">yes</label><br>
        <input type="radio" name="medical-condition" id="level-28" value="condition_0">
        <label for="level-28">no</label><br>
        <textarea name="medical_condition_declared" id="" cols="30" rows="10" placeholder="Indicate medical condition"></textarea>
       </div>
      </div>
     </div>
    </div>
    <div class="new-course-reg">
    <table>
     <caption>New Course Registration</caption>
     <tr>  
      <th>S/N </th>
      <th>Course Code</th>
      <th style="width: 300px;">Course Title</th>
     </tr>
     <tr> 
      <td>1</td>
      <td><input type="text" name="course-1" placeholder="course code" ></td>
      <td><input type="text" name="course-1-title" placeholder="course title"></td>
     </tr>
     <tr> 
      <td>2</td>
      <td><input type="text" name="course-2" placeholder="course code" ></td>
      <td><input type="text" name="course-2-title" placeholder="course title"></td>
     </tr>
     <tr> 
      <td>3</td>
      <td><input type="text" name="course-3" placeholder="course code"></td>
      <td><input type="text" name="course-3-title" placeholder="course title"></td>
    </tr>
    <tr> 
     <td>4</td>
     <td><input type="text" name="course-4" placeholder="course code"></td>
     <td><input type="text" name="course-4-title" placeholder="course title"></td>
    </tr>
    <tr> 
     <td>5</td>
     <td><input type="text" name="course-5" placeholder="course code"></td>
     <td><input type="text" name="course-5-title" placeholder="course title"></td>
    </tr>
    <tr> 
     <td>6</td>
     <td><input type="text" name="course-6" placeholder="course code"></td>
     <td><input type="text" name="course-6-title" placeholder="course title"></td>
    </tr>
    <tr> 
     <td>7</td>
     <td><input type="text" name="course-7" placeholder="course code"></td>
     <td><input type="text" name="course-7-title" placeholder="course title"></td>
    </tr>
    <tr> 
     <td>8</td>
     <td><input type="text" name="course-8" placeholder="course code"></td>
     <td><input type="text" name="course-8-title" placeholder="course title"></td>
    </tr>
   </table>
   <table class="proffessional-courses" >
    <caption>Professional Course Registration</caption>
    <tr>  
     <th>S/N </th>
     <th>Course Code</th>
     <th style="width: 300px;">Course Title</th>
    </tr>
    <tr> 
     <td>1</td>
     <td><input type="text" name="professional-1" placeholder="course code" ></td>
     <td><input type="text" name="professional-1-title" placeholder="course title"></td>
    </tr>
    <tr> 
     <td>2</td>
     <td><input type="text" name="professional-2" placeholder="course code" ></td>
     <td><input type="text" name="professional-2-title" placeholder="course title"></td>
    </tr>
    <tr> 
     <td>3</td>
     <td><input type="text" name="professional-3" placeholder="course code"></td>
     <td><input type="text" name="professional-3-title" placeholder="course title"></td>
    </tr>
    <tr> 
     <td>4</td>
     <td><input type="text" name="professional-4" placeholder="course code"></td>
     <td><input type="text" name="professional-4-title" placeholder="course title"></td>
    </tr>
    <tr> 
     <td>5</td>
     <td><input type="text" name="professional-5" placeholder="course code"></td>
     <td><input type="text" name="professional-5-title" placeholder="course title"></td>
    </tr>
   </table>
  </div>
  <p>Cleared to register by finance on  <?php echo $financeapproval;?></p>
  <div class="submit-button"><button id="submit-btn" type="submit" name="submit-ref-form">Complete Registration</button></div>
  </form>
</body>
</html>