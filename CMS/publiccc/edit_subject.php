<?php $layout_context = "admin"; ?>

<?php include("../layouts/Headers.php"); ?>
<?php include("../includes/dbms.php"); ?>
<?php include("../includes/functions.php"); ?>
<div id="header">
<h1> Widget Corp Admin</h1>

</div>

<div id="main">



<div id="navigation">

<?php

	display_all(0);
	
	$output = navigation($current_subject, $current_page ) ;
	
	echo ("$output");
	
?>

</div>

<div id ="page">

<?php 
		/*if ( !isset($_GET['sub']) )
			{redirect_to ("http://localhost/publiccc/login.php") ;
			}*/
			
		if ( !isset($_SESSION['username']) ){
		
			redirect_to ("http://localhost/publiccc/login.php") ;
		}
			
	
?>


<table id="username"><tr><td>Welcome <?php echo( htmlentities($_SESSION['username']) );?></td><td width="10"></td><td><a href="http://localhost/publiccc/Logout.php"> Logout </a></td></tr></table> 
<?php
	if ( isset($_GET['del']) ){
		
		$result = delete_subject($_GET['subject']) ;
		//echo("fg");
		if ( $result )
			{
				$_SESSION['message'] = "Subject Deleted ";
			 	redirect_to("http://localhost/publiccc/Manage_Contents.php");
			}
		else{
				$_SESSION['message'] = "Subject With pages can't be Deleted ";
			 	redirect_to("http://localhost/publiccc/edit_subject.php?subject={$_GET['subject']}");
		}
		
	}
	else if ( isset($_GET['submit_edit']) ){
		
		if ( $_GET['radio'] == "Yes" ) {
			$vis = 1 ;
		}
		else{
			$vis = 0 ;
		}
		//echo($_GET['content']);
		edit_subject($_GET['subject'] , $vis , $_GET['select'] , $_GET['name'] , $_GET['content'], $_GET['pos'] ) ;
		$_SESSION['message'] = "Subject Updated ";
		redirect_to("http://localhost/publiccc/Manage_Contents.php?subject={$_GET['subject']}");
	}
	else if (  isset($_GET['submit_add']) ) {
		if ( $_GET['radio'] == "Yes" ) {
			$vis = 1 ;
		}
		else{
			$vis = 0 ;
		}
		//echo ( $_GET['pos'] ) ;
		$id = add_subject($_GET['subject'] , $vis , $_GET['select'] , $_GET['name'] , $_GET['content'] , $_GET['pos']) ;
		//echo($id);
		$_SESSION['message'] = "Subject Created ";
		redirect_to("http://localhost/publiccc/Manage_Contents.php?subject={$id}");
		
	}
	else{
	
	if ( $_SESSION['message'] !== "" ){
	
		echo ( message() ) ;
	}
	
	if ( isset($_GET['subject']) ){
	$output = "<h2>Edit Subject:";
	$result = find_selected_subject($_GET['subject']);
	$output .= $result['name'];	
	
	$output .= "</h2><br /><br />";
	
	$output .= "<form action=\"#\" method=\"get\" >"; 
	
	$output .= "Menu Name: ";
	$output .= "<input type=\"text\" name=\"name\" id=\"name\" value=\"{$result['name']}\"/>";


	$output .= "<br /><br />Position: ";
 	$output .= "<select name=\"select\" value=\"{$result['pos']}\">";
	
	$i = 1 ;
	$count = count_rows_subject( $_GET['subject'] ) ;
	
	while ($count > 0)
	{	$output .= "<option>$i</option>"; $i++; $count--; }
	$output .= "</select>";
	
	$output .= "<br /><br />Visible: " ;
	$output .= "<input type=\"radio\" name=\"radio\" value=\"Yes\"";
	
	if ( $result['vis'] ){
	
		$output .= " checked" ;
	}
	
	$output .= " /> Yes ";
	
	$output .= "<input type=\"radio\" name=\"radio\" value=\"No\"";
	
	if ( !$result['vis'] ){
	
		$output .= " checked" ;
	}
	
	$output .= " /> No ";
	
	$output .= "<br /><br />Content: ";
	$output .= "<input type=\"text\" name=\"content\" id=\"content\" value=\"{$result['content']}\"/>";
	
	$output .= "<br /><br /><input type=\"submit\" name=\"submit_edit\" id=\"submit_edit\" value=\"Edit Subject\" />";
	$output .= "<input type=\"hidden\" name=\"subject\" id=\"subject\" value=\"{$_GET['subject']}\" />";
	$output .= "<input type=\"hidden\" name=\"pos\" id=\"pos\" value=\"{$result['pos']}\" />";
	$output .= "</form>";
	
	$output .= "<br /><br /><a href=\"http://localhost/publiccc/edit_subject.php?subject={$_GET['subject']}&del=1";
	$output .= "\" onclick=\"return confirm('ARE YOU SURE')\">  Delete This Page </a>";
	
	$output .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href=\"http://localhost/publiccc/Manage_Contents.php?subject=";
	$output .= urlencode($_GET['subject']);
	$output .= "\">  Cancel </a>";
	}
	else{
	//echo("FDF");	
	$output = "<h2>Add Subject: ";
	$output .= "</h2><br /><br />";
	
	$output .= "<form action=\"#\" method=\"get\" >"; 
	
	$output .= "Menu Name: ";
	$output .= "<input type=\"text\" name=\"name\" id=\"name\" />";


	$output .= "<br /><br />Position: ";
 	$output .= "<select name=\"select\" >";
	
	$query = "SELECT * FROM subject";
	
	$result = mysqli_query($connect,$query);
	
	$count = mysqli_num_rows($result);
	$i = 1 ;
	while ($count > 0)
	{	$output .= "<option>$i</option>"; $i++; $count--; }
	$output .= "<option>$i</option>";
	$output .= "</select>";
	
	$output .= "<br /><br />Visible: " ;
	$output .= "<input type=\"radio\" name=\"radio\" value=\"Yes\" checked";
	$output .= " /> Yes ";
	
	$output .= "<input type=\"radio\" name=\"radio\" Value=\"No\" ";
	$output .= " /> No ";
	
	$output .= "<br /><br />Content: ";
	$output .= "<input type=\"text\" name=\"content\" id=\"content\" />";
	
	$output .= "<br /><br /><input type=\"submit\" name=\"submit_add\" id=\"submit_add\" value=\"Add Subject\"/>";
	$output .= "<input type=\"hidden\" name=\"pos\" value=\"{$i}\" />";
	$output .= "</form>";
		
	$output .= "<br /><br /><a href=\"http://localhost/publiccc/Manage_Contents.php";
	$output .= "\">  Cancel </a>";
	
	}
	echo($output);
	}
?>


</div>
</div>

<div id="footer"> @copy right reserved </div>

<?php include("../layouts/footers.php") ?>

