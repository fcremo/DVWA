<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'Challenge: PHP Trolling' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'troll_challenge';
$page[ 'help_button' ]   = 'troll_challenge';
$page[ 'source_button' ] = 'troll_challenge';

dvwaDatabaseConnect();

$method            = 'GET';
$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
    default:
        $vulnerabilityFile = 'challenge.php';
        break;    
}

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/sqli_challenge/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Challenge: PHP Trolling</h1>

	<div class=\"vulnerable_code_area\">";
	$page[ 'body' ] .= "
		<form action=\"#\" method=\"{$method}\">
            <p>Password:<input type=\"password\" size=\"15\" name=\"password\">
            <input type=\"submit\" name=\"Submit\" value=\"Submit\"></p>
        </form>";

    $page[ 'body' ] .= "{$html}
	</div>
</div>\n";

dvwaHtmlEcho( $page );

?>
