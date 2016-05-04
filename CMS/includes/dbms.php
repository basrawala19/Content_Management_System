<?php

$connect = mysqli_connect("localhost","root","","cms");

if ( mysqli_connect_errno() ){
	
		die("some error occured".mysqli_connect_errno());
	
}
?>