<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'Challenge: SQL Injection' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'sqli_challenge';
$page[ 'help_button' ]   = 'sqli_challenge';
$page[ 'source_button' ] = 'sqli_challenge';

dvwaDatabaseConnect();

$method            = 'GET';
$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
    default:
        $vulnerabilityFile = 'challenge.php';
        break;    
    // case 'low':
	//	$vulnerabilityFile = 'low.php';
	//	break;
	//case 'medium':
	//	$vulnerabilityFile = 'medium.php';
	//	$method = 'POST';
	//	break;
	//case 'high':
	//	$vulnerabilityFile = 'high.php';
	//	break;
	//default:
	//	$vulnerabilityFile = 'impossible.php';
	//	break;
}

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/sqli_challenge/source/{$vulnerabilityFile}";

// Is PHP function magic_quotee enabled?
$WarningHtml = '';
if( ini_get( 'magic_quotes_gpc' ) == true ) {
	$WarningHtml .= "<div class=\"warning\">The PHP function \"<em>Magic Quotes</em>\" is enabled.</div>";
}
// Is PHP function safe_mode enabled?
if( ini_get( 'safe_mode' ) == true ) {
	$WarningHtml .= "<div class=\"warning\">The PHP function \"<em>Safe mode</em>\" is enabled.</div>";
}

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Challenge: SQL Injection</h1>

	{$WarningHtml}

	<div class=\"vulnerable_code_area\">";
	$page[ 'body' ] .= "
		<form action=\"#\" method=\"{$method}\">
            <p>User ID:<input type=\"text\" size=\"15\" name=\"id\">
            <input type=\"submit\" name=\"Submit\" value=\"Submit\"></p>
        </form>";

    $page[ 'body' ] .= "{$html}
	</div>
</div>\n";

dvwaHtmlEcho( $page );

?>
