<?php
ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);	
session_start();

$DIR_ = $_SERVER["DOCUMENT_ROOT"]. "/Test/";
require("functions.php");

/*
if(!isset($_SESSION['userToken']))
{
	header ("Location: index.php");		
}
*/
//1. set the current time study value in the options table
SetPeriod($_POST['initatePeriod']);

//2. Set the application open for data entry
SetOpenForDataEntry();

//2. run script to select all employees from the agency-employee table that does not have an end date filled and copy them to agency-data table with the selected period.  Also set the current Period on the options table.
echo PreparePeriod($_POST['initatePeriod']);


?>