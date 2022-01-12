<?php
$file_links = getMenu( $_GET['top_menu'] );
echo "<br /><strong>".ucfirst($_GET['top_menu'])."</strong><br />";
//echo '<pre>';
//var_dump($file_links['sub_menu']);
if( !empty($file_links['sub_menu']) )
foreach( $file_links['sub_menu'] as $sub_link ){	if($sub_link['status'] == 0) continue;
	echo '<br /><a href="'.$webUrl.$sub_link['url'].'">'.$sub_link['text'].'</a>';
}