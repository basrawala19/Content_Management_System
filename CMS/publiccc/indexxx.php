
<?php $layout_context = "public"; ?>

<?php include("../layouts/Headers.php"); ?>
<?php include("../includes/dbms.php"); ?>
<?php include("../includes/functions.php"); ?>
<div id="header">
<h1> Widget Corp Public</h1>

</div>

<div id="main">



<div id="navigation">

<?php

	display_all();
	
	$output = public_navigation($current_subject, $current_page ) ;
	
	echo ("$output");
	
?>

</div>

<div id ="page">

<table id="username" style="font-size:16px"><tr><td height="50"><a href="http://localhost/publiccc/login.php">Admin Area Login</a></td></tr></table>

<?php
	display_content($current_subject, $current_page ) ;
?>
</div>
</div>

<div id="footer"> @copy right reserved </div>

<?php include("../layouts/footers.php") ?>

