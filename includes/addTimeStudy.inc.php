<?php
    //error_reporting(E_ALL); ini_set('display_errors', 1);
    require 'db.inc.php';

    $timeData = $_POST;
    $dataCount = (sizeof($timeData) - 1) / 3;
    $day = $timeData["day"];
    //$mhfrpid = $_COOKIE['mhfrpid'];
    $mhfrpid = $_GET['id'];

    // Delete previous logs for that day
    $sql1 = "DELETE FROM employee_timestudy WHERE mhfrpid = ? AND log_day = ?";
    $stmt1 = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt1, $sql1);
    mysqli_stmt_bind_param($stmt1, "ss", $mhfrpid, $day);
    mysqli_stmt_execute($stmt1);
    $stmt1->close();

    // Then add in new logs
    for ($i = 0; $i < $dataCount; $i++) {
        $time = $timeData["time$i"];
        $code = $timeData["code$i"];
        $desc = $timeData["description$i"];

        $sql = "INSERT INTO employee_timestudy (mhfrpid, log_day, log_time, log_code, log_desc) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "issss", $mhfrpid, $day, $time, $code, $desc);
        mysqli_stmt_execute($stmt);
    }

    // Redirect to last saved page
    $sql0 = "SELECT log_day FROM employee_timestudy WHERE log_desc != '' ORDER BY date_added DESC LIMIT 1";
    $stmt0 = $conn->prepare($sql0);
    mysqli_stmt_execute($stmt0);
    $result0 = mysqli_stmt_get_result($stmt0);
    $currentDay = mysqli_fetch_all($result0)[0][0];
    $stmt0->close();

    header("Location: ../timestudy?id=$mhfrpid&d=$currentDay&success=401");
?>