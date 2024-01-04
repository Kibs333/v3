<?php
@require_once '../session_security.php';
@require_once '../config.php';

require_once 'dompdf/autoload.inc.php'; 

use Dompdf\Dompdf;
use Dompdf\Options;

if(isset($_SESSION['student_id']) && $_SESSION['register-pdf']==true)
{
// Create a Dompdf instance with options
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('chroot', realpath(''));

$dompdf = new Dompdf($options);
// Load HTML content from your HTML file
ob_start();
require('pdf_template.php');
$html=ob_get_contents();
ob_get_clean();
// Load HTML into Dompdf
$dompdf->loadHtml($html);

$school=$_SESSION['school'];
$clos=$_SESSION['clos'];
$currentYear = date('Y'); // Get the current year
$parentDirectory = 'StudentRegister/' . $currentYear;

if (!is_dir($parentDirectory)) {
    if (mkdir($parentDirectory, 0777, true)) {
        echo "Parent directory '$parentDirectory' created successfully.";
    } else {
        echo "Failed to create parent directory '$parentDirectory'.";
    }
}


$directoryName = $parentDirectory . '/' . $school;

if (!is_dir($directoryName)) {
    if (mkdir($directoryName, 0777, true)) {
        echo "Directory '$directoryName' created successfully.";
    } else {
        echo "Failed to create directory '$directoryName'.";
    }
}

$directoryName = $parentDirectory . '/' . $school.'/'.$clos;
if (!is_dir($directoryName)) {
    if (mkdir($directoryName, 0777, true)) {
        echo "Directory '$directoryName' created successfully.";
    } else {
        echo "Failed to create directory '$directoryName'.";
    }
}

$saveTo= $directoryName;
// Set paper size and orientation (optional)
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

$pdfFileName =$_SESSION['adm_idno']."-".$_SESSION['adm_year'] .'-registrationForm.pdf';

// Save the PDF in the same directory as this script
$pdfFilePath = __DIR__ . '/'.$saveTo. '/' . $pdfFileName;
file_put_contents($pdfFilePath, $dompdf->output());
$has_registered=1;

$save = "UPDATE students_form SET has_registered=?,path=?  WHERE id=?";
$stmt = $pdo->prepare($save);
$stmt->bindParam(1,$has_registered);
$stmt->bindParam(2,$pdfFilePath );
$stmt->bindParam(3, $_SESSION['student_id']);
$stmt->execute();

$_SESSION['register-pdf']=false;
}
else{header('location:../portal.php');}