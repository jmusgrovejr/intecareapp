<?php
    require 'db.inc.php';

    $mhfrpid = $_GET['id'];
    $yes = 'yes';

    $sql = "SELECT * FROM employee_training WHERE mhfrpid = ?";
    $stmt = $conn->prepare($sql);
    mysqli_stmt_bind_param($stmt, "s", $mhfrpid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $completedEmp = mysqli_num_rows($result);

    if ($completedEmp == 0) {
        $sql2 = "INSERT INTO employee_training (mhfrpid, pdfComplete) VALUES (?, ?)";
        $stmt2 = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt2, $sql2);
        mysqli_stmt_bind_param($stmt2, "ss", $mhfrpid, $yes);
        mysqli_stmt_execute($stmt2);
    } else {
        $sql3 = "UPDATE employee_training SET pdfComplete = ? WHERE mhfrpid = ?";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param("si", $yes, $mhfrpid);
        $stmt3->execute();
        $stmt3->close();
    }

    header("Location: ../training?id=$mhfrpid&success=601");
?>