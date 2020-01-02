<?php
	
foreach(array_keys($_SESSION) as $k) unset($_SESSION[$k]);
session_destroy();

//expire all cookies from the site

header("Location: index.php");

?>