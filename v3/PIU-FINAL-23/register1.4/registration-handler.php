<?php
@require_once '../session_security.php';
@require_once '../config.php';

$Query = "SELECT student_id  FROM piu_registration_form_data WHERE  student_id = ?  ";
$stmt = $pdo->prepare($Query);
$stmt->bindParam(1, $_SESSION['student_id']);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);
if($data)
{
echo '<script>
            alert("Registartion form already filled.Pioneer International University.Powered by Intellect Driven by Values.");
            setTimeout(function() {window.location.href = "../portal.php";}, 100); 
        </script>';
}else{

    $Query = "SELECT cleared_to_register_on FROM finance_form WHERE  student_id = ?  ";
    $stmt = $pdo->prepare($Query);
    $stmt->bindParam(1, $_SESSION['student_id']);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if($data){
    $financeapproval=$data['cleared_to_register_on'];
    }else{echo 'none';}









    $getDetails="SELECT * FROM students_form WHERE id=?";
    
    $stmt=$pdo->prepare($getDetails);
    $stmt->bindParam(1, $_SESSION['student_id']);
    
    if($stmt->execute()){
        $dataDetails = $stmt->fetch(PDO::FETCH_ASSOC);





        if($dataDetails){



        }
    
    }







if(isset($_POST['submit-ref-form'])){
$values=[ $student_first_name = htmlspecialchars($_POST['student-first_name']),
    $student_second_name = htmlspecialchars($_POST['student-second_name']),
    $student_last_name = htmlspecialchars($_POST['student-last_name']),
    $course_admno = htmlspecialchars($_POST['course-admno']),
    $adm_idno = htmlspecialchars($_POST['adm-idno']),
    $adm_year = htmlspecialchars($_POST['adm-year']),
    $combined_adm_data = htmlspecialchars($_POST['combined-adm-Data']),
    $school_email = htmlspecialchars($_POST['school-email']),
    $student_tel = htmlspecialchars($_POST['student-tel']),
    $student_tel_2 = htmlspecialchars($_POST['student-tel-2']),
    $school = htmlspecialchars($_POST['school']),
    $level = htmlspecialchars($_POST['level']),
    $prog = htmlspecialchars($_POST['prog']),
    $specialization = htmlspecialchars($_POST['specialization']),
    $fsem = htmlspecialchars($_POST['fsem']),
    $fsem_year = htmlspecialchars($_POST['fsem_year']),
    $clos = htmlspecialchars($_POST['clos']),
    $clos_cer_dip= htmlspecialchars($_POST['clos_cer_dip']),
    $guardian1name = htmlspecialchars($_POST['guardian1name']),
    $guardian1tel = htmlspecialchars($_POST['guardian1tel']),
    $guardian1email = htmlspecialchars($_POST['guardian1email']),
    $guardian2name = htmlspecialchars($_POST['guardian2name']),
    $guardian2tel = htmlspecialchars($_POST['guardian2tel']),
    $guardian2email = htmlspecialchars($_POST['guardian2email']),
    $courses_completed_so_far = htmlspecialchars($_POST['courses-completed-so-far']),
    $new_courses_registered = htmlspecialchars($_POST['new-courses-registered']),
    $academic_advisor= htmlspecialchars($_POST['academic_advisor']),
    $id_number = htmlspecialchars($_POST['id-number']),
    $id_full_name = htmlspecialchars($_POST['id-full-name']),
    $id_dob = htmlspecialchars($_POST['id-dob']),
    $id_gender = htmlspecialchars($_POST['id-gender']),
    $id_district_of_birth = htmlspecialchars($_POST['id-district-of-birth']),
    $id_district = htmlspecialchars($_POST['id-district']),
    $id_location = htmlspecialchars($_POST['id-location']),
    $id_poi= htmlspecialchars($_POST['id-poi']),
    $id_division= htmlspecialchars($_POST['id-division']),
    $id_sub_location= htmlspecialchars($_POST['id-sub-location']),
    $nhif_member_name = htmlspecialchars($_POST['nhif-member-name']),
    $nhif_valid = htmlspecialchars($_POST['nhif-valid']),
    $medical_condition = htmlspecialchars($_POST['medical-condition']),
    $medical_condition_declared = htmlspecialchars($_POST['medical_condition_declared'])];

//  function compareProgSchool($prog, $school) {
//     // Define the programs for each school
//     $SBM = ['BCOM'];
//     $SICT = ['BSIT', 'DBIT', 'DIT'];
//     $SDSS = ['BA-IR', 'DIR'];
//     $SEDU = ['BED-A'];
//     $SAMS = []; // Assuming SAMS is not specified in the original code
    
//     // Check which school the program belongs to
//     switch ($school) {
//         case 'SBM':
//             return in_array($prog, $SBM);
//         case 'SICT':
//             return in_array($prog, $SICT);
//         case 'SDSS':
//             return in_array($prog, $SDSS);
//         case 'SEDU':
//             return in_array($prog, $SEDU);
//         case 'SAMS':
//             return in_array($prog, $SAMS);
//         default:
//             // Handle the case where an unknown school is provided
//             return false;
//     }
// }

// // Example usage:
// $progToCheck = 'A';
// $schoolToCheck = 'SAMS';

// if (compareProgSchool($progToCheck, $schoolToCheck)) {
//     echo "$progToCheck belongs to $schoolToCheck";
// } else {
//     echo "$progToCheck does not belong to $schoolToCheck";
// }

    $student_first_name = htmlspecialchars($_POST['student-first_name']);
    $student_second_name = htmlspecialchars($_POST['student-second_name']);
    $student_last_name = htmlspecialchars($_POST['student-last_name']);
    $course_admno = htmlspecialchars($_POST['course-admno']);
    $adm_idno = htmlspecialchars($_POST['adm-idno']);
    $adm_year = htmlspecialchars($_POST['adm-year']);
    $combined_adm_data = htmlspecialchars($_POST['combined-adm-Data']);
    $school_email = htmlspecialchars($_POST['school-email']);
    $student_tel = htmlspecialchars($_POST['student-tel']);
    $student_tel_2 = htmlspecialchars($_POST['student-tel-2']);
    $school = htmlspecialchars($_POST['school']);
    $level = htmlspecialchars($_POST['level']);
    $prog = htmlspecialchars($_POST['prog']);
    $specialization = htmlspecialchars($_POST['specialization']);
    $fsem = htmlspecialchars($_POST['fsem']);
    $fsem_year = htmlspecialchars($_POST['fsem_year']);
    $clos = htmlspecialchars($_POST['clos']);
    $clos_cer_dip= htmlspecialchars($_POST['clos_cer_dip']);
    $guardian1name = htmlspecialchars($_POST['guardian1name']);
    $guardian1tel = htmlspecialchars($_POST['guardian1tel']);
    $guardian1email = htmlspecialchars($_POST['guardian1email']);
    $guardian2name = htmlspecialchars($_POST['guardian2name']);
    $guardian2tel = htmlspecialchars($_POST['guardian2tel']);
    $guardian2email = htmlspecialchars($_POST['guardian2email']);
    $courses_completed_so_far = htmlspecialchars($_POST['courses-completed-so-far']);
    $new_courses_registered = htmlspecialchars($_POST['new-courses-registered']);
    $academic_advisor= htmlspecialchars($_POST['academic_advisor']);
    $id_number = htmlspecialchars($_POST['id-number']);
    $id_full_name = htmlspecialchars($_POST['id-full-name']);
    $id_dob = htmlspecialchars($_POST['id-dob']);
    $id_gender = htmlspecialchars($_POST['id-gender']);
    $id_district_of_birth = htmlspecialchars($_POST['id-district-of-birth']);
    $id_district = htmlspecialchars($_POST['id-district']);
    $id_location = htmlspecialchars($_POST['id-location']);
    $id_poi= htmlspecialchars($_POST['id-poi']);
    $id_division= htmlspecialchars($_POST['id-division']);
    $id_sub_location= htmlspecialchars($_POST['id-sub-location']);
    $nhif_member_name = htmlspecialchars($_POST['nhif-member-name']);
    $nhif_valid = htmlspecialchars($_POST['nhif-valid']);
    $medical_condition = htmlspecialchars($_POST['medical-condition']);
    $medical_condition_declared = htmlspecialchars($_POST['medical_condition_declared']);
    $course_1 = htmlspecialchars($_POST['course-1']);
    $course_1_title = htmlspecialchars($_POST['course-1-title']);
    
    $course_2 = htmlspecialchars($_POST['course-2']);
    $course_2_title = htmlspecialchars($_POST['course-2-title']);
    
    $course_3 = htmlspecialchars($_POST['course-3']);
    $course_3_title = htmlspecialchars($_POST['course-3-title']);
    
    $course_4 = htmlspecialchars($_POST['course-4']);
    $course_4_title = htmlspecialchars($_POST['course-4-title']);
    
    $course_5 = htmlspecialchars($_POST['course-5']);
    $course_5_title = htmlspecialchars($_POST['course-5-title']);
    
    $course_6 = htmlspecialchars($_POST['course-6']);
    $course_6_title = htmlspecialchars($_POST['course-6-title']);
    
    $course_7 = htmlspecialchars($_POST['course-7']);
    $course_7_title = htmlspecialchars($_POST['course-7-title']);
    
    $course_8 = htmlspecialchars($_POST['course-8']);
    $course_8_title = htmlspecialchars($_POST['course-8-title']);
    
    $professional_1 = htmlspecialchars($_POST['professional-1']);
    $professional_1_title = htmlspecialchars($_POST['professional-1-title']);
    
    $professional_2 = htmlspecialchars($_POST['professional-2']);
    $professional_2_title = htmlspecialchars($_POST['professional-2-title']);
    
    $professional_3 = htmlspecialchars($_POST['professional-3']);
    $professional_3_title = htmlspecialchars($_POST['professional-3-title']);
    
    $professional_4 = htmlspecialchars($_POST['professional-4']);
    $professional_4_title = htmlspecialchars($_POST['professional-4-title']);
    
    $professional_5 = htmlspecialchars($_POST['professional-5']);
    $professional_5_title = htmlspecialchars($_POST['professional-5-title']);

// Check if any of the variables are blank
if (
 empty($student_first_name) ||
 empty($student_last_name) ||
 empty($course_admno) ||
 empty($adm_idno) ||
 empty($adm_year) ||
 empty($combined_adm_data) ||
 empty($school_email) ||
 empty($student_tel) ||
 empty($school) ||
 empty($level) ||
 empty($prog) ||
 empty($fsem) ||
 empty($fsem_year) ||
 empty($clos)||
 empty($courses_completed_so_far) ||
 empty($new_courses_registered) ||
 empty($id_number) ||
 empty($id_full_name) ||
 empty($id_dob) ||
 empty($id_gender) ||
 empty($id_district_of_birth) ||
 empty($id_district) ||
 empty($id_location) ||
 empty($nhif_member_name) ||
 empty($nhif_valid) || empty($medical_condition)) {
 echo '<script> alert("data is being  processed");</script>';
 echo '<script> alert("One or more fields are blank. Please fill in all the required fields.");window.history.back();</script>';
}
 else {
  // Define your SQL INSERT query
  $sql = "INSERT INTO piu_registration_form_data
   (student_first_name, student_second_name, student_last_name, course_admno, adm_idno, adm_year, combined_adm_data,school_email, student_tel, student_tel_2,school, level, prog, specialization, fsem,clos, guardian1name, guardian1tel, guardian1email, guardian2name,

   guardian2tel, guardian2email, courses_completed_so_far, new_courses_registered, id_number,id_full_name, id_dob, id_gender, id_district_of_birth, id_district,id_location, nhif_member_name, nhif_valid, medical_condition, course_1, course_1_title, course_2, course_2_title,course_3,course_3_title,

   course_4, course_4_title, course_5, course_5_title, course_6, course_6_title, course_7, course_7_title, course_8,course_8_title,professional_1, professional_1_title, professional_2, professional_2_title,professional_3, professional_3_title, professional_4, professional_4_title, professional_5,professional_5_title,

student_id,fsem_year ,academic_advisor,id_poi,id_division,id_sub_location,medical_condition_declared,clos_cer_dip)
  VALUES (?,?,?,?,?,? ,?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?,
   ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
   ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
    ?, ?, ?, ?, ?, ?, ?,?)";
  
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(1, $student_first_name);
  $stmt->bindParam(2, $student_second_name);
  $stmt->bindParam(3, $student_last_name);
  $stmt->bindParam(4, $course_admno);
  $stmt->bindParam(5, $adm_idno);
  $stmt->bindParam(6, $adm_year);
  $stmt->bindParam(7, $combined_adm_data);
  $stmt->bindParam(8, $school_email);
  $stmt->bindParam(9, $student_tel);
  $stmt->bindParam(10, $student_tel_2);
  $stmt->bindParam(11, $school);
  $stmt->bindParam(12, $level);
  $stmt->bindParam(13, $prog);
  $stmt->bindParam(14, $specialization);
  $stmt->bindParam(15, $fsem);
  $stmt->bindParam(16, $clos);
  $stmt->bindParam(17, $guardian1name);
  $stmt->bindParam(18, $guardian1tel);
  $stmt->bindParam(19, $guardian1email);
  $stmt->bindParam(20, $guardian2name);
  $stmt->bindParam(21, $guardian2tel);
  $stmt->bindParam(22, $guardian2email);
  $stmt->bindParam(23, $courses_completed_so_far);
  $stmt->bindParam(24, $new_courses_registered);
  $stmt->bindParam(25, $id_number);
  $stmt->bindParam(26, $id_full_name);
  $stmt->bindParam(27, $id_dob);
  $stmt->bindParam(28, $id_gender);
  $stmt->bindParam(29, $id_district_of_birth);
  $stmt->bindParam(30, $id_district);
  $stmt->bindParam(31, $id_location);
  $stmt->bindParam(32, $nhif_member_name);
  $stmt->bindParam(33, $nhif_valid);
  $stmt->bindParam(34, $medical_condition);
  $stmt->bindParam(35, $course_1);
  $stmt->bindParam(36, $course_1_title);
  $stmt->bindParam(37, $course_2);
  $stmt->bindParam(38, $course_2_title);
  $stmt->bindParam(39, $course_3);
  $stmt->bindParam(40, $course_3_title);
  $stmt->bindParam(41, $course_4);
  $stmt->bindParam(42, $course_4_title);
  $stmt->bindParam(43, $course_5);
  $stmt->bindParam(44, $course_5_title);
  $stmt->bindParam(45, $course_6);
  $stmt->bindParam(46, $course_6_title);
  $stmt->bindParam(47, $course_7);
  $stmt->bindParam(48, $course_7_title);
  $stmt->bindParam(49, $course_8);
  $stmt->bindParam(50, $course_8_title);
  $stmt->bindParam(51, $professional_1);
  $stmt->bindParam(52, $professional_1_title);
  $stmt->bindParam(53, $professional_2);
  $stmt->bindParam(54, $professional_2_title);
  $stmt->bindParam(55, $professional_3);
  $stmt->bindParam(56, $professional_3_title);
  $stmt->bindParam(57, $professional_4);
  $stmt->bindParam(58, $professional_4_title);
  $stmt->bindParam(59, $professional_5);
  $stmt->bindParam(60, $professional_5_title);
  $stmt->bindParam(61, $_SESSION['student_id']);
  $stmt->bindParam(62, $fsem_year);
  $stmt->bindParam(63, $academic_advisor);
  $stmt->bindParam(64, $id_poi);
  $stmt->bindParam(65, $id_division);
  $stmt->bindParam(66, $id_sub_location);
  $stmt->bindParam(67, $medical_condition_declared);
  $stmt->bindParam(68, $clos_cer_dip);

  if ($stmt->execute()) {
      $hasreg=1;
      $update="UPDATE students_form SET has_submitted_registration_form	=? WHERE id=?";
      $stmt = $pdo->prepare($update);
      $stmt->bindParam(1,$hasreg);
      $stmt->bindParam(2, $_SESSION['student_id']);  
      if($stmt->execute()){




        echo '<script>
        alert("This application has been submitted to the registrar and dean for review. Please revisit at a later time to ascertain the status of approval. We appreciate your cooperation.Pioneer International University. Powered by Intellect Driven by Values");
        setTimeout(function() {
        window.location.href = "../portal.php";
        }, 500); 
        </script>';

        $Insert="
        INSERT INTO `acc_details`( `student_id`, `nationalId`, `fullName`, `dob`, `Gender`, `districtOfBirth`, `district`, `location`, `placeOfIssue`, `division`, `subLocation`)
         VALUES( ?,?,?,?,?,?,?,?,?,?,?);";
   
     
       
       $stmt = $pdo->prepare($Insert);
       $stmt->bindParam(1, $_SESSION['student_id']);  
       $stmt->bindParam(2, $id_number);
       $stmt->bindParam(3, $id_full_name);
       $stmt->bindParam(4, $id_dob);
       $stmt->bindParam(5, $id_gender);
       $stmt->bindParam(6, $id_district_of_birth);
       $stmt->bindParam(7, $id_district);
       $stmt->bindParam(8, $id_location);
       $stmt->bindParam(9, $id_poi);
       $stmt->bindParam(10, $id_division);
       $stmt->bindParam(11, $id_sub_location);
       $stmt->execute();


       $Insert="
       INSERT INTO `student_emergency_details`( `student_id`, `guardian_name`, `guardian_email`, `guardian_tel`) VALUES( ?,?,?,?);";
    
      $stmt = $pdo->prepare($Insert);
      $stmt->bindParam(1, $_SESSION['student_id']);  
      $stmt->bindParam(2, $guardian1name);
      $stmt->bindParam(3, $guardian1email);
      $stmt->bindParam(4, $guardian1tel);
      
      $stmt->execute();

       
      }

  
    }

 }
}
}