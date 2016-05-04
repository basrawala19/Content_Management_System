<?php 
	
	
	function has_presence ( $field ) {
		
		return isset($field) && $field !== "" ;
	}
	
	function max_length( $value , $length ) {
	
		if ( strlen($value) > $length ) {
			return 0;	
		}
		return 1;
	}
	
	function validate_presence( $required_feild ) {
		
		global $errors ;
		foreach( $required_feild as $feild => $max ) {
			
			if ( !has_presence(trim($_GET[$feild])) ){
				$errors[$feild] = ucfirst($feild)." can't be blank";
			}	
			if ( !max_length( $_GET[$feild] , $max ) ){
			
				$errors[$feild] = ucfirst($feild)." too long ";
			}
		}	
		
	
	}
	
	function form_errors( $errors ) {
	
			$output = "" ;
			
			if ( !empty($errors) ){
				$output .= "<pre><ul>";
				
				foreach ( $errors as $feild ){
					$output .= "<li>$feild</li>";
				}
				$output .= "</ul></pre>";
			}
			return $output ;
	}


?>