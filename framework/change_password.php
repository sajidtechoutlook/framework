<?php
/*
	session_start();

	include"ro-config.php";

	include"ro-includes/db.php";

	include"check.php";
*/
	$pss = $dblink->getTableFromDB(" select * from user where uid='".getWorkerId()."' and password='".$_REQUEST['oldpassword']."' ");

	if($pss[0]){

		if($_REQUEST['newpassword'] == $_REQUEST['confirmnewpassword']){

			$dblink->updateInDB("password='".$_REQUEST['newpassword']."'","uid='".getWorkerId()."'","user");

			?><meta http-equiv="refresh" content="0;url=<?=getPageUrl("changepassword")?>&amp;msg=Password changed successfully!"><?

		}else{

			?><meta http-equiv="refresh" content="0;url=<?=getPageUrl("changepassword")?>&amp;msg=New Password and Confirm New Password should match!"><?

		}

	}else{

//	echo getPageUrl("changepassword");exit;

		?><meta http-equiv="refresh" content="0;url=<?=getPageUrl("changepassword")?>&amp;msg=Old Passoword is wrong!"><?

	}

?>