<?php
include 'config.php';
$evaluation_piu='evaluation_piu';
$checkExistingTable = 'SELECT * FROM information_schema.tables 
WHERE table_schema = ? AND table_name = ? LIMIT 1;';

try {
    $stmt = $pdo->prepare($checkExistingTable);
    $stmt->bindParam(1, $evaluation_piu);
    $stmt->bindParam(2, $tableName);

    if ($stmt->execute()) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            echo '<script>alert("Cat Marks Table already found ");setTimeout(function(){window.location.href="cat-marks.php"},100);</script>';
        } else {
           
            $columns = [
                'id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT',

                'serial_id varchar(255) DEFAULT NULL',
               
                'col1 varchar(255) DEFAULT NULL',
                'col2 varchar(255) DEFAULT NULL',
                'col3 varchar(255) DEFAULT NULL',
                'col4 varchar(255) DEFAULT NULL',
                'col5 varchar(255) DEFAULT NULL',
                'col6 varchar(255) DEFAULT NULL',
                'col7 varchar(255) DEFAULT NULL',
                'col8 varchar(255) DEFAULT NULL',
                'col9 varchar(255) DEFAULT NULL',
                'col10 varchar(255) DEFAULT NULL',
                'col11 varchar(255) DEFAULT NULL',
                'col12 varchar(255) DEFAULT NULL',
                'col13 varchar(255) DEFAULT NULL',
                'col14 varchar(255) DEFAULT NULL',
                'col15 varchar(255) DEFAULT NULL',
                'col16 varchar(255) DEFAULT NULL',
                'col17 varchar(255) DEFAULT NULL',
                'col18 varchar(255) DEFAULT NULL',
                'col19 varchar(255) DEFAULT NULL',
                'col20 varchar(255) DEFAULT NULL',
                'col21 varchar(255) DEFAULT NULL',
                'col22 varchar(255) DEFAULT NULL',
                'col23 varchar(255) DEFAULT NULL',
                'bestaspects text DEFAULT NULL',
                'improvedaspects text DEFAULT NULL'
            ];
            
            $query = sprintf(
                "CREATE TABLE `%s` (%s);",
                $tableName,
                implode(', ', $columns)
            );
            $stmt = $pdo->prepare($query);
            if($stmt ->execute()){
                $insertdata ="INSERT INTO submission_form (table_name,lecturer_name,UnitName,unitcode,semester,yos,year) Values(?,?,?,?,?,?,?)";
                $stmt=$pdo->prepare($insertdata);
                $stmt->bindparam(1,$tableName);
                $stmt->bindparam(2,$lecname);
                $stmt->bindparam(3,$course_name);
                $stmt->bindparam(4,$course_code);
                $stmt->bindparam(5,$semester);
                $stmt->bindparam(6,$yos);
                $stmt->bindparam(7,$year);
                $stmt->execute();
            
            echo '<script>alert("Cat Marks Uploaded");setTimeout(function(){window.location.href="cat-marks.php"},100);</script>';
            
            }else{ echo '<script>alert("ERROR !!!");setTimeout(function(){window.location.href="cat-marks.php"},100);</script>';}
            
        }
    } else {
  
        die("Something went wrong. Please try again later.");
    }
} catch (PDOException $e) {
    // Handle PDO exceptions
    die("PDO Exception: " . $e->getMessage());
}
