<?php
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
 if(isset($_POST['upload'])){
    $lecname=$_POST['lec_name'];
    $course_code=$_POST['course_code'];
    $course_name=$_POST['course_name'];
    $year=$_POST['year'];
    $semester=$_POST['semester'];
    $yos=$_POST['yos'];

    $min = 1000;
    $max = 10000000000;
    
    
    $unique_table=false;

    while ($unique_table==false)
    {
        $unique_id = random_int($min, $max);
        include 'config.php';
        $select ="SHOW TABLES LIKE ? " ;
        $stmt = $pdo->prepare($select);
        $stmt->bindParam(1,$unique_id);
        $stmt->execute();
        $tables = $stmt->fetchALL(PDO::FETCH_ASSOC);
        if ($tables){
            $unique_table=false;
           }else{
           $unique_table=true;
            $unique_id;
        }

    }



     if($lecname==="" ||$course_code==="" ||  $course_name==="" ||  $year==="" ||  $semester==="" ||  $yos===""){
        echo 'Please fill in all Details.';}
        else{  
        // Check if the file was uploaded without errors
         if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] === UPLOAD_ERR_OK) {
             $uploadedFile = $_FILES['excelFile']['tmp_name'];
             // Validate file type using MIME type
             $allowedMimeTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
             $fileMimeType = mime_content_type($uploadedFile);
             if (in_array($fileMimeType, $allowedMimeTypes)) {
                // Create a new folder named "cat_marks" if it doesn't exist
                $folderName = 'cat_marks excel';
                if (!is_dir($folderName)){mkdir($folderName);}
                // Move the uploaded file to the "cat_marks" folder
                $filename = basename($_FILES['excelFile']['name']);
                $destination = $folderName . '/' . $filename;
    
                if (move_uploaded_file($uploadedFile, $destination)) {
                    // Load the Excel spreadsheet
                  $spreadsheet = IOFactory::load($destination);
                  $sheet = $spreadsheet->getActiveSheet();


                  $columnNames=Getcolnames($sheet);
                  $admissionnumbers=Getdatafromfile('Admission Number',$columnNames,$sheet);
                  $marks=Getdatafromfile('Total',$columnNames,$sheet);

                  // Combine the arrays to create a new associative array
                  $newArray = array_combine($admissionnumbers, $marks);

                  $catMarksStore=[];
                  $catMarksStore["lecturer_name"]=$lecname;
                  $catMarksStore["unitCode"]= $course_code;
                  $catMarksStore["UnitName"]= $course_name;
                  $catMarksStore["semester"]= $semester;
                  $catMarksStore["yearOfStudy"]= $yos;
                  $catMarksStore["year"]= $year;
                  $catMarksStore["courseEvalTable"]=$unique_id;
                  $catMarksStore["grades"]=$newArray;

                // Specify the folder name
                $folderName = 'cat_marks';

                // Create the folder if it doesn't exist
                if (!file_exists($folderName)) {
                mkdir($folderName, 0755, true);
                  }



                  // Convert array to JSON
                  $jsonData = json_encode($catMarksStore,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                 
                  // Specify the file path within the folder
                  $filePath = $folderName . '/'.$unique_id.'.json';
                 // Write JSON data to the file
                 file_put_contents($filePath, $jsonData);
                 
                 // Check if the file was created successfully
                 if (file_exists($filePath)) {
                     echo 'JSON file created successfully.';
                 } else {
                     echo 'Error creating JSON file.';
                 }

                $tableName=$unique_id;
                require 'make_table.php';
                echo "<script> alert( 'File uploaded and processed successfully.'); window.location.href='cat-marks.php';</script>";
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
        }
    }
?>
