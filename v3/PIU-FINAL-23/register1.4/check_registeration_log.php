<?php
@require_once '../session_security.php';
@require_once '../config.php';

try {
    $select = "SELECT * FROM students_form WHERE id = ?";
    $stmt = $pdo->prepare($select);
    $stmt->bindParam(1, $_SESSION['student_id']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $check_if_reg = $result['has_registered'];
        if ($check_if_reg == 1) {
            echo '<script>
                alert("You have already Registered.Pioneer International University.Powered by Intellect Driven by Values.");
                setTimeout(function() {
                    window.location.href = "../portal.php";
                }, 10); 
            </script>';
        } elseif ($check_if_reg == 0) {
            header('location: registration.php');
        }
    }
} catch (PDOException $e) {
    die("Failed: " . $e->getMessage());
}
