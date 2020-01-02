<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$servername = "160.153.57.72";
$username = "intecare_user";
$password = "password1";
$dbname = "intecare-rosters";
$appTitle = "Indiana Mental Health Funds Recovery Program";


function SetPeriod($period)
{
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "UPDATE  `intecare-rosters`.`options` SET  `value` =  '" . $period . "' WHERE  `options`.`optionId` =1;";
    $result = $conn->query($sql);
    
    $conn->close();
}

function PeriodStart($period)
{
    //Sets the date to exclude employees based on StartDate. Choose employee startDate less than or equal to the next period start date
    $periodParts = explode("-", $period);
    
    $year = $periodParts[0];
    $quarter = $periodParts[1];
    
    switch($quarter) {
        case "Q1":
            $cutoff = $year . '-1-1';
            break;
        case "Q2":
            $cutoff = $year . '-4-1';
            break;
        case "Q3":
            $cutoff = $year . '-7-1';
            break;
        case "Q4":
            $cutoff = $year . '-10-1';
            break;
    }
    
    return $cutoff;
}

function NextPeriodStart($period)
{
    //sets the date to exclude employees based on their EndDate.  Choose employee endDate greater than or equal to the next period start date 
    $periodParts = explode("-", $period);
    
    $year = $periodParts[0];
    $quarter = $periodParts[1];
    
    switch($quarter) {
        case "Q1":
            $nextPeriod = $year . '-4-1';
            break;
        case "Q2":
            $nextPeriod = $year . '-7-1';
            break;
        case "Q3":
            $nextPeriod = $year . '-10-1';
            break;
        case "Q4":
            $nextPeriod = $year+1 . '-1-1';
            break;
    }
    
    return $nextPeriod;
}

function PreparePeriod($period)
{
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    //run script to select all employees from the agency-employee table that does not have an end date filled and copy them to agency-data table with the selected period.  Also set the current Period on the options table.
    $sql = "SELECT * FROM `agency-employees` WHERE `Active` = 1 AND (`StartDate` <= '" . NextPeriodStart($period) . "' OR `EndDate` < '". PeriodStart($period) ."')";
      //$sql = "SELECT * FROM `agency-employees` where `StartDate` < '". CalculateEmployeeCutOff($period) . "'";

    $result = $conn->query($sql);
    
    $sql2 = "";
    while ($row = $result->fetch_assoc()) 
    {
        $sql2 = "INSERT INTO `agency-data` (`Period`, `InteCareAgencyID`, `Email`, `PositionTitle`, `IdNumber`, `LocationCode`) VALUES ('" . $period . "','" . $row['InteCareAgencyID'] . "','" . $row['Email'] . "','" . $row['PositionID'] . "','" . $row['IdNumber'] . "','" . $row['LocationCode'] . "'); ";
        $result2 = $conn->query($sql2);      
    }
    
    if(!$result2)
    {
        echo $conn->error;
        $conn->close();
    }
    else
    {
        $conn->close();
        return "Records for the new time study period have been successfully set up.";
    }
    
}

function PreparePeriodBackUp($period)
{
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    //run script to select all employees from the agency-employee table that does not have an end date filled and copy them to agency-data table with the selected period.  Also set the current Period on the options table.
    $sql = "SELECT * FROM `agency-employees` WHERE `StartDate` <= '" . NextPeriodStart($period) . "' OR `EndDate` < '". PeriodStart($period) ."'";
      //$sql = "SELECT * FROM `agency-employees` where `StartDate` < '". CalculateEmployeeCutOff($period) . "'";
   
    $result = $conn->query($sql);
    
    $sql2 = "INSERT INTO `agency-data` (`Period`, `InteCareAgencyID`, `Email`, `PositionTitle`, `IdNumber`, `LocationCode`) VALUES ";
    while ($row = $result->fetch_assoc()) 
    {
        $sql2 = $sql2 .  "('" . $period . "','" . $row['InteCareAgencyID'] . "','" . $row['Email'] . "','" . $row['PositionID'] . "','" . $row['IdNumber'] . "','" . $row['LocationCode'] . "'), ";
    }
 
    $sql2 =  substr($sql2, 0, -1);
    $sql2 =  substr($sql2, 0, -1);
    //echo $sql2; exit;
    $result2 = $conn->query($sql2);
    if(!$result2)
    {
        echo $conn->error;
        $conn->close();
    }
    else
    {
        $conn->close();
        return "Records for the new time study period have been successfully set up.";
    }
    
}

function GetAdminPassword($email)
{
	global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    } 

	$sql = "SELECT `password` FROM `admin-login`  WHERE `email` = '" . $email . "'";
	$result = $conn->query($sql);
 
    $row=mysqli_fetch_row($result);
    $conn->close();
		
	return $row[0];
 
}	

function GetTimeStudyPeriods()
{
	global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    } 

	$sql = "SELECT DISTINCT(`period`) FROM `agency-data`";
	$result = $conn->query($sql);
 
    $conn->close();
		
	return $result;

}	

function GetPeriod()
{
	global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    } 

	$sql = "SELECT `value` FROM `options` WHERE `option` LIKE 'current-time-study'";
	$result = $conn->query($sql);
 
    $row=mysqli_fetch_row($result);
    $conn->close();

	return $row[0];
 
}

function SetOpenForDataEntry()
{
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    } 
    $open = '1';
    $sql = "UPDATE  `intecare-rosters`.`options` SET  `value` =  '" . $open . "' WHERE  `options`.`optionId` =2;";
    $result = $conn->query($sql);
    
    $conn->close();
}

function InitiateTimeStudy()
{
    SetPeriod($_POST['period']);

    //2. Set the application open for data entry
    SetOpenForDataEntry();

    //2. run script to select all employees from the agency-employee table that does not have an end date filled and copy them to agency-data table with the selected period.  Also set the current Period on the options table.
    echo PreparePeriod($_POST['period']);
}

function SetLock($option)
{
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "UPDATE `options` SET `value` = '" . $option . "' WHERE `option` = 'locked'";
    $result = $conn->query($sql);
    
    $conn->close();
}

function GetAgencyAll() {
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT `AgencyId`,`AgencyName` FROM `agencies`";
    $result = $conn->query($sql);
    $conn->close();

    return $result;
}
?>