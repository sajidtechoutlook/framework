<?php
function updateUserMeta($user_id, $meta_key, $meta_value){
    global $rodb;
	$q_check = "select meta_key from usermeta where user_id = '".$user_id."' and meta_key = '".$meta_key."'";
    $meta_key_tmp = $rodb->getCellFromDB($q_check);
    if(isset($meta_key_tmp) && $meta_key_tmp != ''){
        $q = "update usermeta set meta_value = '$meta_value' where meta_key = '$meta_key' and user_id = '$user_id'";
        $rodb->execute($q);
    }else{
        $q = "insert into usermeta (meta_value, meta_key, user_id) values ('$meta_value', '$meta_key', '$user_id')";
        $rodb->execute($q);
    }
}
function isNewBillFormat(){
    return (isset($_SESSION['new_bill_format']) && $_SESSION['new_bill_format']==1)?true:false;
}
function isFileValid($image){
    if(empty($image['tmp_name'])) return false;
    $filetypes = array(
        "image/jpeg", 
        "image/bmp", 
        "image/vnd.microsoft.icon", 
        "image/png", 
        "image/tiff", 
        "image/webp", 
        "image/gif", 
        "image/svg+xml"
    );
    $info = getimagesize($image['tmp_name']);
    if(in_array($info['mime'], $filetypes)){
        return true;
    }
    return false;
}

function getShowHideBarcode(){
    if(isset($_SESSION['show_barcode']) && $_SESSION['show_barcode'] == 1) return true;
    return false;
}

function getFlag_packs_quantity(){
    if(isset($_SESSION['flag_packs_quantity']) && $_SESSION['flag_packs_quantity'] == 1) return true;
    return false;
}

function getProductDiscountFlag(){
    if(isset($_SESSION['product_discount_flag']) && $_SESSION['product_discount_flag'] == 1) return true;
    return false;
}

function ro_insert_packed_quantity($user_id, $product_id, $bill_no, $type, $qty){
	global $rodb;
	$pq = $rodb->writeToDB("(`user_id`, `product_id`, `bill_no`, `type`, `dt`, `qty`) VALUES 
	('".$user_id."', '".$product_id."', '".$bill_no."', '".$type."', '".@date("Y-m-d H:i:s")."', '".$qty."')", DB_TABLE_PREFIX."quantity_packs");
	return $pq;
}
function ro_get_packed_quantity($product_id){
	global $rodb;
	$q_sold = "select sum(qty_packs) from ". $rodb->prefix ."sale_products where productid = '".$product_id."'";
	$sold = $rodb->getCellFromDB($q_sold);
	
	$q_bought = "select sum(qty_packs) from ". $rodb->prefix ."buy_products where product_id = '".$product_id."'";
	$bought = $rodb->getCellFromDB($q_bought);
	
	return round($bought-$sold, 2);
}
function ro_array_merge($arr1, $arr2){
	if(empty($arr1)){
		return $arr2;
	}
	if(empty($arr2)){
		return $arr1;
	}
	return array_merge($arr1, $arr2);
}
function ro_number_round($numbe){
//	return $number;
	return number_format($numbe, 0, '.', ',');
}
function installSampleData($uid = ''){
	global $rodb;
	
	$ct = $rodb->writeToDB("(ct_name, user_id, dt) VALUES ('Sample Customer Sector', '".$uid."', '".@date("Y-m-d H:i:s")."')", DB_TABLE_PREFIX."customer_type");
	
	$city = $rodb->writeToDB("(city_name, city_ct_id, city_userid) VALUES ('Sample Customer City', '".$ct[1]."', '".$uid."')", DB_TABLE_PREFIX."city");
	
	$customer = $rodb->writeToDB("(customer_name, customer_address, customer_phone, contact_person, fileno, opening_balance, current_balance, customer_city_id, ct_id, user_id, dt) VALUES ('Sample Customer Name', 'Houese# 123 Street#321', '1234567', 'Sample Contact Person', '1', '0', '0', '".$city[1]."', '".$ct[1]."', '".$uid."', '".@date("Y-m-d H:i:s")."')", DB_TABLE_PREFIX."customers");
	
	$tc = $rodb->writeToDB("(tc_name, tc_user_id, dt) VALUES ('Sample Main Prmduct Type', '".$uid."', '".@date("Y-m-d H:i:s")."')", DB_TABLE_PREFIX."top_category");
	
	$category = $rodb->writeToDB("(cat_name, user_id, cat_tc_id) VALUES ('Sample Sub Product Type', '".$uid."', '".$tc[1]."')", DB_TABLE_PREFIX."category");
	
	$product = $rodb->writeToDB("(userid, cat_id, productname, stock, opening_stock, unit, purchase_price, sale_price, sequence, show_on_web, admin_auth_show_on_web) VALUES ('".$uid."', '".$category[1]."', 'Sample Customer City', '100', '0', '1 Piece', '50', '55', '1', '0', '0')", DB_TABLE_PREFIX."product");
}
function redirect($location){
    echo '<meta http-equiv="refresh" content="0; url='.$location.'" />';
}
function getMenu($top_menu = ''){
	global $arr_menu;
	if( $top_menu == '' ) return $arr_menu;
	else
	foreach($arr_menu as $menu){
		if( strtolower($menu['id']) == strtolower($top_menu) )
			return $menu;
	}
}
function addMenuItem($arr){
	global $arr_menu;
	$arr_menu[] = $arr;
}
function getURL($val = ''){
	global $webUrl;
	if($val == 'theme' || $val == 'template'){
		return THEME_URL;
	}else{
		return $webUrl;
	}
}
function getPageUrl( $val = '' ){
	global $webUrl;
	if($val)
		return $webUrl."?page=".$val;
}
function getApiUrl( $val = '' ){
	global $webUrl;
	if($val)
		return $webUrl."?api=".$val;
}
function getThemeUrl(){
	return THEME_URL;
}
function themeUrl(){
	echo THEME_URL;
}
function getThemeDir(){
	return THEME_DIR;
}
function themeDir(){
	echo THEME_DIR;
}
function getModuleURL($module=""){
	return MODULES_URL.$module."/";
}

function getDirectoryTree( $outerDir ){
	$dirs = scandir( $outerDir );
	foreach( $dirs as $d ){
		echo "<br />"; print_r($dirs);
		if( is_dir( $outerDir."/".$d ) ){
			$dir_array[ $d ] =  getDirectoryTree( $outerDir."/".$d );
		}else{
			$dir_array[ $d ] = $d;
		}
	}
	return $dir_array;
} 
function getMonth($monthNo)
{
	switch ($monthNo){
		case 1 : return "January";break;
		case 2 : return "February";break;
		case 3 : return "March";break;
		case 4 : return "April";break;
		case 5 : return "May";break;
		case 6 : return "June";break;
		case 7 : return "July";break;
		case 8 : return "August";break;
		case 9 : return "September";break;
		case 10 : return "October";break;
		case 11 : return "November";break;
		case 12 : return "December";break;
	}
}
function _retDate($dt = ''){
	if($dt == ''){
		return 'N/A';
	}
	return @date("d M, Y", @strtotime($dt));
}
function _retDateTime($dt){
	return @date("d M, Y H:i A", @strtotime($dt));
}
function _getDBDate($dt){
	$dt_time_formatted = explode(" ",$dt);
	$dt_formatted = explode("-",$dt_time_formatted[0]);
	$dt_formatted = $dt_formatted[2]."-".$dt_formatted[1]."-".$dt_formatted[0];
	return @date("Y-m-d",@strtotime($dt_formatted));
	//return $dt_time_formatted[1];
}
function _getDBDateTime($dt){
	$dt_time_formatted = explode(" ",$dt);
	$dt_formatted = explode("-",$dt_time_formatted[0]);
	$dt_formatted = $dt_formatted[2]."-".$dt_formatted[1]."-".$dt_formatted[0].' '.$dt_time_formatted[1];
	return @date("Y-m-d H:i:s",@strtotime($dt_formatted));
	//return $dt_time_formatted[1];
}
function _getOnlyDate($dt){
	$dt = explode(" ",$dt);
	return $dt[0];
}
function _getUserFriendlyNowDate($string = 'd-m-Y'){
	return @date($string);
}
function _getUserFriendlyNowDateTime($string = 'd-m-Y H:i'){
	return @date($string);
}
function getDBDateToUserDate($db_date = ''){
    return @date('d-m-Y', strtotime($db_date));
}
function getDBDateToUserDateTime($db_date = ''){
    return @date('d-m-Y H:i', strtotime($db_date));
}

function ro_date($string = 'Y-m-d H:i:s', $time = ''){
    if($time == '') $time = time();
    return @date($string, $time);
}
function getDBDateToTime($db_date = ''){
    return @date('H:i', strtotime($db_date));
}
function getDBDateToDayMonth($db_date = ''){
    return @date('d-m', strtotime($db_date));
}
function base_url(){
	global $webUrl;
	return $webUrl;
}
function genRandomString() {
    $length = 35;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';    

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters)-1)];
    }

    return $string;
}
function searchProductByBarcode($product_search, $price = 0, $purchase_price = 0){
	global $rodb;
    $q_product = "select * from ".$rodb->prefix."product where productcode = '".$product_search."' and userid='".getBusinessId()."'";
    $row_product = $rodb->getRowFromDB($q_product);
    if(empty($row_product['productname']) and !count($row_product) > 0){
        return 0;
    }
    return (isset($row_product) && isset($row_product['productid']))?$row_product['productid']:'';
}
function createNewProduct($product_search, $price = 0, $purchase_price = 0){
    global $rodb;
    // $product_parts = explode('-', $product_search);
	// if(!count($product_parts) > 2 or empty($product_parts[2])) return;
    // $product_parts[3] = (isset($product_parts[3]))?$product_parts[3]:'';

    // $q_tc = "select * from ".$rodb->prefix."top_category where tc_name = '".$product_parts[0]."' and tc_user_id='".getBusinessId()."'";
    // $row_tc = $rodb->getRowFromDB($q_tc);
    // if(!isset($row_tc['tc_name'])){
    //     $row_tc['tc_id'] = createTopCategory($product_parts[0]);
    // }
    // $row_tc['tc_id'] = (isset($row_tc) && isset($row_tc['tc_id']))?$row_tc['tc_id']:"";
    // $q_cat = "select * from ".$rodb->prefix."category where cat_name = '".$product_parts[1]."' and cat_tc_id = '". 
    // $row_tc['tc_id']
    // ."' and user_id='".getBusinessId()."'";
    // $row_cat = $rodb->getRowFromDB($q_cat);
    
    // if(!isset($row_cat['cat_name'])){
    //     $row_cat['cat_id'] = createCategory($product_parts[1], $row_tc['tc_id']);
    // }
    // $row_cat['cat_id'] = (isset($row_cat['cat_id']))?$row_cat['cat_id']:'';
    $q_product = "select * from ".$rodb->prefix."product where productname = '".$product_search."' 
    and userid='".getBusinessId()."'";
    $row_product = $rodb->getRowFromDB($q_product);
    
    if(!isset($row_product['productname'])){
        $row_product['productid'] = createProduct($product_search, '', '', $price, $purchase_price);
    }
    return (isset($row_product['productid']))?$row_product['productid']:'';
}
function createTopCategory($tc_name = ''){
    global $rodb;
    $res = $rodb->writeToDB("(tc_name, tc_user_id) VALUES ('".$tc_name."', '".getBusinessId()."')", $rodb->prefix."top_category");
    return $res[1];
}
function createCategory($cat_name = '', $tc_id = 0){
    global $rodb;
    $res = $rodb->writeToDB("(cat_name, cat_tc_id, user_id) VALUES ('".$cat_name."', '".$tc_id."', '".getBusinessId()."')", $rodb->prefix."category");
    return $res[1];
}
function createProduct($productname = '', $comments = '', $cat_id = 0, $price = 0, $purchase_price = 0){
    global $rodb;
	$cat_id = ($cat_id > 0)?$cat_id:0;
    $price = ($price > 0)?$price:0;
    $purchase_price = ($purchase_price > 0)?$purchase_price:0;

    $res = $rodb->writeToDB("(productname, comments, cat_id, sale_price, purchase_price, userid) VALUES ('".$productname."', '".$comments."', '".$cat_id."', '".$price."', '".$purchase_price."', '".getBusinessId()."')", $rodb->prefix."product");
    return $res[1];
}
function createNewCustomer($customer_search, $phoneno = ''){
    global $rodb;
    // $customer_parts = explode('-', $customer_search);
	// if(!count($customer_parts) > 2 or empty($customer_parts[2])) return;

    // $q_ct = "select * from ".$rodb->prefix."customer_type where ct_name = '".$customer_parts[0]."' and user_id='".getBusinessId()."'";
    // $row_ct = $rodb->getRowFromDB($q_ct);
    // if(!isset($row_ct['ct_name'])){
    //     $row_ct['ct_id'] = createCustomerType($customer_parts[0]);
    // }
    
    // $q_city = "select * from ".$rodb->prefix."city where city_name = '".$customer_parts[1]."' and city_ct_id = '".$row_ct['ct_id']."' and city_userid='".getBusinessId()."'";
    // $row_city = $rodb->getRowFromDB($q_city);
    
    // if(!isset($row_city['city_name'])){
    //     $row_city['city_id'] = createCustomerCity($customer_parts[1], $row_ct['ct_id']);
    // }
    $q_customer = "select * from ".$rodb->prefix."customers where customer_name = '".$customer_search."' and user_id='".getBusinessId()."'";
    $row_customer = $rodb->getRowFromDB($q_customer);
    if(!isset($row_customer['customer_name'])){
        $row_customer['customer_id'] = createCustomer($customer_search, '', '', $phoneno);
    }
    return $row_customer['customer_id'];
}
function createCustomerType($ct_name = ''){
    global $rodb;
    $res = $rodb->writeToDB("(ct_name, user_id) VALUES ('".$ct_name."', '".getBusinessId()."')", $rodb->prefix."customer_type");
    return $res[1];
}
function createCustomerCity($city_name = '', $ct_id = 0){
    global $rodb;
    $res = $rodb->writeToDB("(city_name, city_ct_id, city_userid) VALUES ('".$city_name."', '".$ct_id."', '".getBusinessId()."')", $rodb->prefix."city");
    return $res[1];
}
function createCustomer($customer_name = '', $city_id = 0, $ct_id = 0, $phoneno = ''){
    global $rodb;
    $city_id = ($city_id > 0)?$city_id:0; 
    $ct_id = ($ct_id > 0)?$ct_id:0; 
    $phoneno = ($phoneno > 0)?$phoneno:0;

    $res = $rodb->writeToDB("(customer_name, customer_city_id, ct_id, user_id, customer_phone) VALUES ('".$customer_name."', '".$city_id."', '".$ct_id."', '".getBusinessId()."', '".$phoneno."')", $rodb->prefix."customers");
    return $res[1];
}
function getMac(){
    $osname = php_uname ($mode = "a");
    if(strstr($osname, 'Windows')){
        return base64_encode(base64_encode(base64_encode(getMacWindows())));
    }else{
        return base64_encode(base64_encode(base64_encode(getMacLinux())));
    }
}
function getMacLinux() {
  exec('netstat -ie', $result);
  if(is_array($result)) {
    $iface = array();
    foreach($result as $key => $line) {
      if($key > 0) {
        $tmp = str_replace(" ", "", substr($line, 0, 10));
        if($tmp <> "") {
          $macpos = strpos($line, "HWaddr");
          if($macpos !== false) {
            $iface[] = array('iface' => $tmp, 'mac' => strtolower(substr($line, $macpos+7, 17)));
          }
        }
      }
    }
    return $iface[0]['mac'];
  }
}
function getMacWindows() {
  exec('ipconfig/all', $result);
  //system('ipconfig', $result);
  //print_r($result);
  if(is_array($result)) {
    $iface = array();
    foreach($result as $key => $line) {
        if(strpos($line, 'Physical Address')){
            $str = explode(":", $line);
            return trim($str[1]);
        }
    }
    return $iface[0]['mac'];
	
	//to get cpu id
	//$cpu = shell_exec('wmic CPU get ProcessorId');
  }
}
function isTrialContinued($str){
    if(!empty($str)){
        $date = ro_decrypt($str);
        if($date!=''){
            if(@strtotime($date) > time()){
                return true;
            }
            else if(@strtotime($date) > time()){ // 0 days trial
				return 'trial';
            }
        }
    }
    return false;
}

function ro_decrypt($str){
    return base64_decode(base64_decode(base64_decode($str)));
}
function ro_encrypt($str){
    return base64_encode(base64_encode(base64_encode($str)));
}
function isLicenceRegistered($licence_key){
    $licence_key;
    
    $url = "http://www.rabta-online.com/verify-licence.php";
    
    ob_start();
    
    $ch = curl_init($url);
    $encoded = '';
    $encoded .= 'licence_key='.$licence_key.'&'.'mac='.getMac();
    
    curl_setopt($ch, CURLOPT_POSTFIELDS,  $encoded);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    $res = ob_get_contents();
    ob_end_clean();
    
    if($res == getMac()){
        return true;
    }else{
        return false;
    }
}
function activateMe($key=''){
    global $rodb;
    $rodb->updateInDB("licence='".$key."'", "uid='".getBusinessId()."'", "user");
}
function getCustomerPreviousBalance($customer_id, $dt){
    global $rodb;
    
    $q = "select cb_balance from ".$rodb->prefix."customer_balance where 
	cb_userid='".getBusinessId()."' 
	and cb_date = (select max(cb_date) from ".$rodb->prefix."customer_balance where cb_date < '".$dt."' and cb_userid='".getBusinessId()."' and cb_customerid = '".$customer_id."') 
	and cb_customerid = '".$customer_id."'
	";
    $current_balance = $rodb->getCellFromDB($q);
    return $current_balance;
}
function deductRaw($product_id, $quantity){
    global $rodb;
    $consists_productsq = "select * from ".$rodb->prefix."product_raw_formulae where fg_product_id='".$product_id."' and user_id='".getBusinessId()."'";
    $consists_products = $rodb->getTableFromDB($consists_productsq);
    $consists_products_count = 0;
    while($consists_products[$consists_products_count]){
            $raw_prd_qty_to_minus = $quantity * $consists_products[$consists_products_count]['raw_product_qty'];
            $err = $rodb->updateInDB("stock=stock-".$raw_prd_qty_to_minus,"productid='".$consists_products[$consists_products_count]['raw_product_id']."' and userid='".getBusinessId()."'",$rodb->prefix."product");
            $consists_products_count++;
    }
}

function setSuperAdmin($uid = ''){
    $_SESSION['ses_is_super_admin'] = base64_encode(base64_encode(base64_encode(1)));
}
function unsetSuperAdmin($uid = ''){
    unset($_SESSION['ses_is_super_admin']);
}
function isSuperAdmin(){
    if(isset($_SESSION) && isset($_SESSION['ses_is_super_admin']) && $_SESSION['ses_is_super_admin'] == base64_encode(base64_encode(base64_encode(1)))) return true;
    else return false;
}
function setBusinessId($business_id = 0){
    $_SESSION['ses_userid'] = base64_encode(base64_encode(base64_encode($business_id)));
}
function getBusinessId(){
    return (isset($_SESSION) && isset($_SESSION['ses_userid']))?base64_decode(base64_decode(base64_decode($_SESSION['ses_userid']))):0;
}
function getAPIBusinessId(){
    return getBusinessId();
    if(isset($_REQUEST['business_id'])){
        return base64_decode(base64_decode(base64_decode($_REQUEST['business_id'])));
    }
}
function setWorkerId($worker_id = 0){
    $_SESSION['ses_workerid'] = $worker_id;
}
function getWorkerId(){
    return (isset($_SESSION) && isset($_SESSION['ses_workerid']))?$_SESSION['ses_workerid']:0;
}
function convertNumberToWord($num = false)
{
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode(' ', $words);
}

function hackChecks($arr){
    global $rodb;
    if(isset($arr) && is_array($arr) && count($arr) > 0)
    foreach($arr as $k => $v){
        if(is_array($v)){
            hackChecks($v);
            continue;
        }
        // if($v == '') $v = 0;
        $_REQUEST[$k] = $rodb->mysql_real_escape_string($v);
        $_GET[$k] = $_REQUEST[$k];
        $_POST[$k] = $_REQUEST[$k];
    }
}

function convertDateCalendarToDB($dt){
    if(isset($dt)){
        $dt = explode(" ",$dt);
        if(is_array($dt) && count($dt) > 0){
            $dt = explode("-",$dt[0]);
            $dt = $dt[2]."-".$dt[1]."-".$dt[0];
            return $dt;
        }
    }
}

function getPreviousBalance($customer_id, $date){
    global $dblink, $rodb;
    $q = " select cb_balance from ".$rodb->prefix."customer_balance where cb_userid='".getBusinessId()."' and cb_date = (select max(cb_date) from ".$rodb->prefix."customer_balance where cb_date < '".$date."' and cb_userid='".getBusinessId()."' and cb_customerid = '".$customer_id."') ";
    $prev_balance = $rodb->getCellFromDB($q);
    if(!$prev_balance > 0){
        $q = " select opening_balance from ".$rodb->prefix."customers where customer_id = '".$customer_id."' ";
        $prev_balance = $rodb->getCellFromDB($q);
    }
    return $prev_balance > 0 ? $prev_balance : 0;
}
function compare_date_byrtno($a, $b){
    if(isset($a["rtno"]) && isset($b["rtno"]))
        return strcmp($a["rtno"], $b["rtno"]);
    return false;
}
function compare_date($a, $b){
    if(isset($a["dt"]) && isset($b["dt"]))
        return strcmp($a["dt"], $b["dt"]);
    return false;
}
function getCustomerName($customerid = 0){
    global $rodb;
    $q = "select customer_name from ".$rodb->prefix."customers where customer_id = '".$customerid."'";
    return $rodb->getCellFromDB($q);
}
function roSetSession($key, $val){
    @session_start();
    global $rodb;
    $_SESSION[$key] = $rodb->mysql_real_escape_string($val);
}
function roGetSession($val){
    @session_start();
    if(isset($_SESSION[$val]))
    return $_SESSION[$val];
}
function isTrial(){
    if(roGetSession('trial'))
        return true;
    return false;
}
function delayForTrial(){
    if(isTrial())
    sleep(3); 
}
function roSetGET($key, $val){
    global $rodb;
    $_GET[$key] = $rodb->mysql_real_escape_string($val);
}
function roGetGET($val){
    if(isset($_GET[$val])){
        global $rodb;
        return $rodb->mysql_real_escape_string($_GET[$val]);
    }
}
function roSetPOST($key, $val){
    global $rodb;
    $_POST[$key] = $rodb->mysql_real_escape_string($val);
}
function roGetPOST($val){
    if(isset($_POST[$val])){
        global $rodb;
        return $rodb->mysql_real_escape_string($_POST[$val]);
    }
}
function roSetREQUEST($key, $val){
    $_REQUEST[$key] = $rodb->mysql_real_escape_string($val);
}
function roGetREQUEST($val){
    if(isset($_REQUEST[$val])){
        global $rodb;
        return $rodb->mysql_real_escape_string($_REQUEST[$val]);
    }
}

function getProductLabel(){
    return (isset($_SESSION['product_label3']) && $_SESSION['product_label3']!='')?$_SESSION['product_label3']:'Item';
}

function getProductUnitLabel(){
    return (isset($_SESSION['product_unit_label']) && $_SESSION['product_unit_label']!='')?$_SESSION['product_unit_label']:'Unit';
}

function getPartyLabel(){
    return (isset($_SESSION['customer_label3']) && $_SESSION['customer_label3']!='')?$_SESSION['customer_label3']:'Party';
}



function getMenuItemUrl($id = 'sale_bill'){
    global $arr_menu;
    if(is_array($arr_menu) && count($arr_menu) > 0)
    foreach($arr_menu as $menu_items){
        if(isset($menu_items['sub_menu']) && is_array($menu_items['sub_menu']) && count($menu_items['sub_menu']) > 0)
        foreach($menu_items['sub_menu'] as $menu_item){
            if($menu_item['id'] == $id){
                return base_url().$menu_item['url'];
            }
        }
    }
    return base_url();
}

function getPayments($start_date = '', $end_date = ''){
    if(empty($start_date)) $start_date = date('Y-m-1 00:00:00');
    if(empty($end_date)) $end_date = date('Y-m-d 23:59:59');
    global $rodb;
    $q = "select count(*) from ".$rodb->prefix."transactions where user_id='".getBusinessId()."' and dt >= '$start_date' and dt <= '$end_date'";
    return $rodb->getCellFromDB($q);
}

function getSales($start_date = '', $end_date = ''){
    if(empty($start_date)) $start_date = date('Y-m-1 00:00:00');
    if(empty($end_date)) $end_date = @date('Y-m-d 23:59:59');
    global $rodb;
    $q = "select count(*) from ".$rodb->prefix."sale where userid='".getBusinessId()."' and dt >= '$start_date' and dt <= '$end_date'";
    return $rodb->getCellFromDB($q);
}

function getSalesAmount($start_date = '', $end_date = ''){
    if(empty($start_date)) $start_date = date('Y-m-1 00:00:00');
    if(empty($end_date)) $end_date = @date('Y-m-d 23:59:59');
    global $rodb;
    $q = "select sum(gTotal) from ".$rodb->prefix."sale where userid='".getBusinessId()."' and dt >= '$start_date' and dt <= '$end_date'";
    return $rodb->getCellFromDB($q);
}

function ro_round($val = ''){
    return round($val, 0);
}

function frameworkUrl(){
    global $framework_url;
    return $framework_url;
}

function getUploadsUrl(){
    global $upload_url;
    return $upload_url;
}

function getFrameworkDir(){
    return FRAMEWORK_DIR;
}

function getUploadDir(){
    global $upload_dir;
    return $upload_dir;
}

function getUploadImage($name){
    if(isset($name) && $name != '' && file_exists(getUploadDir().'/'.$name)){
        return getUploadsUrl().'/'.$name;
    }else{
        return getUploadsUrl().'/logo.png';
    }
}

function roAddJsBind($url){
    global $js_binds;
    $js_binds[] = $url;
}
function roJsBinds(){
    global $js_binds;
    if(isset($js_binds) && is_array($js_binds))
    foreach($js_binds as $js_bind){
        echo '<script src="'.$js_bind.'" type="text/javascript"></script>';
    }
}

function roAddCssBind($url){
    global $css_binds;
    $css_binds[] = $url;
}
function roCssBinds(){
    global $css_binds;
    if(isset($css_binds) && is_array($css_binds))
    foreach($css_binds as $css_bind){
        echo '<link href="'.$css_bind.'" rel="stylesheet" type="text/css" />';
    }
}


function updateCustomerBalance($user_id, $customer_id, $debit, $credit, $desc, $dt){
    //debit is when customer pays
    //credit is when customer gets
    global $rodb;
    if($debit > 0)
        $rodb->updateInDB("current_balance=current_balance-".$debit,"customer_id='".$customer_id."' and user_id = '".$user_id."'",$rodb->prefix."customers");
    if($credit > 0)
        $rodb->updateInDB("current_balance=current_balance+".$credit,"customer_id='".$customer_id."' and user_id = '".$user_id."' ",$rodb->prefix."customers");
    $current_balance = $rodb->getCellFromDB("select current_balance from ".$rodb->prefix."customers where customer_id='".$customer_id."' and user_id = '".$user_id."'");
    $rodb->writeToDB(" (cb_userid,cb_customerid,cb_balance,cb_date) values ('".$user_id."','".$customer_id."','".$current_balance."','".$dt."') ",$rodb->prefix."customer_balance");
}

function getCustomerBalance($user_id, $customer_id, $dt){
    global $rodb;
    return $rodb->getCellFromDB("select cb_balance from ".$rodb->prefix."customer_balance where cb_userid='".$user_id."' and cb_customerid='".$customer_id."' and cb_date >= '$dt' order by cb_date asc limit 1");
}

function getCustomerIDByBill($billno = 0){
    global $rodb;
    return $rodb->getCellFromDB("select customerid from ".$rodb->prefix."sale where rtno='".$billno."'");
}
function getCompleteCustomerName($customerid){
	global $rodb;
    return $rodb->getCellFromDB("select concat(ct.ct_name, '-', cit.city_name, '-', c.customer_name) from ".$rodb->prefix."customers c inner join ".$rodb->prefix."city cit
on cit.city_id = c.customer_city_id inner join ".$rodb->prefix."customer_type ct
on ct.ct_id = cit.city_ct_id
and c.customer_id = '".$customerid."'");
}
function makeCustomerLedger($customer_id){
	global $rodb, $dblink;
	$_REQUEST['customerid'] = $customer_id;
	ob_start();
	include('account_ledger.php');
    ob_end_clean();
}

function make_transaction($user_id, $customer_id, $payment, $desc, $dt, $sale_id = 0){
    global $rodb, $sms_prefix, $sms_postfix;
    $transaction = $rodb->writeToDB("(`customer_id`, `user_id`, `payment`, `desc`, `dt`, `sale_id`)
        values
    ('".$customer_id."', '".$user_id."', '".$payment."', '".$desc."', '".$dt."', '".$sale_id."' )",
    $rodb->prefix."transactions");
    //update customer balance too
    updateCustomerBalance($user_id, $customer_id, $payment, 0, $desc, $dt);
	
	$to = $rodb->getCellFromDB("select customer_phone from ".$rodb->prefix."customers where customer_id='".$customer_id."'");
	$balance = getCustomerBalance($user_id, $customer_id, $dt);
	if($balance < 0){
		$balance_string = "You are in debit of amount: ". -$balance;
	}else{
		$balance_string = "You are in credit of amount: ".$balance;
	}
	if($payment > 0) {$transact = "Received"; $payment_msg = $payment;}
	else {$transact = "Paid"; $payment_msg = -$payment;}
	$message = $sms_prefix. PHP_EOL ." \n\r $transact $payment_msg with thanks.
	 \n\r ". PHP_EOL .$balance_string.
	"\n\r ". PHP_EOL .$sms_postfix;
	send_sms($to, $message);
}

function getPaymentsList($start_date = '', $end_date = ''){
	global $rodb;
	if($start_date == '') $start_date = ro_date('Y-m-d 00:00:00');
	if($end_date == '') $end_date = ro_date('Y-m-d 23:59:59');
	$transactionq = " select cust.customer_name, tr.* from ".$rodb->prefix."transactions tr 
	left outer join ".$rodb->prefix."customers cust
	on cust.customer_id = tr.customer_id
	where tr.user_id='".getBusinessId()."' and tr.dt >= '".$start_date."' and tr.dt <= '".$end_date."' order by tr.dt asc ";
	return $rodb->getTableFromDB($transactionq);
}

function sms_to_buyer($sale_id){
    global $rodb;
}
function send_sms($to, $message){
	global $rodb, $enable_admin_sms;
	send_sms_to($to, $message);
	if($enable_admin_sms){
		$q = "select phone from user where uid='".getBusinessId()."'";
		$admin_phone = $rodb->getCellFromDB($q);
		send_sms_to($admin_phone, $message);
	}
}
function send_sms_to($to, $message){
	global $rodb, $enable_sms, $sms_username, $sms_password, $sms_from;
	if(isset($enable_sms) && $enable_sms != false){}else{return;}
	
	$response = send_sms_direct($to, $message);
	return $response;
}

function send_sms_direct($to, $message){
	global $enable_sms, $sms_username, $sms_password, $sms_from, $sms_postfix;
	
    $username = $sms_username;
    $password = $sms_password;
    $from = urlencode($sms_from);
	$message = urldecode((isset($sms_prefix))?$sms_prefix:'').' '.$message.' '.((isset($sms_postfix))?$sms_postfix:'');
	
    $url = "http://lifetimesms.com/plain";

	$parameters = array(
		"username" => $username,
		"password" => $password,
		"to" => $to,
		"from" => '88434', //$from
		"message" => $message,
	);


	$ch = curl_init();
	$timeout  =  30;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
	$response = curl_exec($ch);
	curl_close($ch);
	return $response ;
}

// function send_sms_direct_tbd($to, $message){
//     $url = "http://lifetimesms.com/plain";

// 	$parameters = array(
// 		"api_token" => "Your API Token",
// 		"api_secret" => "Your API Secret",
// 		"to" => "92xxxxxxxxxx",
// 		"from" => "Lifetimesms",
// 		"message" => "Testing SMS",
// 	);

// 	$ch = curl_init();
// 	$timeout  =  30;
// 	curl_setopt($ch, CURLOPT_URL, $url);
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 	curl_setopt($ch, CURLOPT_HEADER, 0);
// 	curl_setopt($ch, CURLOPT_POST, 1);
// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
// 	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
// 	$response = curl_exec($ch);
// 	curl_close($ch);

// 	echo $response ;
// }

function saleForm(){
	global $rodb;
	if(!empty($_REQUEST['product_barcode_search'])){
		$_REQUEST['product'] = searchProductByBarcode($_REQUEST['product_barcode_search'], $_REQUEST['price']);
	}
	if(!empty($_REQUEST['product_search'])){
		$_REQUEST['product'] = createNewProduct($_REQUEST['product_search'], $_REQUEST['price']);
	}
	if(!empty($_REQUEST['customer'])){
		$_REQUEST['customer_id'] = createNewCustomer($_REQUEST['customer'], $_REQUEST['phoneno']);
	}

	$res = $rodb->getTableFromDB(" select * from user where uid = '".getBusinessId()."' ");
	if(isset($_REQUEST) && isset($_REQUEST['delprod']) && $_REQUEST['delprod']){
		$rodb->deleteFromDB("delete from ".$rodb->prefix."sale_products where id='".$_REQUEST['delprod']."'");
	}

	if(isset($_REQUEST) && isset($_REQUEST['addtobill']) && $_REQUEST['addtobill']){
		$_REQUEST['sale_discount'] = (isset($_REQUEST['sale_discount']))?$_REQUEST['sale_discount']:0;
		$_REQUEST['qty_packs'] = (isset($_REQUEST['qty_packs']))?$_REQUEST['qty_packs']:0;
		$_SESSION['orderid'] = getOrderID($_SESSION['orderid']);
		addToBill($_SESSION['orderid'], $_REQUEST['product'], $_REQUEST['price'], $_REQUEST['sale_discount'], $_REQUEST['qty'], $_REQUEST['qty_packs']);
	}
	updateSaleFormItemQuantity();
}
function updateSaleFormItemQuantity(){
	global $rodb;
	$i=0;
	if(isset($_REQUEST) && isset($_REQUEST['quantity']) && is_array($_REQUEST['quantity']) && count($_REQUEST['quantity']) > 0)
	while(isset($_REQUEST['quantity'][$i]))
	{
		$q = "update ".$rodb->prefix."sale_products set qty='".$_REQUEST['quantity'][$i]."', qty_packs='".
		((isset($_REQUEST['qty_packs']))?$_REQUEST['qty_packs'][$i]:0)
		."' where productid='".$_REQUEST['product_id'][$i]."' and sale_id = '".$_SESSION['orderid']."'";
		$prdname = $rodb->execute($q);
		$i++;
	}
}
function addToBill($orderid, $product, $price, $sale_discount, $qty, $qty_packs){
	global $rodb;
	if(!$price > 0){
		$price = $rodb->getCellFromDB("select sale_price from ".$rodb->prefix."product where productid='".$product."'");
	}
	
	$sameprod = '';
	$sameprod_q = "select productid from ".$rodb->prefix."sale_products where sale_id = '".$orderid."' and productid = '".$product."' ";
	$sameprod = $rodb->getCellFromDB($sameprod_q);
	
	if($sameprod){
		$rodb->updateInDB("sale_price='".$price."',sale_discount='".$sale_discount."',qty=qty+".$qty," sale_id = '".$orderid."' and productid = '".$product."' ",$rodb->prefix."sale_products");
	}else{
		$data = "
		(productid,productname,cat_id,sale_price, sale_discount,qty,qty_packs,sale_id,userid)
		values
		('".$product."','".
		$rodb->getCellFromDB("select productname from ".$rodb->prefix."product where productid='".$product."'").
		"','".$rodb->getCellFromDB("select cat_id from ".$rodb->prefix."product where productid='".$product."'")."',
		'".$price."','".$sale_discount."','".$qty."','".$qty_packs."','".$orderid."','".getBusinessId()."')
		";
		$rodb->writeToDB($data,$rodb->prefix."sale_products");
	}
}

function getOrderID($orderid){
	global $rodb;
	if(!$orderid>0){
		$oid = $rodb->writeToDB("
		(userid, worker_id, rtno)
		values
		('".getBusinessId()."', '".getWorkerId()."', '".getNextSaleRTNO()."')
		",$rodb->prefix."sale");
		return $oid[1];
	}else{
		$err = updateSale((isset($_SESSION) && is_array($_SESSION) && isset($_SESSION['oid']))?$_SESSION['oid']:0);
	}
	return $orderid;
}

function createSale(){
    
}
function updateSaleVariables($sale_id, $array){
	if(count($array) > 0){
		global $rodb;
		$vars = '';
		foreach($array as $k => $v){
			if(!empty($vars)) $vars .= ", ";
			$vars .= $k."='".$rodb->mysql_real_escape_string($v)."'";
		}
		return $rodb->updateInDB($vars, "id='".$sale_id."'", $rodb->prefix."sale");
	}
}

function updateSale($sale_id, $dt = '', $maxrtno = '', $Total = 0, $gTotal = 0){
	global $rodb;
	$_REQUEST['exchrgsdesc'] = (isset($_REQUEST['exchrgsdesc']))?$_REQUEST['exchrgsdesc']:0;
	$_REQUEST['exchrgs'] = (isset($_REQUEST['exchrgs']))?$_REQUEST['exchrgs']:0;
	$_REQUEST['discount_desc'] = (isset($_REQUEST['discount_desc']))?$_REQUEST['discount_desc']:0;
	$_REQUEST['discountinpercentcheck'] = (isset($_REQUEST['discountinpercentcheck']))?$_REQUEST['discountinpercentcheck']:0;
	$_REQUEST['discount'] = (isset($_REQUEST['discount']))?$_REQUEST['discount']:0;
	$_REQUEST['customer_id'] = (isset($_REQUEST['customer_id']))?$_REQUEST['customer_id']:0;

    $vars = "total='".$Total."',extrachargesdesc='".$_REQUEST['exchrgsdesc']."',extracharges='".$_REQUEST['exchrgs']."',discount_desc='".$_REQUEST['discount_desc']."',discountinpercent='".$_REQUEST['discountinpercentcheck']."',discount='".$_REQUEST['discount']."',gTotal='".$gTotal."',customerid='".$_REQUEST['customer_id']."'";
    if(isset($dt)) $vars .= ", dt = '".$dt."'";
    if(isset($maxrtno)) $vars .= ", rtno = '".$maxrtno."'";
    return $rodb->updateInDB($vars, "id='".$sale_id."'", $rodb->prefix."sale");
}
function completeSale($sale_id){
    global $rodb;
    return $rodb->updateInDB("status='1'","id='".$sale_id."'",$rodb->prefix."sale");
}
function getSaleIDFromRTNO($billno = 0){
    global $rodb;
    $q = "select id from ".$rodb->prefix."sale where rtno = '".$billno."'";
    return $rodb->getCellFromDB($q);
}
function getSaleTypeFromRTNO($billno = 0){
    global $rodb;
    $q = "select status from ".$rodb->prefix."sale where rtno = '".$billno."'";
    return $rodb->getCellFromDB($q);
}
function getRTNOFromSaleID($id = 0){
    global $rodb;
    $q = "select rtno from ".$rodb->prefix."sale where id = '".$id."'";
    return $rodb->getCellFromDB($q);
}
function getProductSoldBetween($product_id, $start_date, $end_date){
	global $rodb;
	$q = "
	select 
		sum(sp.qty) ttl
	from 
		".$rodb->prefix."sale_products sp inner join ".$rodb->prefix."sale s
		on s.id = sp.sale_id
	where 
		sp.productid = '".$product_id."' 
		and s.dt >= '$start_date'
		and s.dt <= '$end_date'
	";
	return $sold = $rodb->getCellFromDB($q);
}
function getNextSaleRTNO(){
	global $rodb;
	$q = "select max(rtno)+1 rtno from ".$rodb->prefix."sale where userid = '".getAPIBusinessId()."'";
	return $rodb->getCellFromDB($q);
}

function getPaymentsTotal($start_date = '', $end_date = ''){
	global $rodb;
	if($start_date == '') $start_date = ro_date('Y-m-d 00:00:00');
	if($end_date == '') $end_date = ro_date('Y-m-d 23:59:59');
	$q = "select sum(payment) from ".$rodb->prefix."transactions where 
	user_id = '".getBusinessId()."' 
	and payment > 0
	and dt >= '$start_date'
	and dt <= '$end_date'";
	$total_sale = $rodb->getCellFromDB($q);
	return ($total_sale > 0)?$total_sale:0;
}

function getSalesTotal($start_date = '', $end_date = ''){
	global $rodb;
	if($start_date == '') $start_date = ro_date('Y-m-d 00:00:00');
	if($end_date == '') $end_date = ro_date('Y-m-d 23:59:59');
	$q = "select sum(gTotal) from ".$rodb->prefix."sale where 
	userid = '".getBusinessId()."' 
	and dt >= '$start_date'
	and dt <= '$end_date'";
	$total_sale = $rodb->getCellFromDB($q);
	return ($total_sale > 0)?$total_sale:0;
}

function getLedgersTotal(){
	global $rodb;
	$q = "select sum(current_balance) from ".$rodb->prefix."customers where 
	user_id = '".getBusinessId()."'";
	$total_ledgers = $rodb->getCellFromDB($q);
	return ($total_ledgers > 0)?ro_round($total_ledgers):0;
}

function getReceivablesTotal(){
	global $rodb;
	$q = "select sum(current_balance) from ".$rodb->prefix."customers where 
	user_id = '".getBusinessId()."'
	and current_balance > 0
	";
	$total_ledgers = $rodb->getCellFromDB($q);
	return ($total_ledgers > 0)?ro_round($total_ledgers):0;
}

function getPayablesTotal(){
	global $rodb;
	$q = "select sum(current_balance) from ".$rodb->prefix."customers where 
	user_id = '".getBusinessId()."'
	and current_balance < 0
	";
	$total_ledgers = $rodb->getCellFromDB($q);
	return ($total_ledgers > 0)?ro_round($total_ledgers):0;
}

function getStocksTotal(){
	global $rodb;
	$q = "select sum(stock*purchase_price) from ".$rodb->prefix."product where 
	userid = '".getBusinessId()."'";
	$total_stock = $rodb->getCellFromDB($q);
	return ($total_stock > 0)?ro_round($total_stock):0;
}

function getSalesList($start_date = '', $end_date = ''){
	global $rodb;
	if($start_date == '') $start_date = ro_date('Y-m-d 00:00:00');
	if($end_date == '') $end_date = ro_date('Y-m-d 23:59:59');
	$saleq = " select * from ".$rodb->prefix."sale sv2 inner join ".$rodb->prefix."sale_products spv2 
	on sv2.id = spv2.sale_id 
	and sale_id in (select id from ".$rodb->prefix."sale where userid='".getBusinessId()."' 
	and is_gatepass != 1
	and dt >= '".$start_date."' and dt <= '".$end_date."' ) 
	group by sv2.rtno
	order by sv2.is_edited asc, sv2.dt asc, sv2.rtno ";
	return $rodb->getTableFromDB($saleq);
}

function getSaleDiscount($product_id){
	global $rodb;
	
	$q = "select * from ".$rodb->prefix."product 
	where productid='".$product_id."'
	";
	$product = $rodb->getRowFromDB($q);
	if(isset($product['sale_discount']) && $product['sale_discount'] > 0){
		return $product['sale_discount'];
	}elseif(isset($product['sale_price']) && isset($product['sale_discount_percent'])){
		return $product['sale_price']*$product['sale_discount_percent']/100;
	}
	
	return 0;
}
function getSalePrice($product_id, $customer_id = 0){
	global $rodb;
	if(!$product_id > 0) return 0;
	$sale_price = 0;
	if($customer_id > 0){
		$q = "select sp.sale_price from ".$rodb->prefix."sale_products sp inner join ".$rodb->prefix."sale s on s.id=sp.sale_id 
		where productid='".$product_id."'
		and s.customerid = '".$customer_id."'
		order by s.dt desc
		";
		$sale_price = $rodb->getCellFromDB($q);
	}
	if(!$sale_price > 0){
		$q = "select sale_price from ".$rodb->prefix."product where productid='".$product_id."'";
		$sale_price = $rodb->getCellFromDB($q);
	}
	return $sale_price;
}
function addSaleBillItemsStock($sale_id){
	global $rodb;
	$q = "update ".$rodb->prefix."product p inner join ".$rodb->prefix."_sale_products sp on p.productid = sp.productid and sp.sale_id='$sale_id' set p.stock = p.stock+sp.qty where sale_id='$sale_id'";
	$rodb->execute($q);
}

function deductSaleBillItemsStock($sale_id){
	global $rodb;
	$q = "update ".$rodb->prefix."product p inner join ".$rodb->prefix."_sale_products sp on p.productid = sp.productid and sp.sale_id='$sale_id' set p.stock = p.stock-sp.qty where sale_id='$sale_id'";
	$rodb->execute($q);
}

function addPurchaseBillItemsStock($purchase_id){
	global $rodb;
	$q = "update ".$rodb->prefix."product p inner join ".$rodb->prefix."buy_products bp on p.productid = bp.product_id and bp.buy_id='$purchase_id' set p.stock = p.stock+bp.quantity where buy_id='$purchase_id'";
	$rodb->execute($q);
}

function deductPurchaseBillItemsStock($purchase_id){
	global $rodb;
	$q = "update ".$rodb->prefix."product p inner join ".$rodb->prefix."buy_products bp on p.productid = bp.product_id and bp.buy_id='$purchase_id' set p.stock = p.stock-bp.quantity where buy_id='$purchase_id'";
	$rodb->execute($q);
}

function getCompleteProductName($productid){
	global $rodb;
    return $rodb->getCellFromDB("select concat(tc.tc_name, '-', cat.cat_name, '-', p.productname) from ".$rodb->prefix."product p inner join ".$rodb->prefix."category cat
on cat.cat_id = p.cat_id inner join ".$rodb->prefix."top_category tc
on tc.tc_id = cat.cat_tc_id
and p.productid = '".$productid."'");
}

function getTopCategories($userid=''){
	global $rodb;
	$topcatQ = "select * from ".$rodb->prefix."top_category where tc_user_id='".$userid."'";
	$retTopCategories = $rodb->getTableFromDB($topcatQ);
	return $retTopCategories;
}
function getCategories($userid='', $tc_id = ''){
	global $rodb;
	if(!empty($tc_id)){
		$cat_filter = " and cat_tc_id = '$tc_id'";
	}
	$catQ = "select * from ".$rodb->prefix."category where user_id='".$userid."' $cat_filter";
	$retCategories = $rodb->getTableFromDB($catQ);
	return $retCategories;
}
function getCategoryProducts($userid='', $cat_id = ''){
	global $rodb;
	if(!empty($cat_id)){
		$cat_filter = " and cat_id = '$cat_id'";
	}
	$productQ = "select * from ".$rodb->prefix."product where userid='".$userid."' $cat_filter order by productname";
	$retProducts = $rodb->getTableFromDB($productQ);
	return $retProducts;
}
function getProductByID($userid='', $product_id=''){
	global $rodb;
	$productQ = "select * from ".$rodb->prefix."product where userid='".$userid."' 
	and productid='".$product_id."'
	order by productname";
	$retProduct = $rodb->getRowFromDB($productQ);
	return $retProduct;
}

function setGatePassIn($purchase_id){
	global $rodb;
	$rodb->updateInDB("type='1'","id='".$purchase_id."'",$rodb->prefix."buy");
}
function setGatePassOut($sale_id){
	global $rodb;
	$rodb->updateInDB("is_gatepass='1'","id='".$sale_id."'",$rodb->prefix."sale");
}
function showPrintGatePassOut($billno = 0){
    global $rodb;
    $_REQUEST['rtno'] = $billno;
    if($_REQUEST['sale_id']==''){
        $_REQUEST['sale_id'] = $rodb->getCellFromDB("select id from ".$rodb->prefix."sale where rtno='".$_REQUEST['rtno']."' and userid='".getBusinessId()."' ");
    }

    $salestax = $rodb->getCellFromDB("select saletax from user where uid='".getBusinessId()."' ");
    $saleq = "
    select 
        * 
    from 
        ".$rodb->prefix."sale sv2 inner join ".$rodb->prefix."sale_products spv2
        on sv2.id = '".$_REQUEST['sale_id']."'
        and sv2.id = spv2.sale_id
        and sv2.userid='".getBusinessId()."'
    ";
    $sale = $rodb->getTableFromDB($saleq);
    $dt=explode(" ",$sale[0]['dt']);
    $dt = $dt[0];
    ?>
    <table align='center' id='product_lines' width='75%' border='0' style='border-collapse:collapse'>
            <tbody>
                    <tr><td colspan="2" height="10"></td></tr>
                    <tr>
                            <td width="66%" align="left" valign="top" style="color:#336600">
                                    <strong><?php 
                                    if($sale[0]['customerid']=='0'){echo "Cash";}
                                    else
                                    {
    //						$custinfo = $rodb->getTableFromDB("select * from ".$rodb->prefix."customers where customer_id='".$sale[0]['customerid']."'"); 
                                            $custinfo = $rodb->getTableFromDB("select * from ".$rodb->prefix."customers where customer_id='".$sale[0]['customerid']."'"); 
                                            if(!empty($custinfo[0]['customer_name'])){
                                                    echo $custinfo[0]['customer_name'];
                                            }
                                            if(!empty($custinfo[0]['customer_address'])){
                                                    echo "<br />".$custinfo[0]['customer_address'];
                                            }
                                            if(!empty($custinfo[0]['customer_phone'])){
                                                    echo "<br />Tel: ".$custinfo[0]['customer_phone'];
                                            }
                                            if(!empty($custinfo[0]['contact_person'])){
                                                    echo "<br />Kind Attn: ".$custinfo[0]['contact_person'];
                                            }
                                    }
                                    ?></strong>
                      </td>
                      <td width="34%" align="left" valign="top" style="color:#336600">
                            <strong>Gate Pass Out- <?php echo $sale[0]['rtno']?></strong><br />
                            <?php if($sale[0]['fileno']){ ?><strong>Purpose #: <?php echo $sale[0]['fileno']?></strong><br /><?php } ?>
                            <strong>Dated: <?php echo $dt?></strong>
                      </td>
                    </tr>

            </tbody>
            <tbody bgcolor="#F5F5F5">
                    <tr>
                            <td colspan="5" align="left">
                                    <table border="1" style="border-collapse:collapse" align="center" width="100%">
                                        <tr bgcolor='#d1fdcc'><th align="left" style="padding-left:5px;" colspan="3"><?php echo $_SESSION['product_label1']?></th><th align="left" style="padding-left:5px;">Quantity</th></tr>
                    <?php 
                            $i=0;
                            while($sale[$i])
                            {
                                    $prdname = $rodb->getCellFromDB("select productname from ".$rodb->prefix."product where productid='".$sale[$i]['productid']."'");
                                    $categinfo = $rodb->getTableFromDB("select * from ".$rodb->prefix."category where cat_id='".$sale[$i]['cat_id']."'");
                                    $catname = $categinfo[0]['cat_name'];
                                    $iteminfo = $rodb->getTableFromDB("select * from ".$rodb->prefix."top_category where tc_id='".$categinfo[0]['cat_tc_id']."'");
                    ?>
                                    <tr bgcolor="#FFFFFF">
                                        <td align='left' class="data_cell" colspan="3">
                                                <?php echo $iteminfo[0]['tc_name'];?>-<?php echo $catname?>-<?php echo $prdname?></td>
                                            <td align='left' class="data_cell"><?php echo $sale[$i]['qty']?></td>
                                    </tr>
                    <?php 
                                    $total_quantity += $sale[$i]['qty'];
                                    $Total += $sale[$i]['qty']*$sale[$i]['sale_price'];
                                    $i++;
                            }
                    ?>
                                    <tr bgcolor='#d1fdcc'><td align='right' colspan='3' class="right_padding_cell"><strong>Total </strong></td>
                                            <td class="data_cell"><?php echo $total_quantity?></td>
                                    </tr>
                                    </table>
                            </td>
                    </tr>
            </tbody>
    </table>
<?php 
}
function sortByOrder($a, $b) {
    return $a['dt'] > $b['dt'];
}
function getItemStock($p_id = 0){
    if(!$p_id > 0){
        return;
    }
    global $rodb;
    $q = "select stock from ".$rodb->prefix."product where productid='$p_id'";
    updateItemStock($p_id);
    
    return $rodb->getCellFromDB($q);
}
function updateItemStock($p_id = 0){
    if(!$p_id > 0){
        return;
    }
    global $rodb;
    $_GET['id'] = $p_id;
    $current_balance = 0;
    $rodb->prefix = 'ro_0_';
    $product_id_q = "select productid from ".$rodb->prefix."product where userid = '".getBusinessId()."' and productid > '".$rodb->mysql_real_escape_string($_GET['id'])."' order by productid asc limit 1";
    $_GET['id'] = $rodb->getCellFromDB($product_id_q);

    
    $product_id = $rodb->mysql_real_escape_string($_GET['id']);
    $sales_q = "SELECT s.dt dt, s.*, sp.* FROM `".$rodb->prefix."sale_products` sp inner join ".$rodb->prefix."sale s 
    on sp.sale_id = s.id
    and sp.productid = '".$product_id."'
    and s.rtno != '0'
    order by s.dt asc
    ";
    $all_sales = $rodb->getTableFromDB($sales_q);
    $purchases_q = "SELECT b.buy_date dt, b.*, bp.* FROM `".$rodb->prefix."buy_products` bp inner join ".$rodb->prefix."buy b 
    on bp.buy_id = b.id
    and bp.product_id = '".$product_id."'
    order by b.buy_date asc
    ";
    $all_purchases = $rodb->getTableFromDB($purchases_q);
    $items = ro_array_merge($all_sales, $all_purchases);
    
    if(isset($items) && is_array($items))
    usort($items, 'sortByOrder');
    $rodb->updateInDB("stock='0'", "productid='".$product_id."'", $rodb->prefix."product");
    if(isset($items) && is_array($items) && count($items) > 0){
        $total_qty_packs = 0;

        foreach($items as $item){
            $item['qty'] = (isset($item['qty']))?$item['qty']:0;
            $item['quantity'] = (isset($item['quantity']))?$item['quantity']:0;
                if(getFlag_packs_quantity()){
                    if($item['qty'] <= $item['quantity']){
                        $total_qty_packs += $item['qty_packs'];
                    }
                }
                if(getFlag_packs_quantity()){
                    if($item['qty'] > $item['quantity']){
                        $total_qty_packs -= $item['qty_packs'];
                    }
                }
                $current_balance += $item['quantity']-$item['qty'];
            $rodb->updateInDB("stock='".$current_balance."'", "productid='".$product_id."'", $rodb->prefix."product");
        }
    }
}

function updateCustomerLedger($cid = 0){
    if($cid == 0){
        return;
    }
    global $rodb;
    $_REQUEST['customerid'] = $cid;
    $total_debit = 0;
    $total_credit = 0;

    $customerid_q = "select customer_id from ".$rodb->prefix."customers where user_id = '".getBusinessId()."' and customer_id > '".$rodb->mysql_real_escape_string($_REQUEST['customerid'])."' order by customer_id asc limit 1";
    $_REQUEST['customerid'] = $rodb->getCellFromDB($customerid_q);

    /////////////////////////
    $start_date = (isset($_REQUEST['fromyear']) && isset($_REQUEST['frommonth']) && isset($_REQUEST['fromday']))?$_REQUEST['fromyear']."-".$_REQUEST['frommonth']."-".$_REQUEST['fromday']:'';
    $end_date = (isset($_REQUEST['fromyear']) && isset($_REQUEST['frommonth']) && isset($_REQUEST['fromday']))?$_REQUEST['toyear']."-".$_REQUEST['tomonth']."-".$_REQUEST['today'].' 23:59:59':@date('Y-m-d 23:59:59');

    $q_custinfo = " select * from ".$rodb->prefix."customers where customer_id='".$_REQUEST['customerid']."' and user_id = '".getBusinessId()."'";
    $custinfo = $rodb->getTableFromDB($q_custinfo);
    $current_balance = $rodb->getCellFromDB(" select cb_balance from ".$rodb->prefix."customer_balance where cb_userid='".getBusinessId()."' and cb_date = (select max(cb_date) from ".$rodb->prefix."customer_balance where cb_date < '".$start_date."' and cb_userid='".getBusinessId()."' and cb_customerid = '".$custinfo[0]['customer_id']."') ");

    if(!$current_balance>0){
        if($custinfo[0]['dt'] > $start_date){
            $current_balance=$custinfo[0]['opening_balance'];
        }else{
            $current_balance=0;
        }
    }
    $delete_customer_balance_q = "delete from ".$rodb->prefix."customer_balance where cb_userid = '".getBusinessId()."' and cb_customerid = '".$_REQUEST['customerid']."'";
    $rodb->execute($delete_customer_balance_q);
    $invoicesq = " select * from ".$rodb->prefix."sale where customerid='".$_REQUEST['customerid']."' and userid='".getBusinessId()."' and dt between '".$start_date."' and '".$end_date."' order by dt asc ";
    $invoices = $rodb->getTableFromDB($invoicesq);
    
    $paymentsq = " select * from ".$rodb->prefix."transactions where customer_id='".$_REQUEST['customerid']."' and user_id='".getBusinessId()."' and dt between '".$start_date."' and '".$end_date."' order by dt asc ";
    $payments = $rodb->getTableFromDB($paymentsq);
    
    $returnsq = " select * from ".$rodb->prefix."sale_return where customerid='".$_REQUEST['customerid']."' and userid='".getBusinessId()."' and dt between '".$start_date."' and '".$end_date."' order by dt asc ";
    $returns = $rodb->getTableFromDB($returnsq);
    
    $purchaseq = " select *, id buy_id, buy_date dt from ".$rodb->prefix."buy where customer='".$_REQUEST['customerid']."' and userid='".getBusinessId()."' and buy_date between '".$start_date."' and '".$end_date."' order by buy_date asc ";
    $purchases = $rodb->getTableFromDB($purchaseq);
    
    $ledger = $invoices;
    
    $j = 0;
    $i = count($invoices);
    while(isset($payments[$j])){
        $ledger[$i] = $payments[$j];
        $i++;
        $j++;
    }
    $j = 0;
    while(isset($returns[$j])){
        $ledger[$i] = $returns[$j];
        $i++;
        $j++;
    }
    $j = 0;
    while(isset($purchases[$j])){
        $ledger[$i] = $purchases[$j];
        $i++;
        $j++;
    }
    if(isset($ledger) && is_array($ledger) && count($ledger) > 0 && $ledger[0] != ''){
        usort($ledger,"compare_date");
    }
    if(isset($ledger[0]))
    {
        $class = 'bgcolor="#CCCCCC"';
        $i=0;
        while(isset($ledger[$i])){
            if($class == 'bgcolor="#CCCCCC"'){
                $class = '';
            }else{
                $class = 'bgcolor="#CCCCCC"';
            }
            $ledger_date = $ledger[$i]['dt'];
            $ledger[$i]['dt'] = date("d M, Y", strtotime($ledger[$i]['dt']));
            if(isset($ledger[$i]['returnno'])){
                //if($ledger[$i]['gTotal'] == '' || $returns[$i]['gTotal'] == 0){echo "0";}else{echo round($returns[$i]['gTotal'],2);}
                $current_balance -= $returns[$i]['gTotal'];
            
                    if($returns[$i]['gTotal'] > 0){
                        $total_debit += 0;
                        $total_credit += $returns[$i]['gTotal'];
                    }else{
                        $total_debit += (-$returns[$i]['gTotal']);
                        $total_credit += 0;
                    }
                }else if(isset($ledger[$i]['payment'])){
                    //if($ledger[$i]['payment'] == '' || $ledger[$i]['payment'] == 0){echo "0";}else{echo round($ledger[$i]['payment'],2);}
                    $current_balance -= $ledger[$i]['payment'];
                    if($ledger[$i]['payment'] < 0){
                        $total_debit += (-$ledger[$i]['payment']);
                        $total_credit += 0;
                    }else{
                        $total_debit += 0;
                        $total_credit += $ledger[$i]['payment'];
                    }
                }else if(isset($ledger[$i]['rtno'])){
                    //if($ledger[$i]['gTotal'] == '' || $ledger[$i]['gTotal'] == 0){echo "0";}else{echo round($ledger[$i]['gTotal'],2);}
                    $current_balance += $ledger[$i]['gTotal'];
            
                    if($ledger[$i]['gTotal'] < 0){
                        $total_debit += 0;
                        $total_credit += (-$ledger[$i]['gTotal']);
                    }else{
                        $total_debit += $ledger[$i]['gTotal'];
                        $total_credit += 0;
                    }
                }else if($ledger[$i]['buy_id'] != ''){
                    //if($ledger[$i]['total'] == '' || $ledger[$i]['total'] == 0){echo "0";}else{echo round($ledger[$i]['total'],2);}
                    $current_balance -= $ledger[$i]['total'];
                    if($ledger[$i]['total'] < 0){
                        $total_debit += (-$ledger[$i]['total']);
                        $total_credit += 0;
                    }else{
                        $total_debit += 0;
                        $total_credit += $ledger[$i]['total'];
                    }
                }
            $cb_id = $rodb->getCellFromDB("select cb_id from ".$rodb->prefix."customer_balance where cb_userid = '".getBusinessId()."' and cb_customerid = '".$_REQUEST['customerid']."' and cb_date = '$ledger_date'");
            if($cb_id > 0){
                $update_ledger_q = "update ".$rodb->prefix."customer_balance set cb_balance = '$current_balance' where cb_userid = '".getBusinessId()."' and cb_customerid = '".$_REQUEST['customerid']."' and cb_date = '$ledger_date'";
                $rodb->execute($update_ledger_q);
            }else{
                $data = "(cb_userid, cb_customerid, cb_balance, cb_date) values ('".getBusinessId()."', '".$_REQUEST['customerid']."', '$current_balance', '$ledger_date')";
                $rodb->writeToDB($data, $rodb->prefix."customer_balance");
            }

            $update_current_balance_q = "update ".$rodb->prefix."customers set current_balance = '$current_balance' where user_id = '".getBusinessId()."' and customer_id = '".$_REQUEST['customerid']."'";
            $rodb->execute($update_current_balance_q);

            $i++;
        }
    }
}