<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'Challenge: File Inclusion' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'rfi_challenge';
$page[ 'help_button' ]   = 'rfi_challenge';
$page[ 'source_button' ] = 'rfi_challenge';

dvwaDatabaseConnect();

$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
	default:
		$vulnerabilityFile = 'challenge.php';
		break;
}

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/rfi_challenge/source/{$vulnerabilityFile}";

// if( count( $_GET ) )
if(!empty($file)){
    include($file);
}
else {
	header('Location: ?page=include.php');
	exit;
}

dvwaHtmlEcho($page);

?>
