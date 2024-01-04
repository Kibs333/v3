<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_SESSION['COURSE-EVAL-auth'])) {
    if (isset($_GET['table_name']) ) {
        $tableName =htmlspecialchars($_GET['table_name']);
   
        include "config.php";
        $select ="SELECT COUNT(*) as no_of_participants FROM `$tableName`";
        $stmt = $pdo->prepare($select);
        $stmt->execute();
        $participantdata = $stmt->fetch(PDO::FETCH_ASSOC);
        //var_dump($participantdata);
        if($participantdata){$nostsd =$participantdata['no_of_participants'];}

           $select ="SELECT *  FROM  `$tableName` " ;
           $stmt = $pdo->prepare($select);
           $stmt->execute();
           $datacolumns = $stmt->fetchALL(PDO::FETCH_ASSOC);
           //var_dump($datacolumns);
           for($i = 1; $i <= 23; $i++){$column = 'col' . $i;${$column.'_SD'}=0;${$column.'_D'}=0;${$column.'_N'}=0;${$column.'_A'}=0;${$column.'_SA'}=0;};
               $bestaspects=[];$improvedaspects=[];
if ($datacolumns) {
    for($i = 1; $i <= 23; $i++){
        $column = 'col' . $i;
         for ($a = 0; $a <=count($datacolumns)-1; $a++) {
          switch ($datacolumns[$a][$column]) {
                                  case 'Strongly_disagree':
                                  ${$column.'_SD'}=${$column.'_SD'}+1;
                                    break;
                                case 'Disagree':
                                 ${$column.'_D'}=${$column.'_D'}+1;
                                    break;
                                case 'Neutral':
                                  ${$column.'_N'}=${$column.'_N'}+1;
                                    break;
                                case 'Agree':
                                  ${$column.'_A'}=${$column.'_A'}+1;
                                    break;
                                case 'Strongly_agree':
                                  ${$column.'_SA'}=${$column.'_SA'}+1;
                                    break;
                                default:
                                 // echo 'no data found';
                                    break;
                            }                   
                    }              
        }
        for ($a2 = 0; $a2 <=count($datacolumns)-1 ; $a2++) {
             $bestaspects[]=$datacolumns[$a2]['bestaspects'];
             $improvedaspects[]=$datacolumns[$a2]['improvedaspects'];
        }
       // header("location:dash-data.php");
    }


    else{$none="none";echo 'form has not been filled yet'; }


    } else {
        die("Table Name not provided in the  request.");
    }
} else {
    //die("Invalid request.");
    header("location:https://portal.sicklywall.com/v2/PIU-FINAL-23/");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="resources/css/dash-data.css">
    <style> body{ width:fit-content;
    }</style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Course Evaluation</title>
</head>
<body>
<div  id ="datatables"class="datatables <?php echo $none ?>"> 
    <div class="gsao">
        <table>
            <caption> <?php echo  $nostsd." participants"?>  </caption>
          <tr>
           <th></th>
           <th>general structure and organization</th>
           <th>strongly disagree</th>
           <th>disagree</th>
           <th>neutral</th>
           <th>agree</th>
           <th>strongly agree</th>
          </tr>
          <tr>  
            <td>1</td>
            <td>a course outline was provided  at the start of the semester. </td>
            <td><?php echo $col1_SD?></td>
            <td><?php echo $col1_D?></td>
            <td><?php echo $col1_N?></td>
            <td><?php echo $col1_A?></td>
            <td><?php echo $col1_SA?></td>
           </tr>
           <tr>    
                   <td>2</td>
                   <td>course outline was comprehensive,clear and accurate </td>
                   <td><?php echo $col2_SD?></td>
                   <td><?php echo $col2_D?></td>
                   <td><?php echo $col2_N?></td>
                  <td><?php echo $col2_A?></td>
                  <td><?php echo $col2_SA?></td>
               </tr><tr> 
                   <td>3</td>
                   <td>the learning outcomes were cleary explained in the course outline </td>
                   <td><?php echo $col3_SD?></td>
                   <td><?php echo $col3_D?></td>
                   <td><?php echo $col3_N?></td>
                   <td><?php echo $col3_A?></td>
                   <td><?php echo $col3_SA?></td>
               </tr><tr> 
                   <td>4</td>
                   <td>the creteria for assessments  are cleary communicate at the beginning of the course</td>
                   <td><?php echo $col4_SD?></td>
                   <td><?php echo $col4_D?></td>
                   <td><?php echo $col4_N?></td>
                   <td><?php echo $col4_A?></td>
                   <td><?php echo $col4_SA?></td>
               </tr><tr> 
                   <td>5</td>
                   <td>assignments  and tests were returned in a timely  manner</td>
                   <td><?php echo $col5_SD?></td>
                   <td><?php echo $col5_D?></td>
                   <td><?php echo $col5_N?></td>
                   <td><?php echo $col5_A?></td>
                   <td><?php echo $col5_SA?></td>
               </tr><tr> 
                   <td> 6</td>
                   <td>grading was fair and consistent with stated goals of this course. </td>
                   <td><?php echo $col6_SD?></td>
                   <td><?php echo $col6_D?></td>
                   <td><?php echo $col6_N?></td>
                   <td><?php echo $col6_A?></td>
                   <td><?php echo $col6_SA?></td>
               </tr><tr> 
                   <td>7</td>
                   <td>compared to other courses  taken at PIU ,the workload in this course was appropriate. </td>
                   <td><?php echo $col7_SD?></td>
                   <td><?php echo $col7_D?></td>
                   <td><?php echo $col7_N?></td>
                   <td><?php echo $col7_A?></td>
                   <td><?php echo $col7_SA?></td>
               </tr><tr> 
                   <td>8</td>
                   <td>the class started and ended on time </td>
                   <td><?php echo $col8_SD?></td>
                   <td><?php echo $col8_D?></td>
                   <td><?php echo $col8_N?></td>
                   <td><?php echo $col8_A?></td>
                   <td><?php echo $col8_SA?></td>
               </tr>
          </table>
      </div>

      <div class="lsi" id="lsi">
        <table>
            <tr>
             <th></th>
             <th>learning stimulation and interest</th>
             <th>Strongly_disagree</th>
             <th>disagree</th>
             <th>neutral</th>
             <th>agree</th>
             <th>strongly agree</th>
            </tr>
            <tr>  
              <td>9</td>
              <td>the lecturer stimulated interest  in the subject area. </td>
                   <td><?php echo $col9_SD?></td>
                   <td><?php echo $col9_D?></td>
                   <td><?php echo $col9_N?></td>
                   <td><?php echo $col9_A?></td>
                   <td><?php echo $col9_SA?></td>
             </tr>
             <tr>  
                <td>10</td>
                <td>i gained an excellent understanding of concepts in the subject area. </td>
                  <td><?php echo $col10_SD?></td>
                   <td><?php echo $col10_D?></td>
                   <td><?php echo $col10_N?></td>
                   <td><?php echo $col10_A?></td>
                   <td><?php echo $col10_SA?></td>
               </tr>
               <tr>  
                <td>11</td>
                <td>the level of intellectual challenge in this course was appropriate. </td>
                   <td><?php echo $col11_SD?></td>
                   <td><?php echo $col11_D?></td>
                   <td><?php echo $col11_N?></td>
                   <td><?php echo $col11_A?></td>
                   <td><?php echo $col11_SA?></td>
               </tr>
               <tr>  
                <td>12</td>
                <td>i learned alot in this course .</td>
                   <td><?php echo $col12_SD?></td>
                   <td><?php echo $col12_D?></td>
                   <td><?php echo $col12_N?></td>
                   <td><?php echo $col12_A?></td>
                   <td><?php echo $col12_SA?></td>
               </tr>
             
               <tr>  
                <td>13</td>
                <td> i  was encouraged to apply my knowledge in different ways(i.e problem solving,critical thinking,analysis,creativity,etc.)</td>
                   <td><?php echo $col13_SD?></td>
                   <td><?php echo $col13_D?></td>
                   <td><?php echo $col13_N?></td>
                   <td><?php echo $col13_A?></td>
                   <td><?php echo $col1_SA?></td>
               </tr>            
<div class="fe">
    <table>
        <tr>
         <th></th>
         <th>faculty evaluation</th>
         <th>Strongly_disagree</th>
         <th>disagree</th>
         <th>neutral</th>
         <th>agree</th>
         <th>strongly agree</th>
        </tr>
        <tr>  
          <td>14</td>
          <td>the lecturer was organized and well prepared for class. </td>
                   <td><?php echo $col14_SD?></td>
                   <td><?php echo $col14_D?></td>
                   <td><?php echo $col14_N?></td>
                   <td><?php echo $col14_A?></td>
                   <td><?php echo $col14_SA?></td>
         </tr>
         <tr>  
            <td>15</td>
            <td>the lecturer stimulated class discussion and student participation well. </td>
                  <td><?php echo $col15_SD?></td>
                   <td><?php echo $col15_D?></td>
                   <td><?php echo $col15_N?></td>
                   <td><?php echo $col15_A?></td>
                   <td><?php echo $col15_SA?></td>
           </tr>
           <tr>  
            <td>16</td>
            <td>the lecturer was available for consulatation outside the class to answer question and explain material. </td>
                  <td><?php echo $col16_SD?></td>
                   <td><?php echo $col16_D?></td>
                   <td><?php echo $col16_N?></td>
                   <td><?php echo $col16_A?></td>
                   <td><?php echo $col16_SA?></td>
           </tr>

           <tr>  
            <td>17</td>
            <td>the lecturer displayed suitable content knowledge in he course .</td>
                   <td><?php echo $col17_SD?></td>
                   <td><?php echo $col17_D?></td>
                   <td><?php echo $col17_N?></td>
                   <td><?php echo $col17_A?></td>
                   <td><?php echo $col17_SA?></td>
           </tr>
         
           <tr>  
            <td>18</td>
            <td>the lecturer provided me with feedback that contibuted to my learning </td>
                  <td><?php echo $col18_SD?></td>
                   <td><?php echo $col18_D?></td>
                   <td><?php echo $col18_N?></td>
                   <td><?php echo $col18_A?></td>
                   <td><?php echo $col18_SA?></td>
           </tr>
           <tr>  
            <td>19</td>
            <td> the lecturer  made it clear how course grade would be determined </td>
                  <td><?php echo $col19_SD?></td>
                   <td><?php echo $col19_D?></td>
                   <td><?php echo $col19_N?></td>
                   <td><?php echo $col19_A?></td>
                   <td><?php echo $col19_SA?></td>
           </tr>
           <tr>  
            <td>20</td>
            <td>the lecturer  presented information in in an understandable manner </td>
                  <td><?php echo $col20_SD?></td>
                   <td><?php echo $col20_D?></td>
                   <td><?php echo $col20_N?></td>
                   <td><?php echo $col20_A?></td>
                   <td><?php echo $col20_SA?></td>
           </tr>
           <tr>  
            <td>21</td>
            <td>the lecturer's communication skills(voice projection,volume,speed,tone,vocabulary) were appropriate  </td>
                   <td><?php echo $col21_SD?></td>
                   <td><?php echo $col21_D?></td>
                   <td><?php echo $col21_N?></td>
                   <td><?php echo $col21_A?></td>
                   <td><?php echo $col21_SA?></td>
           </tr>
           <tr>  
            <td>22</td>
            <td>the lecturer made students feel free to ask questions and express their ideas  </td>
                  <td><?php echo $col22_SD?></td>
                   <td><?php echo $col22_D?></td>
                   <td><?php echo $col22_N?></td>
                   <td><?php echo $col22_A?></td>
                   <td><?php echo $col22_SA?></td>
           </tr>             
           <tr>  
            <td>23</td>
            <td>the lecturer presented the subject matter cleary and answered questions effectively </td>
                   <td><?php echo $col23_SD?></td>
                   <td><?php echo $col23_D?></td>
                   <td><?php echo $col23_N?></td>
                   <td><?php echo $col23_A?></td>
                   <td><?php echo $col23_SA?></td>
           </tr>
        </table>
</div>
<div class="q 1">
 <p>24</p><span>what are the best aspects of this course /lectures?</span><div class="bestaspects" id="bestaspects"  >

 <?php  
//  print_r($bestaspects );
 foreach($bestaspects as $as){echo  $as;echo '<br>';}?>
</div>
</div>
<div class="q 2">
 <p>25 </p><span>what aspects of the course/lecture can be improved upon?</span><div class="improvedaspects" id="improvedaspects">
 <?php 
  //print_r($improvedaspects ); 
  foreach($improvedaspects as $ias){echo  $ias;echo '<br>';}?>
 </div>
</div>
</table>
</div>
      </div>
    </div>
</body>
</html>