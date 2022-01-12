<?php 
$direct_pages = array(
	'activate',
	'register',
	'confirm_registration'
);
if( getBusinessId() == '' and !in_array($_GET['page'], $direct_pages)){ 

	echo '<meta http-equiv="refresh" content="0;url='.$webUrl.'" />';

	exit;

} 

?>