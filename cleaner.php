<?php
function cleanInput($input) {
	$output = str_replace('/', '&#x2F;', $input);
	$output = htmlentities($output, ENT_QUOTES, 'UTF-8');
	
	return $output;
  }

function sanitize($con, $input) {
	if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($con, $val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysqli_real_escape_string($con, $input);
    }
    return $output;
}
