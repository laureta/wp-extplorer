<?php
/** ensure this file is being included by a parent file */
if( !defined( '_JEXEC' ) && !defined( '_VALID_MOS' ) ) die( 'Restricted access' );

// KJ. Include wordpress config file
$wpinstall = realpath(dirname(__FILE__).'/../../../../../');
$lines = file($wpinstall.'/wp-config.php');
$content ="";
foreach ($lines as $line_num => $line) {
	if((strpos($line,"require_once(ABSPATH . 'wp-settings.php');")===false) && (strpos($line,"*")===false) && (strpos($line,"<?php")===false) ){
		$content.=$line;
	}
}
eval($content);
$link = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$db = mysql_select_db(DB_NAME,$link);
$query = "SELECT user_login, user_pass FROM ".$table_prefix."users WHERE user_status=0 AND ID IN(SELECT user_id FROM ".$table_prefix."usermeta WHERE meta_key='".$table_prefix."user_level' AND meta_value>7);";
$res = mysql_query($query,$link);

if (!$res) {
    die('Invalid query: ' . mysql_error());
}
while ($r =mysql_fetch_object($res)){
	$user = array($r->user_login,$r->user_pass,empty($_SERVER['DOCUMENT_ROOT'])?realpath(dirname(__FILE__).'/..'):$_SERVER['DOCUMENT_ROOT'],"",1,"",7,1);
	$gusers[] = $user;
}
$GLOBALS["users"]=$gusers;
mysql_close($link);

 ?>
