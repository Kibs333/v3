<?php

//include 'https://portal.sicklywall.com/session_security.php';
include '../../session_security.php';
if(!isset($_SESSION['finance.php'])){
echo 'alert';
  //header("location:https://portal.sicklywall.com");

}

?><?php
include '../../functions.php';
function numberToAlphabet($number) {
    // Ensure $number is a positive integer
    $number = max(1, intval($number));
    
    // Convert the number to an alphabet using chr
    // A is ASCII 65, so we subtract 1 to get A for 1, B for 2, and so on
    $alphabet = chr(($number - 1) + ord('A'));
    
    return $alphabet;
}
function Getcolnames($sheet){
    // Get the highest column number (number of columns)
    $highestColumn = $sheet->getHighestColumn();
    // Convert the highest column letter to a column index
    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
    $columnNames = [];
    for ($col = 1; $col <= $highestColumnIndex; $col++) {
         $columnName = $sheet->getCellByColumnAndRow($col, 1)->getValue();
         // Check if the column name is not empty or blank
        $columnNames[] = $columnName;}
       return $columnNames;
}

function Getdatafromfile($value,$columnNames,$sheet){
    
    $index = array_search($value,$columnNames);
     if ($index !== false) { //echo "The index of $value is $index";

        if ($index==1){
            $index+=1;
        }
    } 
      else {die("$value not found in the array"); }
       
    $column = numberToAlphabet($index);

     // Get the highest row number with data
    $highestRow = $sheet->getHighestDataRow();

    // Initialize an array to store column values
    $columnValues = [];

    // Loop through each row in the specified column
   for ($row = 2; $row <= $highestRow; $row++) {
       // Get the cell value in the specified column and row
       $cellValue = $sheet->getCell($column . $row)->getValue();
       // Add the cell value to the array
      $columnValues[] = $cellValue;}
      return $columnValues;


}


function ReplaceWithSlace($text){
    $textWithoutSpaces = str_replace(' ', '_', $text);
    return $textWithoutSpaces ;
}

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Check if the file was uploaded without errors
         if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] === UPLOAD_ERR_OK) {
             $uploadedFile = $_FILES['excelFile']['tmp_name'];
             // Validate file type using MIME type
             $allowedMimeTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
             $fileMimeType = mime_content_type($uploadedFile);
             if (in_array($fileMimeType, $allowedMimeTypes)) {
                // Create a new folder named "cat_marks" if it doesn't exist
                $folderName = 'finance_auto_students';
                if (!is_dir($folderName)){mkdir($folderName);}
                // Move the uploaded file to the "cat_marks" folder
                $filename = basename($_FILES['excelFile']['name']);
                // echo timestamp();
                // die();
                $destination = $folderName . '/'.$filename;
    
                if (move_uploaded_file($uploadedFile, $destination)) {
                    // Load the Excel spreadsheet
                  $spreadsheet = IOFactory::load($destination);
                  $sheet = $spreadsheet->getActiveSheet();


                  $columnNames=Getcolnames($sheet);

                //   var_dump( $columnNames);
                //   die();
               
                  $admissionnumbers=Getdatafromfile('Admission Number',$columnNames,$sheet);

                //   var_dump($admissionnumbers);
                //   die();
               
               foreach($admissionnumbers as $x){
                include '../../config.php';
                $insert = 'INSERT INTO auto_approve (adm) VALUES(?)';
                $stmt = $pdo->prepare($insert);
                $stmt->bindParam(1,$x);
                $stmt->execute();



               }

                
                echo "<script> alert( 'File uploaded and processed successfully.'); window.location.href='dashboard.php';</script>";
                } else {
                    echo 'Error moving uploaded file.';
                }
            } else {
                echo 'Invalid file type. Please upload an Excel file.';
            }
        } else {
            echo 'Error uploading file.';
        }
    }
      
?>
