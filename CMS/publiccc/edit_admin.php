
<?php $layout_context = "admin"; ?>

<?php include("../layouts/Headers.php"); ?>
<?php include("../includes/dbms.php"); ?>
<?php include("../includes/functions.php"); ?>
<?php include("../includes/validation_functions.php"); ?>
<div id="header">
<h1> Widget Corp Admin</h1>

</div>

<div id="main">



<div id="navigation">

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
	$errors = array() ;
	
	if ( isset($_GET['un']) ){
	
		$required_feilds = array( "un" => 32 , "pd" => 8 ) ;
		validate_presence ( $required_feilds ) ;
	} 
	if ( empty($errors) ){
		if ( isset($_GET['Add']) ){
			$_SESSION['message'] = "Admin Created";
			add_admin($_GET['un'],$_GET['pd']);
		}
	
		else if (isset($_GET['Edit']) ){
			$_SESSION['message'] = "Admin Updated";
			edit_admin($_GET['id'],$_GET['un'],$_GET['pd']);
		
		}
		else if ( isset($_GET['del'] ) ){
			$_SESSION['message'] = "Admin Deleted";
			delete_admin($_GET['id']) ;
		
		}
	}else{
		echo ( form_errors( $errors ) ) ;
	}
		

	if ( isset($_GET['id']) ) {
			$admin = get_selected_admin($_GET['id']);
			echo ("<h2>Edit Admin: ".$admin['un']."</h2>");
	}
	else{
		echo ("<h2>Create Admin</h2>");
	}
?>
<br />
<form action="#" method="get"> 
<table cellspacing="8" cellpadding="0" >
	<tr><td >Username : </td><td><input type="text" name="un" id="un" <?php 
	
	if ( isset($_GET['id']) ) {
		echo ("value=\"{$admin['un']}\""); 
	}
	
	?> /></td>
	<tr><td>Password : </td><td><input type="password" name="pd" id="pd"/></td>
	<tr><td><input type="submit"
	<?php 
	
	if ( isset($_GET['id']) ) {
		echo(" name=\"Edit\" ");
		echo ("value=\"Edit Admin\" />"); 
		echo("<input type=\"hidden\" name=\"id\" value=\"{$_GET['id']}\" />");
		 
	}else{
		echo(" name=\"Add\" ");
		echo ("value=\"Create Admin\"  />");
	}
		
	
	?>
	</td></tr>
</table>	

</form>
<?php


if ( empty($errors) && (isset($_GET['Add']) || isset($_GET['Edit']) || isset($_GET['del'])) ){
	redirect_to("http://localhost/publiccc/Manage_Admins.php");
}

?>
</div>
</div>

<div id="footer"> @copy right reserved </div>

<?php include("../layouts/footers.php") ?>

