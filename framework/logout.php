<?php 
@session_start();	
@session_destroy(); 
?>

You have successfully Logged Out!

<meta http-equiv="refresh" content="0;url=<?php echo base_url()?>" />

