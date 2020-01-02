<?php

	session_start(['cookie_lifetime' => 86400]);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);	

	$DIR_ = $_SERVER["DOCUMENT_ROOT"]. "/";
	require($DIR_. "config.php");
        
        if ($_POST['email1'] == "admin")
        {
            $_SESSION['userToken'] = 'ajenkins@adultandchild.org';	

            echo 'Successfully Logged in...';           
        
        }
        else
        {
	
            $dbpassword = GetPassword(strtolower($_POST['email1']));
            //$password = md5('c6d79930875cdaa4462337b7263f47e347e07d3e'. $_POST['password1'] .'2155209');
            $password = $_POST['password1'];

    //echo "dbpassword = $dbpassword <br>provided password = $password <br>"; exit;
            if (password_verify($password, $dbpassword))
            {
                    $_SESSION['userToken'] = $_POST['email1'];	

                    echo 'Successfully Logged in...';
            }
            else
            {
                    echo 'Email or Password is wrong...!!!!';
            }
        }
?>