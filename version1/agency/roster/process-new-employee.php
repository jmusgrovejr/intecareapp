<?php

session_start(['cookie_lifetime' => 86400]);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$DIR_ = $_SERVER["DOCUMENT_ROOT"];
require($DIR_ . "/config.php");

/*if (IDExists($_POST['IdNumber']) > 0) {

    $active = 1;

    $email = $_POST['email'];
    $lastName = $_POST['lastname'];
    $firstName = $_POST['firstname'];
    $IdNumber = $_POST['IdNumber'];
    $positionId = $_POST['PositionID'];
    $mhfrpid = $_POST['mhfrpid'];
    $intecareAgencyId = $_POST['AgencyId'];
    $locationCode = $_POST['LocationCode'];
    $employeeType = $_POST['employeeType'];
    $AgencyEmployeeID = $_POST['AgencyEmployeeID'];

    $val = UpdateEmployeeDetailsAdmin($IdNumber);

    echo "Employee was successfully updated";

}
else {
*/
    //Check the value of the Active checkbox
    if (isset($_POST['email'])) {

        $servername = "160.153.57.72";
        $username = "intecare_user";
        $password = "password1";
        $dbname = "intecare-rosters";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $active = 1;

//            $email = $_POST['email'];
//            $lastName = $_POST['lastname'];
//            $firstName = $_POST['firstname'];
//            $IdNumber = $_POST['IdNumber'];
//            $positionId = $_POST['position'];
//            $mhfrpid = $_POST['mhfrpid'];
//            $intecareAgencyId = $_POST['agencyId'];
//            $locationCode = $_POST['locationCode'];
//            $employeeType = $_POST['employeetype'];
//            $AgencyEmployeeID = $_POST['AgencyEmployeeID'];

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $lastName = mysqli_real_escape_string($conn, $_POST['lastname']);
        $firstName = mysqli_real_escape_string($conn, $_POST['firstname']);
        $IdNumber = mysqli_real_escape_string($conn, $_POST['mhfrpid']);
        $positionId = mysqli_real_escape_string($conn, $_POST['PositionID']);
        $mhfrpid = mysqli_real_escape_string($conn, $_POST['mhfrpid']);
        $intecareAgencyId = mysqli_real_escape_string($conn, $_POST['AgencyId']);
        $locationCode = mysqli_real_escape_string($conn, $_POST['LocationCode']);
        $employeeType = mysqli_real_escape_string($conn, $_POST['employeeType']);
        $AgencyEmployeeID = mysqli_real_escape_string($conn, $_POST['AgencyEmployeeID']);


        $sql = "INSERT INTO `intecare-rosters`.`agency-employees`
            (`Email`, `LastName`, `FirstName`, `IdNumber`, `PositionID`, `MHFRPID`, `AgencyEmployeeID`, `InteCareAgencyID`, `LocationCode`, `EmployeeType`, `Active`, `StartDate`, `EndDate`)
            VALUES ('$email', '$lastName', '$firstName', $IdNumber,'$positionId','$mhfrpid', '$AgencyEmployeeID', '$intecareAgencyId', '$locationCode', $employeeType, '1', CURDATE(), NULL);";

        $result = $conn->query($sql);

        //$conn->close();
        if ($result)
        {
            echo "New employee was successfully created";
            header('Location: http://intecareapp.com/agency/roster/main.php?success=true');
        }
        else
            echo "Problem submitting the form data <br/>" . $result;

        $conn->close();
    //}
}
?>
