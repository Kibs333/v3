<?php
include '../../config.php';
$feedback=[];

$students_rejected_by_finance = 'SELECT * FROM finance_form WHERE details_rejected="rejected";';
$stmt = $pdo->prepare($students_rejected_by_finance);
$stmt->execute();
$data_students_rejected_by_finance = $stmt->fetchALL(PDO::FETCH_ASSOC);



if($data_students_rejected_by_finance){


    foreach($data_students_rejected_by_finance as $data){

      echo "<table>

      
            <tr>
             <th>Student Name</th>
             <th>Student Adm</th>
            </tr>
            <tr>
             <td>".$data['students_adm']."</td>
             <td>".$data['students_name']."</td>
            </tr>
            </table>";

    }


}
else{

$feedback[]="No Student Data";

}

foreach ($feedback as $feedback) {
 echo $feedback ;
}
