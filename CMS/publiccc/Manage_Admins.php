<?php $layout_context = "admin"; ?>

<?php include("../layouts/Headers.php"); ?>
<?php include("../includes/dbms.php"); ?>
<?php include("../includes/functions.php"); ?>
<div id="header">
<h1> Widget Corp Admin</h1>

</div>

<div id="main">
<div id="navigation">
<br />
<br />
<a href="../publiccc/Admin.php"> >>main menu </a>
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


	<?php echo(message()); ?>

	<table id="username"><tr><td>Welcome <?php echo( htmlentities($_SESSION['username']) );?></td><td width="10"></td><td><a href=		    "http://localhost/publiccc/Logout.php"> Logout </a></td></tr></table> 
	<h2>Manage Admins</h2>
	<br />
	<table>
	<tr><th style="width:200px; text-align:left;">Username</th><th>Actions</th></tr>
	<?php
	
	$result = get_all_admins();
	$output = "";
	while ( $row = mysqli_fetch_assoc($result) ) {
		
		$output .= "<tr><td>{$row['un']}</td><td>";
		$output .= "<a href=\"http://localhost/publiccc/edit_admin.php?id=";
		$output .= urlencode($row['id']);
		/*$output .= "&pd=";
		$output .= urlencode($row['pd']);*/
		$output .= "\">Edit</a>&nbsp;<a href=\"http://localhost/publiccc/edit_admin.php?id=";
		$output .= urlencode($row['id']);
		$output .= "&del=1\" onclick=\"return confirm('ARE YOU SURE')\">Delete</a></td></tr>"; ;
		
	}
	
	$output .= "</table><br /><br />";
	$output .= "<a href=\"http://localhost/publiccc/edit_admin.php\">+Add New Admin</a>";
	
	echo($output);
	?>
	
</div>
</div>

<div id="footer"> @copy right reserved </div>

<?php include("../layouts/footers.php") ?>

