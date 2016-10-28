<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'Challenge: Timing attack' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'timing_challenge';
$page[ 'help_button' ]   = 'timing_challenge';
$page[ 'source_button' ] = 'timing_challenge';

dvwaDatabaseConnect();

$method            = 'GET';
$vulnerabilityFile = 'challenge.php';

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/timing_challenge/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Challenge: Timing attack</h1>

    <div class=\"vulnerable_code_area\">{$html}	</div>

    <form action=\"#\" method=\"{$method}\">
    <div>
    Coupon:<input type=\"text\" size=\"15\" name=\"coupon\"><br>
            <input type=\"submit\" name=\"Submit\" value=\"Submit\"><br>
            <input type=\"submit\" name=\"Submit\" value=\"reset\"><br>
    </div>
    </form>   
</div>\n";

dvwaHtmlEcho( $page );

?>
