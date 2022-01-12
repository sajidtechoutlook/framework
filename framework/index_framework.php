<?php
$track_time[] = microtime(true); 

session_start();
date_default_timezone_set("Asia/Karachi");

$framework_dir = __DIR__;
define('FRAMEWORK_DIR', $framework_dir);
if(file_exists($project_dir.'/ro-config.php'))
	include($project_dir.'/ro-config.php');
else
	include($framework_dir.'/ro-config.php');

include $framework_dir."/ro-includes/db.php";
$track_time[] = microtime(true);
if(getBusinessId() != '' && !isset($_REQUEST['api']))
	include (getThemeDir().'/header.php'); 
hackChecks($_REQUEST);
$track_time[] = microtime(true);
if(isset($_GET['page'])){
	include ($framework_dir.'/check.php');
	$filetoinclude = $_GET['page'].'.php';
	if( file_exists($project_dir.'/'.$filetoinclude) ){ 
		include ($project_dir.'/'.$filetoinclude);
	}else if( file_exists($framework_dir.'/'.$filetoinclude) ){ 
		include ($framework_dir.'/'.$filetoinclude);
	}else 
		include ($framework_dir.'/dashboard.php');
}elseif(isset($_GET['api'])){
	include ($framework_dir.'/check.php');
	$filetoinclude = $_GET['api'].'.php';
	if( file_exists($project_dir.'/api/'.$filetoinclude) ){ 
		include ($project_dir.'/api/'.$filetoinclude);
	}else if( file_exists($framework_dir.'/api/'.$filetoinclude) ){ 
		include ($framework_dir.'/api/'.$filetoinclude);
	}
}else{
	if( getBusinessId()=='' ){
		include ($framework_dir.'/login.php');
	}else{
		include ($framework_dir.'/dashboard.php');
	}
}
$track_time[] = microtime(true);
if(getBusinessId() != '' && !isset($_REQUEST['api']))
	include (getThemeDir().'/footer.php'); 
$rodb->disconnectDB();
$track_time[] = microtime(true);
if(isset($_GET['debug_time_track'])){
	$prev_time = 0;
	foreach($track_time as $track_t){
		echo '<br />tracking time: '.$track_t;
		echo ' <br /> difference: '.($track_t - $prev_time);
		$prev_time = $track_t;
	}
}