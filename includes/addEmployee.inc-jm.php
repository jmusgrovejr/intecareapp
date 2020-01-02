<?php
    /* ADD NEW EMPLOYEE TO DATABASE (agency.php) */

    if (!isset($_POST['add-employee-submit'])) {
        require 'db.inc.php';

        // Get input fields from add employee form
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $positionId = $_POST['positionTitle'];
        $idNumber = $_POST['idNumber'];
        $stateId = $_COOKIE['agencyId'];
        $locationCode = $_POST['locationcode'];
        $mhfrpId = $_POST['mhfrpId'];
        $agencyEmployeeId = $_POST['agencyEmployeeId'];
        $employeeType = $_POST['employeeType'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $employeeStatus = $_POST['employeeStatus'];

        // Return with error if field is empty
        if (empty($firstname) || empty($lastname) || empty($email)) {
            header("Location: ../agency?error=201");
            exit();
        }

        // Get the next MHFRPID
        $sql5 = "SELECT `MHFRPID` FROM `agency_employees` WHERE `InteCareAgencyID` = ? ORDER BY `MHFRPID` DESC";
        $stmt5 = mysqli_stmt_init($conn);
        var_dump($sql5); exit;

        if (!mysqli_stmt_prepare($stmt5, $sql5)) {
            header("Location: ../?error=104");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt5, "i", $stateId);
            mysqli_stmt_execute($stmt5);
            $result5 = mysqli_stmt_get_result($stmt5);
            $row = mysqli_fetch_row($result5);

            $mhfrpId = $row[0] + 1;
        }



        // Check if email already exists
        $sql1 = "SELECT * FROM agency_employees WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql1)) {
            header("Location: ../?error=104");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                header("Location: ../agency?error=202");
                exit();
            } else {
                $sql2 = "INSERT INTO agency_employees (FirstName, LastName, Email, PositionID, IdNumber, InteCareAgencyID, LocationCode, MHFRPID, AgencyEmployeeID, EmployeeType, StartDate, EndDate, Active)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($sql2);
                $stmt->bind_param("ssssiisssissi", $firstname, $lastname, $email, $positionId, $idNumber, $stateId, $locationCode, $mhfrpId, $agencyEmployeeId, $employeeType, $startDate, $endDate, $employeeStatus);
                $stmt->execute();
                $stmt->close();

                mysqli_close($conn);

                header("Location: ../agency?success=201");
                exit();
            }
        }
    }
    else {
        header("Location: ../agency");
        exit();
    }
?>
