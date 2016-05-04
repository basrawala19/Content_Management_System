<?php $layout_context = "admin"; 

$errors = array();
?>
<?php
include("../layouts/Headers.php");
include("../includes/dbms.php") ;
include("../includes/functions.php") ;
include("../includes/validation_functions.php") ;
?>

<div id="header">
<h1> Widget Corp Login</h1>

</div>

<div id="main">



<div id="navigation">
</div>

<div id ="page">

<table id="username" style="font-size:16px"><tr><td height="50"><a href="http://localhost/publiccc/indexxx.php">Public Area</a></td></tr></table>

<?php 
	
	$_SESSION['message'] = "";
	$username ="";
	
	if ( isset($_GET['sub']) ){
		
		//$result = attempt_login ( $_GET['un'] , $_GET['pd'] ) ;
		
		$username = $_GET['username'];
		$password = $_GET['password'];
		
		$query = "SELECT * FROM admin WHERE un = '{$_GET['username']}' AND pd = '{$_GET['password']}'";
		
		//echo("$query");
		$result = mysqli_query($connect,$query);
		
		$required_feilds = array( "username" => 32 , "password" => 8 ) ;
		
		validate_presence ( $required_feilds ) ;
		
		if ( $admin = mysqli_fetch_assoc($result)){
			$_SESSION['id'] = $admin['id'];
			$_SESSION['username'] = $admin['un'] ;
			//$_SESSION['message'] = "Login Successful";
			redirect_to("../publiccc/Admin.php");
		}
		else if ( empty($errors) ){
			$_SESSION['message'] = "incorrect username/password<br /><br />" ;
		}
		
	} 
	
	echo (message());
	
	echo ( form_errors($errors) ) ;

?>
<form action="#" method="get"> 
<h2>Login</h2>
<br />
<table cellspacing="5" cellpadding="0">
	<tr><td >Username : </td><td><input type="text" name="username"  value="<?php echo($username);?>"/></td>
	<tr><td>Password : </td><td><input type="password" name="password" /></td>
	<tr><td><input type="submit" name="sub" id="sub" value="Submit"/></td></tr>
</table>	

</form>

</div>
</div>

<div id="footer"> @copy right reserved </div>

<?php include("../layouts/footers.php"); ?>