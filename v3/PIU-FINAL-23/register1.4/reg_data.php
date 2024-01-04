<?php
session_start();
if(isset($_SESSION['reg_data.php'])){
require_once '../config.php';
$zero = 1;
// Count the number of rows in the "students_form" table where has_registered is 1
$select = "SELECT COUNT(*) AS TRS FROM students_form WHERE has_registered=?";
$stmt = $pdo->prepare($select);
$stmt->bindParam(1, $zero);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($data){$trs = $data['TRS'];}

$SCHOOL = array('SICT', 'SDSS', 'SBM', 'SEDU', 'SAMS');

// Initialize an associative array to store the school counts
$schoolCounts = array();

foreach ($SCHOOL as $school) {
    // Count the number of rows in "piu_registration_form_data" for each school
    $select = "SELECT COUNT(*) AS total_count FROM piu_registration_form_data WHERE school=?";
    $stmt = $pdo->prepare($select);
    $stmt->bindParam(1, $school);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $count = $data['total_count'];
        
        // Create a variable name by adding a dollar sign before the school name
        // and assign the count as its value
        $schoolCounts['$' . $school] = $count;
    }
}

$programme = array('DBM', 'DIT', 'DPGM', 'DBIT', 'BCOM', 'BA-IR', 'DIR', 'DMTL', 'DSWCD', 'DAM', 'BSIT', 'BED-A');

// Initialize an associative array to store the program counts
$ProgCounts = array();

foreach ($programme as $prog) {
    // Count the number of rows in "piu_registration_form_data" for each program
    $select = "SELECT COUNT(*) AS total_count FROM piu_registration_form_data WHERE prog=? ";
    $stmt = $pdo->prepare($select);
    $stmt->bindParam(1, $prog);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $Progcount = $data['total_count'];
        
        // Create a variable name by adding a dollar sign before the program name
        // and assign the count as its value
        $ProgCounts['$' . $prog] = $Progcount;
    }
}$programme_ysem = array('DBM', 'DIT', 'DPGM', 'DBIT', 'BCOM', 'BA-IR', 'DIR', 'DMTL', 'DSWCD', 'DAM', 'BSIT', 'BED-A');

// Initialize an associative array to store the variables
$ProgCounts_ysem1_2 = array();

foreach ($programme_ysem as $prog) {
    $clos = 1.20;

    $select = "SELECT COUNT(*) AS total_count FROM piu_registration_form_data WHERE prog=? AND clos=?";
    $stmt = $pdo->prepare($select);
    $stmt->bindParam(1, $prog);
    $stmt->bindParam(2, $clos);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $Progcount_ysem = $data['total_count'];

        // Create a variable name by adding a dollar sign before the school name
        // and assign the count as its value
        $ProgCounts_ysem1_2['$' . $prog] = $Progcount_ysem;
    }
}
$ProgCounts_ysem2_1 = array();

foreach ($programme_ysem as $prog) {
    $clos = 2.10;

    $select = "SELECT COUNT(*) AS total_count FROM piu_registration_form_data WHERE prog=? AND clos=?";
    $stmt = $pdo->prepare($select);
    $stmt->bindParam(1, $prog);
    $stmt->bindParam(2, $clos);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $Progcount_ysem = $data['total_count'];

        // Create a variable name by adding a dollar sign before the school name
        // and assign the count as its value
        $ProgCounts_ysem2_1['$' . $prog] = $Progcount_ysem;
    }
}
$ProgCounts_ysem2_2 = array();

foreach ($programme_ysem as $prog) {
    $clos = 2.20;

    $select = "SELECT COUNT(*) AS total_count FROM piu_registration_form_data WHERE prog=? AND clos=?";
    $stmt = $pdo->prepare($select);
    $stmt->bindParam(1, $prog);
    $stmt->bindParam(2, $clos);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $Progcount_ysem = $data['total_count'];

        // Create a variable name by adding a dollar sign before the school name
        // and assign the count as its value
        $ProgCounts_ysem2_2['$' . $prog] = $Progcount_ysem;
    }
}
// Initialize an associative array to store the variables
$ProgCounts_ysem3_1 = array();

foreach ($programme_ysem as $prog) {
    $clos = 3.10;

    $select = "SELECT COUNT(*) AS total_count FROM piu_registration_form_data WHERE prog=? AND clos=?";
    $stmt = $pdo->prepare($select);
    $stmt->bindParam(1, $prog);
    $stmt->bindParam(2, $clos);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $Progcount_ysem = $data['total_count'];

        // Create a variable name by adding a dollar sign before the school name
        // and assign the count as its value
        $ProgCounts_ysem3_1['$' . $prog] = $Progcount_ysem;
    }
}
$ProgCounts_ysem3_2 = array();

foreach ($programme_ysem as $prog) {
    $clos = 3.20;

    $select = "SELECT COUNT(*) AS total_count FROM piu_registration_form_data WHERE prog=? AND clos=?";
    $stmt = $pdo->prepare($select);
    $stmt->bindParam(1, $prog);
    $stmt->bindParam(2, $clos);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $Progcount_ysem = $data['total_count'];

        // Create a variable name by adding a dollar sign before the school name
        // and assign the count as its value
        $ProgCounts_ysem3_2['$' . $prog] = $Progcount_ysem;
    }
}



$ProgCounts_ysem4_1 = array();

foreach ($programme_ysem as $prog) {
    $clos = 4.10;

    $select = "SELECT COUNT(*) AS total_count FROM piu_registration_form_data WHERE prog=? AND clos=?";
    $stmt = $pdo->prepare($select);
    $stmt->bindParam(1, $prog);
    $stmt->bindParam(2, $clos);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $Progcount_ysem = $data['total_count'];

        // Create a variable name by adding a dollar sign before the school name
        // and assign the count as its value
        $ProgCounts_ysem4_1['$' . $prog] = $Progcount_ysem;
    }
}
$ProgCounts_ysem4_2 = array();

foreach ($programme_ysem as $prog) {
    $clos = 4.20;

    $select = "SELECT COUNT(*) AS total_count FROM piu_registration_form_data WHERE prog=? AND clos=?";
    $stmt = $pdo->prepare($select);
    $stmt->bindParam(1, $prog);
    $stmt->bindParam(2, $clos);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $Progcount_ysem = $data['total_count'];

        // Create a variable name by adding a dollar sign before the school name
        // and assign the count as its value
        $ProgCounts_ysem4_2['$' . $prog] = $Progcount_ysem;
    }
}
$finance = "SELECT COUNT(*) as requests FROM finance_form;";
$stmt = $pdo->prepare($finance);

$stmt->execute();

$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($data) {
    $requests = $data['requests'];
    $request = "SELECT COUNT(*) as number_of_requests FROM finance_form WHERE request=1;";
    $stmt = $pdo->prepare($request);
    $stmt->execute();
    $count = $stmt->fetch(PDO::FETCH_ASSOC);

    $number_of_requests = $count['number_of_requests'];
} else {
    $number_of_requests = " NO DATA!";
}

$display = "SELECT COUNT(*) as rejected FROM finance_form WHERE details_rejected='rejected';";
$stmt = $pdo->prepare($display);

$stmt->execute();

$data = $stmt->fetch(PDO::FETCH_ASSOC);

$rejected = $data['rejected'];
$display = "SELECT COUNT(*) as approved FROM finance_form WHERE details_approved='Approved';";
$stmt = $pdo->prepare($display);

$stmt->execute();

$data = $stmt->fetch(PDO::FETCH_ASSOC);

$approved = $data['approved'];}else{header("location:../staff/staff.php");}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Data</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="resources/css/reg-data.css">
</head>
<body>
    <div class="container-card">
        <div class="card logo">
            <div class="img">
                <img src="resources/img/PIU-LOGO-WHITE.png" alt="">
            </div>
            <div class="dash">
                <h1>Registration Data</h1>
            </div>
        </div>
        <div class="card">
            <div class="h1">
                <p style="display: flex;
    justify-content: center;
    align-items: center;"><i class="material-icons" id="logOut" style="font-size: 20px; color: purple;">person</i>Total number of registered students : <?php echo $trs; ?></p>  
            </div>
        </div>

        <div class="card">
            <h2>Schools</h2>
            <div class="Schools">
                <ol>
                    <li>
                        <p><a href="StudentRegister/2024/SICT/" target="_blank" rel="noopener noreferrer">SCHOOL OF INFORMATION & COMMUNICATION TECHNOLOGY (SICT)</a>: <?php echo $schoolCounts['$SICT']; ?></p>
                    </li>
                    <li>
                        <p><a href="StudentRegister/2024/SDSS/" target="_blank" rel="noopener noreferrer">SCHOOL OF DEVELOPMENT & STRATEGIC STUDIES (SDSS)</a>: <?php echo $schoolCounts['$SDSS']; ?></p>
                    </li>
                    <li>
                        <p><a href="StudentRegister/2024/SBM/" target="_blank" rel="noopener noreferrer">SCHOOL OF BUSINESS & MANAGEMENT (SBM)</a>: <?php echo $schoolCounts['$SBM']; ?></p>
                    </li>
                    <li>
                        <p><a href="StudentRegister/2024/SEDU/" target="_blank" rel="noopener noreferrer">SCHOOL OF EDUCATION (SEDU)</a>: <?php echo $schoolCounts['$SEDU']; ?></p>
                    </li>
                    <li>
                        <p><a href="StudentRegister/2024/SAMS/" target="_blank" rel="noopener noreferrer">SCHOOL OF AEROSPACE & MARITIME STUDIES (SAMS)</a>: <?php echo $schoolCounts['$SAMS']; ?></p>
                    </li>
                </ol>

<br>
<br>
                <div class="exceldata">
                    <a href="SICT.php" target="_blank" rel="noopener noreferrer">Downloads</a>
                    <?php $_SESSION['data.php']=true;?>
                </div>
            </div>
            <div class="data-container">
                <?php
                $programs = array('BSIT', 'BED-A', 'BCOM', 'BA-IR', 'DIR', 'DMTL', 'DSWCD', 'DAM', 'DBM', 'DIT', 'DPGM', 'DBIT');
                foreach ($programs as $program) {
                    $store = "$" . $program;
                    echo '<div class="dataTable">';
                    echo '<table>';
                    echo '<caption style="background: grey;">TOTAL ' . $program . ' -> (' . $ProgCounts[$store] . ')</caption>';
                    echo '<caption>REGISTRATION DATA BY ' . $program . '</caption>';
                    echo '<tr>';
                    echo '<th>PROGRAMME</th>';
                    echo '<th>YEAR/SEM</th>';
                    echo '<th>Number</th>';
                    echo '</tr>';
                    // Generate rows for different year/semester
                    $yearSemesters = array('1.2','2.1','2.2','3.1','3.2','4.1','4.2',);
                    foreach ($yearSemesters as $yearSemester) {
                        echo '<tr>';
                        echo '<td>' . $program . '</td>';
                        echo '<td>' . $yearSemester . '</td>';
                        $variableName = 'ProgCounts_ysem' . str_replace('.', '_', $yearSemester);
                        echo '<td>' . $$variableName[$store] . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <div class="card">
            <p>FINANCE AUTHORIZATION TOTAL REQUESTS: <?php echo $requests; ?></p>
            <p>APPROVED: <?php echo $approved; ?></p>
            <p>REJECTED: <?php echo $rejected; ?></p>
            <p>UNFULFILLED: <?php echo $number_of_requests; ?></p>
        </div>
    </div>
</body>
</html>
