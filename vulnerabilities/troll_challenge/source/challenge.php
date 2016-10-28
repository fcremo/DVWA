<?php

$html = "";

if(isset($_GET['password'])){
	// Get input
	$password = $_GET['password'];

    if(md5($password) == '0e437615822854973821546700821568'){
        $html = "Well done!";    
    } else {
        $html = "Try harder!";
    }
}

?>
