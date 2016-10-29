<?php
$user = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_SESSION['dvwa']['username']);
if( isset( $_GET['Submit'] ) ) {
    if($_GET['Submit'] == 'reset'){
        $query = "UPDATE users SET credit = 0 WHERE user = '$user'";
        mysqli_query($GLOBALS["___mysqli_ston"], $query) or die("<pre>Something went wrong.</pre><br>Query: $query");
        $query = "UPDATE coupons SET used = 0 WHERE code = 'SPECIAL'";
        mysqli_query($GLOBALS["___mysqli_ston"], $query) or die("<pre>Something went wrong.</pre><br>Query: $query");

    } else {

        $coupon = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['coupon']);

        $query  = "SELECT * FROM coupons";
        $result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( "<pre>Something went wrong.</pre><br>Query: $query" );

        // Get results
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $used = true;
        foreach($rows as $row){
            usleep(20);
            if($row['code'] == $coupon && $row['used'] == 0){
                $used = false;
                $query = "UPDATE users SET credit = credit + 10 WHERE user = '$user'";
                mysqli_query($GLOBALS["___mysqli_ston"], $query) or die("<pre>Something went wrong.</pre><br>Query: $query");
                $query = "UPDATE coupons SET used = 1 WHERE code = '$coupon'";
                mysqli_query($GLOBALS["___mysqli_ston"], $query) or die("<pre>Something went wrong.</pre><br>Query: $query");
                break;
            }
        }

        var_dump($used);

        if($used){
            $html .= "Non existent or already used coupon!";
        }

    }

}

$query = "SELECT code FROM coupons WHERE used = 0";
$result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( "<pre>Something went wrong.</pre><br>Query: $query" );
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
$html .= "<p>Available coupons:</p>";
foreach($rows as $row){
    $html .= "<p>- {$row['code']}</p><br>";
}

$query = "SELECT credit FROM users WHERE user = '$user'";
$result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( "<pre>Something went wrong.</pre><br>Query: $query" );
$credit = mysqli_fetch_assoc($result);
$html .= "<p>Credit: {$credit['credit']}</p>";


((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
?>
