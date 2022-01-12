<?php
$server="localhost";
$dbuser="root";
$dbname="ya";
//$dbpass="";
$dbpass="password";

$licence = "";
$title="You Accounts";
$logoname1 = "You";
$logoname2 = "Accounts";
$name = "You-Accounts";
$image_alt = "You-Accounts";

$sms_from = 'YOUACCOUNTS';
//$enable_sms = false;
$enable_admin_sms = false;
$show_barcode = false;
$theme_name = "premium";
$framework_url = $webUrl.'software/framework/';

// $sale_form_template = 'sale_form_template_3.php';
$comments_title = "Comments";

$print_invoice_format = "print_invoice_format_3.php";
$upload_url = "http://youaccounts.com/uploads";
$upload_dir = "/var/www/youaccounts.com/public_html/uploads";

$create_bill_format_array[1]=array(
    0=>array('product_id'=>1, 'qty' => 1)
    ,1=>array('product_id'=>2, 'qty' => 1)
    ,2=>array('product_id'=>3, 'qty' => 1)
    ,3=>array('product_id'=>4, 'qty' => 1)
    ,4=>array('product_id'=>5, 'qty' => 1)
    ,5=>array('product_id'=>6, 'qty' => 1)
);