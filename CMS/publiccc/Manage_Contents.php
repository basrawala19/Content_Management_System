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

<?php echo(message());?>


<?php 
	
	if(isset($_GET['subject'])){
		
		$output = "<h2>Manage Subject </h2>";
		
		$result = find_selected_subject($_GET['subject']);
		
		$output .= "<ul class=\"subject\"><li>Menu Name: ";
		$output .= $result['name'];
		$output .= "</li><li>";
		$output .= "<li>Position: ";
		$output .= $result['pos'];
		$output .= "</li><li>";
		$output .= "<li>Visibility: ";
		$output .= $result['vis'];
		$output .= "</li></ul>";
		
		$output .= "<a href=\"http://localhost/publiccc/edit_subject.php?subject=";
		$output .= urlencode("{$_GET['subject']}");
		$output .= "\">Edit Subject</a><br /><br />";
		
 		$output .= "________________________________";
		
		$output .= "<br /><br /><h3>Pages in this subject</h3>";
		
		$output .= find_all_pages($_GET['subject']);
		
		$output .= "<br />";
		
		$output .= "<a href=\"http://localhost/publiccc/edit_page.php?subject={$_GET['subject']}";
		$output .= "\"> + Add a new page to this subject </a>";
	}
	else if ( isset($_GET['page']) ){
	
		$output = "<h2>Manage Page </h2>";
		$result = find_selected_page($_GET['page']);
			
		$output .= "<ul class=\"subject\"><li>Menu Name: ";
		$output .= $result['name'];
		$output .= "</li><li>";
		$output .= "<li>Position: ";
		$output .= $result['pos'];
		$output .= "</li><li>";
		$output .= "<li>Visibility: ";
		$output .= $result['vis'];
		$output .= "<li>Content: ";
		$output .= "</li></ul>";
		$output .= "<block>{$result['content']}</block><br /><br /><br /><br />";
		
		$output .= "<a href=\"http://localhost/publiccc/edit_page.php?page=";
		$output .= urlencode("{$_GET['page']}");
		$output .= "\">Edit Page</a>";
	
	}
	
	else{ 

		$output = "<h2>Manage Content </h2><br />";
		$output .= "please select a subject or a page";
		
	}
		echo("$output");
	?>

</div>
</div>

<div id="footer" align="center">@copy right reserved </div>

<?php include("../layouts/footers.php") ?>

