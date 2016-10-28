<?php

function filter_union($s){
    if(stripos($s, "UNION") !== false){
        return filter_union(str_ireplace("UNION", "", $s));
    } else {
        return $s;
    }
}

function filter_conditions($s){
    $s = str_ireplace("AND", "", $s);
    $s = str_ireplace("OR", "", $s);
    $s = str_ireplace("WHERE", "", $s);
    return $s;
}

if( isset( $_GET['Submit'] ) ) {
	$id = $_GET['id'];

    $id = filter_union($id);
    $id = filter_conditions($id);

	// Check database
	$query  = "SELECT first_name, last_name FROM users WHERE user_id = '$id' LIMIT 1;";
	$result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( "<pre>Something went wrong.</pre><br>Query: $query" );

	// Get results
	while( $row = mysqli_fetch_assoc( $result ) ) {
		// Get values
		$first = $row["first_name"];
		$last  = $row["last_name"];

		// Feedback for end user
		$html .= "<pre>ID: {$id}<br />First name: {$first}<br />Surname: {$last}</pre>";
	}

    $html .= "Query: $query";

	((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);

}

?>
