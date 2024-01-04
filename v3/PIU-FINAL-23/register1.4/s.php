<?php


require 'vendor/autoload.php'; // Load the Composer autoloader

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
function GETdata($school,$yos,$LOS,$prog,$pdo){

    if ($LOS == "Diploma") {
        $select = "SELECT `student_first_name`,`student_second_name`,`student_last_name`,`combined_adm_data` FROM `piu_registration_form_data` WHERE  `School`=? AND `clos_cer_dip`=? AND `level`=? AND `prog`=?";
    } else {
        $select = "SELECT `student_first_name`,`student_second_name`,`student_last_name`,`combined_adm_data` FROM `piu_registration_form_data` WHERE  `School`=? AND `clos`=? AND `level`=? AND `prog`=?";
    }
    
    $stmt = $pdo->prepare($select);
    
    $stmt->bindParam(1, $school);
    $stmt->bindParam(2, $yos);
    $stmt->bindParam(3, $LOS);
    $stmt->bindParam(4, $prog); 
    $stmt->execute();
    
    
    $data = $stmt->fetchALL(PDO::FETCH_ASSOC);
    if($data){


        
return $data;

    }else{

        die('No data could be generated try again later');
        return;
    }

}



if(isset($_POST['School']) && isset($_POST['yos'])){
    
   $school= $_POST['School'];
   $yos= $_POST['yos'];
   $LOS=$_POST['LOS'];
   $prog=$_POST['prog'];
   
   require_once '../config.php';
   

if(GETdata($school,$yos,$LOS,$prog,$pdo)){
    $data =GETdata($school,$yos,$LOS,$prog,$pdo);


   
   // Create a new Spreadsheet object
   $spreadsheet = new Spreadsheet();
   
   // Set active sheet
   $spreadsheet->setActiveSheetIndex(0);
   $sheet = $spreadsheet->getActiveSheet();
   
   
   $sheet->setCellValue('A1', 'Student Name');
   $sheet->setCellValue('B1', 'AdmissionNumber');
   
   
   
   
   // Add student data to the Excel file
   $row = 2;
   foreach ($data as $data) {
   
            $fullname=$data['student_first_name'].' '.$data['student_second_name'].' '.$data['student_last_name'];
            $adm=$data['combined_adm_data'];
   
   
   
   
       $sheet->setCellValue('A' . $row, $fullname); // Student Name
       $sheet->setCellValue('B' . $row, $adm); // Semester
       $row++;
   }
   




//    // Save the Excel file
//    $writer = new Xlsx($spreadsheet);
//    $writer->save('students.xlsx');
ob_clean();
// Save the Excel file
$writer = new Xlsx($spreadsheet);

// Set headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="students.xlsx"');
header('Cache-Control: max-age=0');

// Output the file to the browser
$writer->save('php://output');
exit();
   echo 'Excel file has been created successfully!';
}else{
    die('no data');
}









}
else{
    die('ERROR');
}



//generate list of students per clos



















