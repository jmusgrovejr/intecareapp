<?php

	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);	

	require("functions.php");
	
	$dbpassword = GetAdminPassword($_POST['email1']);
	$password = $_POST['password1'];
	
	if (password_verify($password, $dbpassword))
	{
		$_SESSION['userToken'] = $_POST['email1'];	
                    
                        
		echo 'Successfully Logged in...';
	}
	else
	{
		echo 'Email or Password is wrong...!!!!';
	}
?>