<?php

include("../includes/functions.php") ;

session_start() ;

$_SESSION = array() ;

if ( isset($_COOKIE[session_name()]) ) {

	setcookie(session_name(),NULL,time()-36000);
}

session_destroy( ) ;
redirect_to ("http://localhost/publiccc/login.php");

?>