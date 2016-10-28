<?php

// The page we wish to display

$file = $_GET[ 'page' ];

function endswith($haystack, $needle){
    $length = strlen($needle);
    if ($length == 0) {
            return true;
    }

    return (substr($haystack, -$length) === $needle);
}


if(!endswith($file, ".php") && !empty($file)){
    $file = $file . ".php";
}

// Input validation
$file = str_replace( array( "http://", "https://" ), "", $file );
$file = str_replace( array( "../", "..\"" ), "", $file );

?>
