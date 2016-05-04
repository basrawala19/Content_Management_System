<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>
<?php 

if ( $layout_context == "admin" ){

	echo("Widget Corp Admin");
} 
else{

	echo("Widget Corp Public"); 
}
?>

</title>
<link rel="stylesheet" type="text/css" href="../Style sheets/style.css"> 
</head>

<body>
<?php
session_start();
?>