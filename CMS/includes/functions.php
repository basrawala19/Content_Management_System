<?php

function message(){
			
			$message  = $_SESSION['message'] ;
			$_SESSION['message'] = "" ;
			
			if ( $message === "" ) {
			
					return "" ;
			}
			$output = "<div style=\"width:220px; padding:6px; margin:0; border:2px solid #8D0D19;\">";
			$output .= "<h3>$message</h3>" ;
			$output .= "</div><br />";
			return $output;
}

function confirm ( $result ) {

	if ( !$result ) {
		die("some error occured ");
	}
}

function find_subjectid( $id ) {

	include("../includes/dbms.php") ;
	
	$query = "SELECT subject_id FROM page WHERE id = $id";
	$result = mysqli_query($connect,$query);
	confirm($result);
	$subject_id = mysqli_fetch_assoc($result);
	return $subject_id['subject_id'] ;
}

function count_rows_page ( $id ) {
	
	include("../includes/dbms.php") ;
	
	$subject_id = find_subjectid ( $id ) ;
	
	$query = "SELECT * FROM page WHERE subject_id = {$subject_id}"; 
	//echo("$query");
	$result = mysqli_query($connect,$query);
	
	confirm($result);
	
	$count = mysqli_num_rows($result); 
	//echo($count);
	return $count;

}

function count_rows_subject ( $id ) {
	
	include("../includes/dbms.php") ;
	
	$query = "SELECT * FROM subject"; 
	//echo("$query");
	$result = mysqli_query($connect,$query);
	
	confirm($result);
	
	$count = mysqli_num_rows($result); 
	//echo($count);
	return $count;

}


function delete_page ( $id ) {

	include("../includes/dbms.php") ;
	$query = "DELETE FROM page WHERE id = $id";
	$result = mysqli_query($connect,$query);
	confirm($result);
	
	$query = "UPDATE page SET id = id - 1 WHERE id > $id";
	$result = mysqli_query($connect,$query);
	confirm($result);

}

function delete_subject ( $id ) {

	include("../includes/dbms.php") ;
	
	$query = "SELECT * FROM page WHERE subject_id = $id";
	$result = mysqli_query($connect,$query);
	confirm($result);
	
	if ( $page = mysqli_fetch_assoc($result) ) {
		
		return 0;
	}
		
		$query = "DELETE FROM subject WHERE id = $id";
		$result = mysqli_query($connect,$query);
		confirm($result);
		
		$query = "UPDATE subject SET id = id - 1 WHERE id > $id";
		$result = mysqli_query($connect,$query);
		confirm($result);
		
		return 1 ;
	

}

function add_page ( $subject_id, $vis , $pos , $name , $content , $org_pos) {
	echo($org_pos);
	include("../includes/dbms.php") ;
	$query = "INSERT INTO page (subject_id, vis, id, pos, name, content) VALUES ('$subject_id', '$vis', '$org_pos', '$pos', '$name', '$content')" ;
	$result = mysqli_query ( $connect , $query ) ;
	confirm($result);
	return $org_pos ;
	

}
function edit_page( $id , $vis , $pos , $name , $content , $org_pos ) {
	
	include("../includes/dbms.php") ;
	$result = mysqli_query($connect,"UPDATE page SET vis = '$vis', pos = '$pos', content = '$content', name = '$name' WHERE id = $id");
	confirm($result);
}

function add_subject ( $subject_id, $vis , $pos , $name , $content , $org_pos) {

	include("../includes/dbms.php") ;
	$query = "INSERT INTO subject (vis, id, pos, name, content) VALUES ('$vis', '$org_pos', '$pos', '$name', '$content')" ;
	$result = mysqli_query ( $connect , $query ) ;
	confirm($result);
	
	return $org_pos ;
	

}
function edit_subject( $id , $vis , $pos , $name , $content , $org_pos ) {
	echo ( $content .$name ) ;
	include("../includes/dbms.php") ;
	$result = mysqli_query($connect,"UPDATE subject SET vis = '$vis', pos = '$pos', content = '$content', name = '$name' WHERE id = $id");
	confirm($result);
}

function find_selected_subject ( $id ) {

	global $connect ;
	//include("../includes/dbms.php") ;
	
	$query = "SELECT * FROM subject ";
	
	$query .= "WHERE id = $id ";
	
	$query .= "ORDER BY pos ASC"; 
	//echo("$query");
	$result = mysqli_query($connect,$query);
	
	confirm($result);
	
	if ( $subject = mysqli_fetch_assoc($result) ){
			return $subject;
	}
	return NULL ;
}

function find_selected_page ( $id ) {

	
	include("../includes/dbms.php") ;
	
	$query = "SELECT * FROM page ";
	
	$query .= "WHERE id = $id ";
	
	$query .= "ORDER BY pos ASC"; 
	//echo("$query");
	$result = mysqli_query($connect,$query);
	
	confirm($result);
	
	if ( $page = mysqli_fetch_assoc($result) ){
			return $page;
	}
	return NULL ;
}

function find_default_page ( $id ) {

	
	include("../includes/dbms.php") ;
	
	$query = "SELECT * FROM page ";
	
	$query .= "WHERE subject_id = $id ";
	
	$query .= "ORDER BY pos ASC"; 
	//echo("$query");
	$result = mysqli_query($connect,$query);
	
	confirm($result);
	
	if ( $page = mysqli_fetch_assoc($result) ){
			return $page;
	}
	return NULL ;
}

function display_all ( $public = true ) {

	global $current_subject ;
	global $current_page ;

	if ( isset($_GET['subject']) ){
	
		$current_subject = find_selected_subject( $_GET['subject'] ) ;
		if ( $public == true )
			{$current_page = find_default_page($_GET['subject']);}
		else 
			{$current_page = NULL ;}
		
	}
	else if (isset($_GET['page'])) {
			
			$current_subject = NULL ;
			$current_page = find_selected_page($_GET['page']) ;
	}
	else if ( !isset($_GET['subject']) ){
		$current_subject = NULL ;
		$current_page = NULL ;
	}
	

}

function find_all_pages( $id ) {

				include("../includes/dbms.php") ;
	
				$query = "SELECT * FROM page ";
				
				$query .= "WHERE subject_id = ";
				$query .= $id ;
				
				$query .= " ORDER BY pos ASC"; 
				//echo("$query");
				$result1 = mysqli_query($connect,$query);
				
				confirm($result1);
				
				$output = "<ul class=\"admins\">" ;
				
				while ($row1 = mysqli_fetch_assoc($result1)){
							//echo($row1['id'].$page_array['id']);
				$output .= "<li>" ;
				
				$output .= "<a href=\"http://localhost/publiccc/Manage_Contents.php?page=";
				$output .= urlencode("{$row1['id']}");
				$output .= "\"> {$row1['name']} </a></li>";
				
				}
				mysqli_free_result($result1);
				$output .= "</ul>" ;
	
		return $output ;
}

function get_selected_admin ( $id ) {

	include("../includes/dbms.php") ;
	
	$query = "SELECT * FROM admin ";
	$query .= "WHERE id = $id";
	$result = mysqli_query($connect,$query);
	
	confirm($result);
	
	if ( $admin = mysqli_fetch_assoc($result) ){
			return $admin;
	}
	return NULL ;
}

function get_all_admins ( ){

	include("../includes/dbms.php") ;
	
	$query = "SELECT * FROM admin";
				
	$result = mysqli_query($connect,$query);
	
	confirm($result);
	return $result ;

}

function edit_admin( $id , $un , $pd ) {

	include("../includes/dbms.php") ;
	$query = "UPDATE admin SET un = '$un', pd = '$pd' WHERE id = $id"; 
	
	$result = mysqli_query($connect,$query);
	
	confirm($result);


}

function add_admin ( $un , $pd ) {
	
	include("../includes/dbms.php") ;
	
	$query = "SELECT * FROM admin";
	$result = mysqli_query($connect,$query);
	$id = mysqli_num_rows($result);
	
	$id = $id + 1 ;
	
	$query = "INSERT INTO admin (id, un, pd) VALUES ('$id', '$un', '$pd')"; 
	$result = mysqli_query($connect,$query);
	confirm($result);

	
}

function delete_admin ( $id ) {

	include("../includes/dbms.php") ;
	
	$query = "DELETE FROM admin WHERE id = $id";
	$result = mysqli_query($connect,$query);
	confirm($result);
	
	$query = "UPDATE admin SET id = id-1 WHERE id > $id";
	$result = mysqli_query($connect,$query);
	confirm($result);

}

function navigation ( $subject_array , $page_array ) {

	include("../includes/dbms.php") ;
	
	$query = "SELECT * FROM subject ";
	
	$query .= "ORDER BY pos ASC"; 
	//echo("$query");
	$result = mysqli_query($connect,$query);
	
	confirm($result);
	
	$output = "<ul class=\"subject\">" ;
	while ($row = mysqli_fetch_assoc($result)){
		
		$output .= "<li" ;
			
			if ( isset( $subject_array ) && $subject_array['id'] == $row['id'] ){
				$output .= " class=\"selected\"" ;
			}
			
		$output .= ">";
		
		$output .= "<a href=\"http://localhost/publiccc/Manage_Contents.php?subject=";
		$output .= urlencode($row['id']);
		$output .= "\">" ;
		$output .= $row['name'];
		$output .= "</a>";$output .= "</li>";
				
				$query = "SELECT * FROM page ";
				
				$query .= "WHERE subject_id = ";
				$query .= $row["id"];
				
				$query .= " ORDER BY pos ASC"; 
				//echo("$query");
				$result1 = mysqli_query($connect,$query);
				
				confirm($result1);
				
				$output .= "<ul class=\"pages\">" ;
				
				while ($row1 = mysqli_fetch_assoc($result1)){
							//echo($row1['id'].$page_array['id']);
							$output .= "<li" ;
								if ( isset($page_array) && $page_array['id'] == $row1['id'] ){
									//echo("GRFG");
									$output .= " class=\"selected\"" ;
								}
								
				$output .= ">";
		
				$output .= "<a href=\"http://localhost/publiccc/Manage_Contents.php?page=";
				$output .= urlencode($row1['id']);
				$output .= "\">" ;
				$output .= $row1['name'];
				$output .= "</a></li>";
				
				}
				mysqli_free_result($result1);
			$output .= "</ul>" ;
			//$output .= "</li>";
	}
	 mysqli_free_result($result);
	 $output .= "</ul>";
	 
	 $output .= "<a href=\"http://localhost/publiccc/edit_subject.php";
	$output .= "\"> + Add a new subject </a>";
	 
	return $output ;
}

function public_navigation ( $subject_array , $page_array ) {

	
	include("../includes/dbms.php") ;
	
	$query = "SELECT * FROM subject ";
	
	$query .= "WHERE vis = 1 ";
	
	$query .= "ORDER BY pos ASC"; 
	//echo("$query");
	$result = mysqli_query($connect,$query);
	
	confirm($result);
	
	$output = "<ul class=\"subject\">" ;
	while ($row = mysqli_fetch_assoc($result)){
		
		$output .= "<li" ;
			
			if ( isset( $subject_array ) && $subject_array['id'] == $row['id'] ){
				$output .= " class=\"selected\"" ;
			}
			
		$output .= ">";
		
		$output .= "<a href=\"http://localhost/publiccc/indexxx.php?subject=";
		$output .= urlencode($row['id']);
		$output .= "\">" ;
		$output .= $row['name'];
		$output .= "</a>";$output .= "</li>";
		
		if ( isset($page_array) && $page_array['subject_id'] == $row['id'] ) {
				
				$query = "SELECT * FROM page ";
				
				$query .= "WHERE subject_id = ";
				$query .= $row["id"];
				$query .= " AND vis = 1";
				$query .= " ORDER BY pos ASC"; 
				//echo("$query");
				$result1 = mysqli_query($connect,$query);
				
				confirm($result1);
				
				$output .= "<ul class=\"pages\">" ;
				
				while ($row1 = mysqli_fetch_assoc($result1)){
							//echo($row1['id'].$page_array['id']);
							$output .= "<li" ;
								if ( $page_array['id'] == $row1['id'] ){
									$output .= " class=\"selected\"" ;
								}
								
				$output .= ">";
		
				$output .= "<a href=\"http://localhost/publiccc/indexxx.php?page=";
				$output .= urlencode($row1['id']);
				$output .= "\">" ;
				$output .= $row1['name'];
				$output .= "</a></li>";
				
				}
				mysqli_free_result($result1);
			$output .= "</ul>" ;
		
		}
		//$output .= "</li>";
	}
	 mysqli_free_result($result);
	 $output .= "</ul>";
	return $output ;
} 

function display_content($current_subject , $current_page ) {
	
		if ( isset($current_subject) ){
			
				echo($current_subject['content']);
		}
		else if(isset($current_page)){
			echo($current_page['content']);
		} 
		else{
			echo("<h3> Welcome !!! </h3>");
		}
}

function attempt_login ($username , $password ) {
	
	include("../includes/dbms.php") ;
	
	//$name_list = array("un","pd");
	
	$query = "SELECT * FROM admin WHERE un = '{$username}' AND pd = '{$password}'";
		
		echo("$query");
		$result = mysqli_query($connect,$query);
	
		if ( $result == NULL) {
			//echo("fxgdG");
			return false ;
		}
		
		while ($row = mysqli_fetch_assoc($result) ){
			//echo("FG");
			echo($row['un']." ".$row['pd']);
		}
		
		return true ;

}

function redirect_to ( $string ) {


	header("Location: ".$string);
}

?>
