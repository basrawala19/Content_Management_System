<?php $layout_context = "admin"; ?>

<?php include("../layouts/Headers.php"); ?>
<?php include("../includes/dbms.php"); ?>
<?php include("../includes/functions.php"); ?>
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
	<h2>Admin Menu </h2>
	
	<p>Welcome to the admin area, <?php echo ( htmlspecialchars($_SESSION['username']) )?></p>
	
	<ul class="admins">
	
	<li><a href="../publiccc/Manage_Contents.php" > Manage Website Content</a></li>
	
	<li><a href="../publiccc/Manage_Admins.php" > Manage Admin Users </a></li>

	<li><a href="../publiccc/Logout.php" >LOGOUT </a></li>
	
</ul></div>
</div>

<div id="footer"> @copy right reserved </div>

<?php include("../layouts/footers.php") ?>

