<?php  
session_start();

if(isset($_SESSION['evalForm']) && isset($_SESSION['student_id']) ){
    
       $table=$_SESSION['tableName'];
    
        include "config.php";
        $select ="SELECT *  FROM `$table` WHERE serial_id = ?";
        $stmt = $pdo->prepare($select);
        
        //$stmt->bindParam(1, $three);
        $stmt->bindParam(1, $_SESSION['student_id']);

        $stmt->execute();
        $participantdata = $stmt->fetch(PDO::FETCH_ASSOC);
        //var_dump($participantdata);
        if($participantdata){ die('You have already submitted.');}
        
       
    
    
    
    
    
    

}else{header("location:student.php");}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Course Evaluation</title>
    <link rel="stylesheet" href="resources/css/project.css">
</head>
<body>
 <form  id="e-form"action="project.php" method="post">
  <div class="header">
   <div class="piu">Pioneer international university</div>
   <div class="cef">course evaluation form</div>
  </div>
  <img src="resources/img/cropped-PIU-ICON-512x512-2-1-192x192.png" alt="piu logo">
  <h1>Course Evaluation Form</h1>
  <section class="first">
   <div class="top">
   <div>Year:<input type="Text"id="year" name="year" value="<?php echo $_SESSION['year'];?>" readonly></div>
   <div>Semester:<input type="Text" name="semester" value="<?php echo $_SESSION['semester']; ?>" readonly></div>
   <div class="yos">Year of Study:<span><?php echo $_SESSION['yos'];?></span></div>
  </div>
   <div class="middle">
   <div>Course Code:<input type="Text"id="course_code" value="<?php  echo $_SESSION['unitcode'];?>" readonly></div>
   <div>Course Title:<input type="Text" id="course_title"value="<?php  echo $_SESSION['unitname'];?>" readonly></div>
   <div>Course Lecturer:<input type="Text"id="course_lecturer"value="<?php echo $_SESSION['lecname'];?>" readonly></div>
  </div>
 </section>
 <div class="gsao">
  <table>
   <tr>
    <th></th>
    <th>General Structure And Organization</th>
    <th>Strongly Disagree</th>
    <th>Disagree</th>
    <th>Neutral</th>
    <th>Agree</th>
    <th>Strongly Agree</th>
  </tr> 
          <tr>  
            <td>1</td>
            <td>A course outline was provided at the start of the semester.</td>
            <td><input type="radio" name="1" value="Strongly_disagree"></td>
            <td><input type="radio" name="1" value="Disagree"></td>
            <td><input type="radio" name="1" value="Neutral"></td>
            <td><input type="radio"name="1"  value="Agree"></td>
            <td><input type="radio"name="1"  value="Strongly_agree"></td>
           </tr>
           <tr>    
                   <td>2</td>
                   <td>The course outline was comprehensive,clear and accurate.</td>
                   <td><input type="radio" name="2" value="Strongly_disagree"></td>
                   <td><input type="radio"name="2"  value="Disagree"></td>
                   <td><input type="radio"name="2"  value="Neutral"></td>
                   <td><input type="radio"name="2"  value="Agree"></td>
                   <td><input type="radio"name="2"  value="Strongly_agree"></td>
               </tr><tr> 
                   <td>3</td>
                   <td>the learning outcomes were cleary explained in the course outline.</td>
                   <td><input type="radio" name="3" value="Strongly_disagree"></td>
                   <td><input type="radio" name="3" value="Disagree"></td>
                   <td><input type="radio" name="3" value="Neutral"></td>
                   <td><input type="radio" name="3" value="Agree"></td>
                   <td><input type="radio" name="3" value="Strongly_agree"></td>
               </tr><tr> 
                   <td>4</td>
                   <td>The creteria for assessments  are cleary communicate at the beginning of the course.</td>
                   <td><input type="radio"name="4" value="Strongly_disagree"></td>
                   <td><input type="radio"name="4"value="Disagree"></td>
                   <td><input type="radio"name="4" value="Neutral"></td>
                   <td><input type="radio"name="4"value="Agree" ></td>
                   <td><input type="radio"name="4" value="Strongly_agree"></td>
               </tr>
               <tr> 
                   <td>5</td>
                   <td>Assignments and tests were returned in a timely manner.</td>
                   <td><input type="radio" name="5"value="Strongly_disagree"></td>
                   <td><input type="radio" name="5"value="Disagree"></td>
                   <td><input type="radio" name="5"value="Neutral"></td>
                   <td><input type="radio"name="5"value="Agree"></td>
                   <td><input type="radio" name="5" value="Strongly_agree"></td>
               </tr><tr> 
                   <td> 6</td>
                   <td>Grading was fair and consistent with stated goals of this course.</td>
                   <td><input type="radio" name="6" value="Strongly_disagree"></td>
                   <td><input type="radio" name="6"value="Disagree"></td>
                   <td><input type="radio" name="6"value="Neutral"></td>
                   <td><input type="radio" name="6"value="Agree"></td>
                   <td><input type="radio"name="6"value="Strongly_agree"></td>
               </tr>
               <tr> 
                   <td>7</td>
                   <td>Compared to other courses  taken at PIU ,the workload in this course was appropriate.</td>
                   <td><input type="radio" name="7" value="Strongly_disagree"></td>
                   <td><input type="radio" name="7" value="Disagree"></td>
                   <td><input type="radio" name="7" value="Neutral"></td>
                   <td><input type="radio" name="7" value="Agree"></td>
                   <td><input type="radio" name="7" value="Strongly_agree"></td>
               </tr><tr> 
                   <td>8</td>
                   <td>The class started and ended on time.</td>
                   <td><input type="radio" name="8" value="Strongly_disagree"></td>
                   <td><input type="radio" name="8"value="Disagree"></td>
                   <td><input type="radio" name="8"value="Neutral"></td>
                   <td><input type="radio" name="8" value="Agree"></td>
                   <td><input type="radio" name="8" value="Strongly_agree"></td>
               </tr>
          </table>
     
      </div>

      <div class="lsi" id="lsi">
        <table>
            <tr>
             <th></th>
             <th>learning stimulation and interest</th>
             <th>Strongly Disagree</th>
             <th>Disagree</th>
             <th>Neutral</th>
             <th>Agree</th>
             <th>Strongly Agree</th>
            </tr>
            <tr>  
              <td>9</td>
              <td>The lecturer stimulated interest in the subject area.</td>
              <td><input type="radio" name="9" value="Strongly_disagree"></td>
              <td><input type="radio" name="9"value="Disagree"></td>
              <td><input type="radio" name="9"value="Neutral"></td>
              <td><input type="radio"name="9"value="Agree"></td>
              <td><input type="radio"name="9"value="Strongly_agree"></td>
             </tr>
             <tr>  
                <td>10</td>
                <td>I gained an excellent understanding of concepts in the subject area.</td>
                <td><input type="radio" name="10" value="Strongly_disagree" ></td>
                <td><input type="radio" name="10"value="Disagree"></td>
                <td><input type="radio" name="10"value="Neutral"></td>
                <td><input type="radio"name="10" value="Agree"></td>
                <td><input type="radio"name="10" value="Strongly_agree"></td>
               </tr>
               <tr>  
                <td>11</td>
                <td>The level of intellectual challenge in this course was appropriate.</td>
                <td><input type="radio" name="11" value="Strongly_disagree"></td>
                <td><input type="radio" name="11"value="Disagree"></td>
                <td><input type="radio" name="11"value="Neutral"></td>
                <td><input type="radio"name="11" value="Agree"></td>
                <td><input type="radio"name="11" value="Strongly_agree"></td>
               </tr>
               <tr>  
                <td>12</td>
                <td>I learned alot in this course.</td>
                <td><input type="radio" name="12"value="Strongly_disagree"></td>
                <td><input type="radio" name="12"value="Disagree"></td>
                <td><input type="radio" name="12" value="Neutral"></td>
                <td><input type="radio"name="12" value="Agree"></td>
                <td><input type="radio"name="12" value="Strongly_agree"></td>
               </tr>
               <tr>  
                <td>13</td>
                <td>I was encouraged to apply my knowledge in different ways(i.e problem solving,critical thinking,analysis,creativity,etc.)</td>
                <td><input type="radio" name="13" value="Strongly_disagree"></td>
                <td><input type="radio" name="13" value="Disagree"></td>
                <td><input type="radio" name="13" value="Neutral"> </td>
                <td><input type="radio"name="13"value="Agree" > </td>
                <td><input type="radio"name="13" value="Strongly_agree"> </td>
               </tr>
            </table>

      </div>

<div class="fe">
    <table>
        <tr>
         <th></th>
         <th>Faculty Evaluation</th>
         <th>Strongly Disagree</th>
         <th>Disagree</th>
         <th>Neutral</th>
         <th>Agree</th>
         <th>Strongly Agree</th>
        </tr>
        <tr>  
          <td>14</td>
          <td>The lecturer was organized and well prepared for class.</td>
          <td><input type="radio" name="14" value="Strongly_disagree"></td>
          <td><input type="radio" name="14" value="Disagree"></td>
          <td><input type="radio" name="14"value="Neutral"></td>
          <td><input type="radio"name="14"value="Agree"></td>
          <td><input type="radio"name="14" value="Strongly_agree"></td>
         </tr>
         <tr>  
            <td>15</td>
            <td>The lecturer stimulated class discussion and student participation well.</td>
            <td><input type="radio" name="15" value="Strongly_disagree"></td>
            <td><input type="radio" name="15" value="Disagree"></td>
            <td><input type="radio" name="15"value="Neutral"></td>
            <td><input type="radio"name="15" value="Agree"></td>
            <td><input type="radio"name="15"value="Strongly_agree" ></td>
           </tr>
           <tr>  
            <td>16</td>
            <td>The lecturer was available for consulatation outside the class to answer question and explain material.</td>
            <td><input type="radio" name="16" value="Strongly_disagree"></td>
            <td><input type="radio" name="16"value="Disagree"></td>
            <td><input type="radio" name="16"value="Neutral"></td>
            <td><input type="radio"name="16"value="Agree"></td>
            <td><input type="radio"name="16"value="Strongly_agree"></td>
           </tr>
           <tr>  
            <td>17</td>
            <td>The lecturer displayed suitable content knowledge in the course</td>
            <td><input type="radio" name="17" value="Strongly_disagree"></td>
            <td><input type="radio" name="17"value="Disagree"></td>
            <td><input type="radio" name="17"value="Neutral"></td>
            <td><input type="radio"name="17"value="Agree"></td>
            <td><input type="radio"name="17" value="Strongly_agree"></td>
           </tr>
         
           <tr>  
            <td>18</td>
            <td>The lecturer provided me with feedback that contibuted to my learning</td>
            <td><input type="radio" name="18" value="Strongly_disagree" ></td>
            <td><input type="radio" name="18"value="Disagree"></td>
            <td><input type="radio" name="18"value="Neutral"></td>
            <td><input type="radio"name="18"value="Agree"></td>
            <td><input type="radio"name="18"value="Strongly_agree"></td>
           </tr>
           <tr>  
            <td>19</td>
            <td>The lecturer made it clear how course grade would be determined</td>
            <td><input type="radio" name="19" value="Strongly_disagree"></td>
            <td><input type="radio" name="19"value="Disagree"></td>
            <td><input type="radio" name="19"value="Neutral"></td>
            <td><input type="radio"name="19"value="Agree"></td>
            <td><input type="radio"name="19"value="Strongly_agree"></td>
           </tr>
           <tr>  
            <td>20</td>
            <td>The lecturer  presented information in in an understandable manner </td>
            <td><input type="radio" name="20" value="Strongly_disagree"  > </td>
            <td><input type="radio" name="20"value="Disagree"></td>
            <td><input type="radio" name="20"value="Neutral"> </td>
            <td><input type="radio"name="20"value="Agree" > </td>
            <td><input type="radio"name="20"value="Strongly_agree"> </td>
           </tr>
              
           <tr>  
            <td>21</td>
            <td>The lecturer's communication skills(voice projection,volume,speed,tone,vocabulary) were appropriate</td>
            <td><input type="radio" name="21" value="Strongly_disagree"></td>
            <td><input type="radio" name="21"value="Disagree"></td>
            <td><input type="radio" name="21"value="Neutral"></td>
            <td><input type="radio"name="21"value="Agree"></td>
            <td><input type="radio"name="21"value="Strongly_agree"></td>
           </tr>
           <tr>  
            <td>22</td>
            <td>The lecturer made students feel free to ask questions and express their ideas</td>
            <td><input type="radio" name="22"value="Strongly_disagree"></td>
            <td><input type="radio" name="22"value="Disagree"></td>
            <td><input type="radio" name="22"value="Neutral"></td>
            <td><input type="radio"name="22" value="Agree"></td>
            <td><input type="radio"name="22"value="Strongly_agree"></td>
           </tr>
           <tr>  
            <td>23</td>
            <td>The lecturer presented the subject matter cleary and answered questions effectively</td>
            <td><input type="radio" name="23" value="Strongly_disagree"></td>
            <td><input type="radio" name="23" value="Disagree"></td>
            <td><input type="radio" name="23" value="Neutral"></td>
            <td><input type="radio" name="23" value="Agree"></td>
            <td><input type="radio" name="23" value="Strongly_agree"></td>
           </tr>
        </table>

</div>
<div class="q 1">
    <p>24 </p><span>What are the best aspects of this course /lectures?</span><textarea name="bestaspects" cols="30" rows="10"></textarea>
</div>
<div class="q 2">
    <p>25 </p><span>What aspects of the course/lecture can be improved upon?</span><textarea name="improvedaspects"  cols="30" rows="10"></textarea>
</div>
<button type="submit" id="submit-btn" name="submit">SUBMIT</button>

<script src="resources/js/project-form.js"></script>
<script>
document.getElementById('submit-btn').addEventListener("click", function(event) {
  var radioGroups = {};

  var radioButtons = document.querySelectorAll('input[type="radio"]');

  radioButtons.forEach(function(radioButton) {
    var groupName = radioButton.getAttribute('name');

    if (!radioGroups[groupName]) {
      radioGroups[groupName] = [];
    }

    radioGroups[groupName].push(radioButton);
  });

  checkAllRadios(event, radioGroups);
});

function checkAllRadios(event, radioGroups) {
  for (var groupName in radioGroups) {
    var allChecked = radioGroups[groupName].some(function(radioButton) {
      return radioButton.checked;
    });

    if (!allChecked) {
      event.preventDefault();
      alert("Please fill in all values");
      return;
    }
  }

  checkAllTextAreas(event);
}



function checkAllTextAreas(event) {
  var textAreas = document.querySelectorAll('textarea');
  var allFilled = true;

  textAreas.forEach(function(textArea) {
    if (textArea.value.trim() === '') {
      allFilled = false;
      return; 
    }
  });

  if (!allFilled) {
      event.preventDefault();
    alert("Please fill in all text areas");
  }
}




</script>


</body>
</html>