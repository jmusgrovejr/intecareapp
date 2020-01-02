<?php

	session_start(['cookie_lifetime' => 86400]);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);	

	$DIR_ = $_SERVER["DOCUMENT_ROOT"];
	require($DIR_. "/config.php");
 
        if (IDExists($_GET['id']))
        {
            echo 'exists';
        }
        else
        {    
           echo 'unique.'; 
        }
?>
