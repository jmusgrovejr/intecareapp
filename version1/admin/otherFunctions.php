<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$servername = "160.153.57.72";
$username = "intecare_user";
$password = "password1";
$dbname = "intecare-rosters";
$appTitle = "Indiana Mental Health Funds Recovery Program";


function IsLocked() {

    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT `value` FROM `options` WHERE `option` = 'locked'";

    $result = $conn->query($sql);

    $row = mysqli_fetch_row($result);
    $conn->close();

    return $row[0];
}

function GetPassword($email) {
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT `password` FROM `admin-login`  WHERE `email` = '" . $email . "'";
    $result = $conn->query($sql);

    $row = mysqli_fetch_row($result);
    $conn->close();

    return $row[0];
}