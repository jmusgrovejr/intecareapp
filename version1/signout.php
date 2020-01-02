<?php
	
foreach(array_keys($_SESSION) as $k) unset($_SESSION[$k]);
session_destroy();

//expire all cookies for the site.
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}

header("Location: http://www.intecareapp.com");

?>