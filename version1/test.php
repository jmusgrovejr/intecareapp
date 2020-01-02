<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
$servername = "160.153.57.72";
$username = "intecare_user";
$password = "password1";
$dbname = "intecare-rosters";
$appTitle = "Indiana Mental Health Funds Recovery Program";





function GetRosterPositions($id)
{
	
	global $servername, $username, $password, $dbname;

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT count(a.PositionID) as `cnt`, a.PositionID, b.positionName FROM `agency-employees` a
			INNER JOIN `positions` b ON b.positionId = a.PositionID WHERE a.InteCareAgencyID = " . $id . " GROUP BY a.PositionID";
					
	$result = $conn->query($sql);

    $conn->close();
   var_dump($result);	
}	

GetRosterPositions('428');

?>