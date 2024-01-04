<?php @require_once 'config.php';@require_once 'session_security.php';
      $select_announcement="SELECT * FROM  `student_announcements`  WHERE active IS NULL AND archive IS NULL ORDER BY date DESC ";
      $stmt=$pdo->prepare($select_announcement);
      if($stmt->execute()){
         $data_announcements = $stmt->fetchALL(PDO::FETCH_ASSOC);
         // var_dump($data_announcements);
        //  die();
        if(!$data_announcements){
           echo "No announcements";
           return;
           }else{

           foreach($data_announcements as $x){
                    //echo $_SESSION['student_acc_school'];
                    //."is the school <br>".$x["student_school"];
                 // echo $x["student_school"];
                  // die();

             if($_SESSION['student_acc_school']==$x["student_school"] || $x["student_school"] =="ALL_SCHOOLS"){
                echo '
                    <!-- Notification div -->
                    <div class="notification">
                      <div>
                        <strong>Notification:</strong> '.$x['message'].' ..
                      </div>
                      <div class="date-posted">
                      '.$x['date'].' 
                      </div>
                    </div>
                      ';
                   }
        }
    }
}
