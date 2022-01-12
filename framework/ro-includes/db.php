<?php 
$sms_username = 'sajidtech';
$sms_password = '68248';
// $sms_from = 'YOUACCOUNTS';
$sms_from = '88434';

include($framework_dir.'/ro-hidden_config.php');
if(file_exists($project_dir.'/ro-hidden_config.php'))
	include($project_dir.'/ro-hidden_config.php');

class db{
	var $server;
	var $dbname;
	var $dbuser;
	var $dbpass;
	var $prefix;
	var $db;
	//constructor
	function __construct($server,$dbname,$dbuser,$dbpass){

		$this->server = $server;

		$this->dbname = $dbname;

		$this->dbuser = $dbuser;

		$this->dbpass = $dbpass;

		@session_start();

//		$this->prefix = "ro_".getBusinessId()."_";

		$this->prefix = "ro_".
		((isset($_SESSION) && isset($_SESSION['ses_table_prefix']))?
		$_SESSION['ses_table_prefix']:'0')."_";

	}



	//connect to database

	function connectDB() {

  	$this->db = new \MySQLi($this->server,$this->dbuser,$this->dbpass);	

  	//return();

  }	



	//disconnect from databas

	function disconnectDB() {

		if (isset($db)) {

	 		mysqli_close($db);

		}

  }	



	//return all the rows that matches the query

	function getTableFromDB($query) {

//	echo $query.'<br/>';

	//exit();

		if (!isset($db)) {

			$db = @mysqli_connect($this->server,$this->dbuser,$this->dbpass);	

		}

		

		if(strlen(mysqli_error($db)) > 1) {

			print "ERROR: " . mysqli_error($db);

		}

		mysqli_select_db($db, $this->dbname);		

		

// Modified by Saqib Aziz for fetching array of utf8 type		

		mysqli_query($db, 'SET NAMES utf8');

		mysqli_query($db, "SET collation_connection = 'utf8_general_ci'");	

//--------------------------------------------------		

		$result = mysqli_query($db, $query);

		$i=0;
		$retArr = array();
		
		while($row = @mysqli_fetch_array($result)) {

			$retArr[$i++]=$row;

		}

		return($retArr);

	 }



	//inserts into the db

	function writeToDB($data,$table_name) {

		if (!isset($db)) {

			$db = @mysqli_connect($this->server,$this->dbuser,$this->dbpass);	

		}

	

		mysqli_select_db($db, $this->dbname);	

		

		$query = "INSERT INTO $table_name $data";

		//echo $query.'<br><br>';

		//exit;

	

	// Modified by Saqib Aziz for fetching array of utf8 type		

		mysqli_query($db, 'SET NAMES utf8');

		mysqli_query($db, "SET collation_connection = 'utf8_general_ci'");	

	//--------------------------------------------------		

		

		mysqli_query($db, $query);

		$err_msg =  mysqli_error($db);		

		$errorandid[] = $err_msg;

		$errorandid[] = mysqli_insert_id($db);

//		mysqli_close($db);	

		//return $err_msg;

		return($errorandid);

 	}

	//update db

	function execute($query){

		if (!isset($this->db)) {
			$this->db = mysqli_connect($this->server,$this->dbuser,$this->dbpass);	

		}
	

		mysqli_select_db($this->db, $this->dbname);	

//		$query = "INSERT INTO $table_name $data";

		//echo $query.'<br><br>';

		//exit;

	

	// Modified by Saqib Aziz for fetching array of utf8 type		

		mysqli_query($this->db, 'SET NAMES utf8');

		mysqli_query($this->db, "SET collation_connection = 'utf8_general_ci'");	

	//--------------------------------------------------		

		

		mysqli_query($this->db, $query);

		$err_msg =  mysqli_error($this->db);		

		$errorandid[] = $err_msg;

		$errorandid[] = mysqli_insert_id($this->db);

//		mysqli_close($db);	

		//return $err_msg;

		return($errorandid);

 	}

	function updateInDB($field_data,$where_clause,$table_name) {

 						

	if (!isset($db)) {

			$db = @mysqli_connect($this->server,$this->dbuser,$this->dbpass);	

	}



 	mysqli_select_db($db, $this->dbname);

	//$field_data = stripslashes($field_data); 

	

	// Modified by Saqib Aziz for fetching array of utf8 type		

		mysqli_query($db, 'SET NAMES utf8');

		mysqli_query($db, "SET collation_connection = 'utf8_general_ci'");	

	//--------------------------------------------------			


 	$query = "UPDATE $table_name SET $field_data WHERE $where_clause";	
	//exit();

	mysqli_query($db, $query);



 	$err_msg = mysqli_error($db);

// 	mysqli_close($db);

 	return($err_msg);

 }

function qstr($val){

	return "'".addslashes($val)."'";

}

	function getRowFromDB($query) {



		if (!isset($db)) {

			$db = @mysqli_connect($this->server,$this->dbuser,$this->dbpass);	

		}

		

		if(strlen(mysqli_error($db)) > 1) {

			print "ERROR: " . mysqli_error($db);

		}

		mysqli_select_db($db, $this->dbname);		

		

// Modified by Saqib Aziz for fetching array of utf8 type		

		mysqli_query($db, 'SET NAMES utf8');

		mysqli_query($db, "SET collation_connection = 'utf8_general_ci'");	

//--------------------------------------------------		

		$result = mysqli_query($db, $query);

		

		$i=0;

		while($row = @mysqli_fetch_array($result)) {

			$retArr[$i++]=$row;

		}

		//echo $query;

//		mysqli_close($db);

		return (isset($retArr[0]))?$retArr[0]:'';

	 }



// returns one value

	function getCellFromDB($query) {
		$row = '';



	if (!isset($db)) {

		$db = @mysqli_connect($this->server,$this->dbuser,$this->dbpass);	

	}



	mysqli_select_db($db, $this->dbname);

	$result = mysqli_query($db, $query);

	if($result)

	{

		$row = mysqli_fetch_row($result);

		mysqli_free_result($result);

	}

//	mysqli_close($db);

	return (isset($row) && isset($row[0]))?($row[0]):'';

 }

 //delete from db

 function deleteFromDB($query) {

 	$db = mysqli_connect($this->server,$this->dbuser,$this->dbpass);	

	mysqli_select_db($db, $this->dbname);

	mysqli_query($db, $query);

	//echo $query.'<br/>';

	$err_msg =  mysqli_error($db);

//	mysqli_close($db);

	return $err_msg;

 }

 

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//generates a list of categories with sequence

	function showallcategories($table_name,$returncolumns,$condition,$comparisoncol1,$comparisoncol2,$val,$k)

	{

		$returncolumns_list = explode(",",$returncolumns);

		$total_returncolumns_list = count($returncolumns_list);

		

		echo $val;

		if($val >= 0)

		{

			return;

			$query = "

			select 

				$returncolumns

			from

				$table_name

			where

				$comparisoncol2 = '$val'

				and $condition

			";

			$row = $this->getTableFromDB($query);

		

			$j=0;

			while($total_returncolumns_list > $j)

			{

				$a[$k][$returncolumns_list[$j]] = $row[0][$returncolumns_list[$j]];

				$j++;

			}

			return $a;

		}

		

		$query = "

		select 

			$comparisoncol1,$returncolumns 

		from

			$table_name

		where

			$comparisoncol2 = '$val'

			and $condition

		";

		$row = $this->getTableFromDB($query);

		

//		$a[$returncolumns_list[0]] = $row[0][$returncolumns_list[0]];

		$a = $this->showallcategories($table_name,$returncolumns,$condition,$comparisoncol1,$comparisoncol2,$row[0][$comparisoncol1],$k+1);

		$j=0;

		while($total_returncolumns_list > $j)

		{

			$a[$k][$returncolumns_list[$j]] = $row[0][$returncolumns_list[$j]];

			$j++;

		}

		return $a;

		

/*

		if (!$db) {

			$db = mysqli_connect($this->server,$this->dbuser,$this->dbpass);	

		}

		

		if(strlen(mysqli_error($db)) > 1) {

			print "ERROR: " . mysqli_error($db);

		}

		mysqli_select_db($db, $this->dbname);		

		

// Made by Sajid 

		mysqli_query($db, 'SET NAMES utf8');

		mysqli_query($db, "SET collation_connection = 'utf8_general_ci'");	

//--------------------------------------------------		

		$query = "

		select 

			$returncolumns,$comparisoncol 

		from

			$table_name

		where

			$condition

		";

		$result = mysqli_query($db, $query);



		print mysqli_error();

		$i=0;

		

		while($row = mysqli_fetch_array($result)) 

		{

			echo "<option value='".$row[$value_column]."'";

			if($row[$value_column] == $selected_value){echo " selected";}

			echo">";

			echo $row[$show_columnlist[0]];

			$j = 1;

			while($total_show_columnlist > $j)

			{

				echo " - ".$row[$show_columnlist[$j]];

				$j++;

			}

			echo "</option>";

			$i++;

		}

		// mysqli_close($db);

//		return($retArr);

*/

	}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//generates a combo listing for a table

	function generateComboListing($show_column,$value_column,$table_name,$condition,$selected_value) 

	{
		$show_columnlist = explode(",",$show_column);

		$total_show_columnlist = count($show_columnlist);

		

		if (!isset($db)) {

			$db = mysqli_connect($this->server,$this->dbuser,$this->dbpass);	

		}

		

		if(strlen(mysqli_error($db)) > 1) {

			print "ERROR: " . mysqli_error($db);

		}

//		echo $this->dbname;

		mysqli_select_db($db, $this->dbname);		

		

// Modified by Saqib Aziz for fetching array of utf8 type		

		mysqli_query($db, 'SET NAMES utf8');

		mysqli_query($db, "SET collation_connection = 'utf8_general_ci'");	

//--------------------------------------------------		

		$query = "

		select 

			$show_column,$value_column 

		from

			$table_name

		where

			$condition

		";

		$result = mysqli_query($db, $query);

		//echo $query.'<br>';

		print mysqli_error($db);

		$i=0;

		

		while($row = mysqli_fetch_array($result)) 

		{

//			$retArr[$i++]=$row;

			echo "<option value='".$row[$value_column]."'";

			if($row[$value_column] == $selected_value){echo " selected";}

			echo">";

			echo $row[$show_columnlist[0]];

			$j = 1;

			while($total_show_columnlist > $j)

			{

				echo " - ".$row[$show_columnlist[$j]];

				$j++;

			}

			echo "</option>";

			$i++;

		}

		// mysqli_close($db);

//		return($retArr);

	}

	function generateCustomerCombo($userid, $selected=''){
		global $dblink;
		$retCustomerCombo = '';
		$customerQ = "select * from ".$this->prefix."customers where user_id='".$userid."' order by customer_name asc";
		$customer = $dblink->getTableFromDB($customerQ);
		$c_counter=0;
		while(isset($customer[$c_counter])){
			if($selected == $customer[$c_counter]['customer_id']) $sel = " selected='selected'";
			else $sel = "";
			$retCustomerCombo .= "<option value='".$customer[$c_counter]['customer_id']."' $sel>".
			$customer[$c_counter]['customer_name']."</option>";
			$c_counter++;
		}
		return $retCustomerCombo;
	}
	function getCustomers($userid=''){

		global $dblink;
		$retCustomers = '';
		$customerQ = "select * from ".$this->prefix."customers where user_id='".$userid."' order by customer_name asc";
		$customer = $dblink->getTableFromDB($customerQ);
		$c_counter=0;
		while(isset($customer[$c_counter])){
			$retCustomers[] = array(
			'customer_name' => $customer[$c_counter]['customer_name'],
			'customer_phone' => $customer[$c_counter]['customer_phone'],
			'customer_address' => $customer[$c_counter]['customer_address'],
			'customer_id' => $customer[$c_counter]['customer_id']);
			$c_counter++;
		}
		return $retCustomers;
	}
	function getProducts($userid=''){
		global $dblink;
		$productQ = "select * from ".$this->prefix."product where userid='".$userid."' and enabled=1 order by productname asc";
		$product = $dblink->getTableFromDB($productQ);
		$counter=0;
		$retProducts = array();
		if(isset($product) && is_array($product) && count($product) > 0)
		while(isset($product[$counter])){
			$retProducts[] = array(
			'tc' => '',
			'cat_name' => '',
			'productcode' => $product[$counter]['productcode'],
			'productname' => $product[$counter]['productname'],
			'productid' => $product[$counter]['productid'],
			'comments' => $product[$counter]['comments'],
			'stock' => $product[$counter]['stock'],
			'sale_price' => $product[$counter]['sale_price']
			);
			$counter++;
		}
		return $retProducts;
	}
	function generateItemCombo($userid,$selected=''){
		global $dblink;
				$productQ = "select * from ".$this->prefix."product where userid='".$userid."' order by productname asc";
				$product = $dblink->getTableFromDB($productQ);
				$p_counter=0;
				while($product[$p_counter]){
					if($selected == $product[$p_counter]['productid']) $sel = " selected='selected'";
					else $sel = "";
					$retItemCombo .= "<option value='".$product[$p_counter]['productid']."'".$sel.">".$product[$p_counter]['productname']."</option>";
					$p_counter++;
				}
		return $retItemCombo;
	}

	function getAvailableStock($product,$userid){

		$q = "select stock from ".$this->prefix."product where productid='".$product."' and userid='".$userid."'";

		return $this->getCellFromDB($q);

	}

	function mysql_real_escape_string($str){
		if (!isset($db)) {

			$db = @mysqli_connect($this->server,$this->dbuser,$this->dbpass);	

		}
		return mysqli_real_escape_string($db, $str);
	}

}

function check_mysqli_affected_rows($dblink){

		return  mysqli_affected_rows();

//	mysqli_close($db);		

}
$dblink = new db($server,$dbname,$dbuser,$dbpass);

$dblink->connectDB();

//$rodb = new db($server,$dbname,$dbuser,$dbpass);

//$rodb->connectDB();

$rodb = $dblink;
		if(!defined('CUSTOMIZABLE_URL'))
			define('CUSTOMIZABLE_URL', $framework_url."customizable/");
        define('CUSTOMIZABLE_DIR', $framework_dir."/customizable/");
        define('MODULES_URL', CUSTOMIZABLE_URL."modules/");
        define('MODULES_DIR', CUSTOMIZABLE_DIR."modules/");
        define('THEME_URL', CUSTOMIZABLE_URL."themes/".$theme_name."/");
        define('THEME_DIR', CUSTOMIZABLE_DIR."themes/".$theme_name."/");

        include($framework_dir.'/functions.php');
        // include($framework_dir.'/functions_transactions.php');
        // include($framework_dir.'/functions_customers.php');
        // include($framework_dir.'/functions_products.php');
        // include($framework_dir.'/functions_sms.php');
        // include($framework_dir.'/functions_sale.php');
        // include($framework_dir.'/functions_gatepass.php');
		include $framework_dir."/ro-includes/globals.php";

		//////////////////////////////// including modules ////////////////////////////////////////
		if(file_exists($project_dir.'/menu.php'))
			include ($project_dir.'/menu.php');
		else
	        include $framework_dir."/ro-includes/menu.php";
		if(file_exists($project_dir.'/customizable/modules/purchase/purchase.php'))
			include ($project_dir.'/customizable/modules/purchase/purchase.php');
		else
			include ($framework_dir.'/customizable/modules/purchase/purchase.php');
		if(file_exists($project_dir.'/customizable/modules/reminder/reminder.php'))
			include ($project_dir.'/customizable/modules/reminder/reminder.php');
		else
			include ($framework_dir.'/customizable/modules/reminder/reminder.php');
		
		if(file_exists($project_dir.'/customizable/modules/expenditure/expenditure.php'))
			include ($project_dir.'/customizable/modules/expenditure/expenditure.php');
		else
			include ($framework_dir.'/customizable/modules/expenditure/expenditure.php');
        
        if(file_exists($project_dir.'/licence.php'))
			include ($project_dir.'/licence.php');
		else if(file_exists($framework_dir.'/licence.php'))
			include ($framework_dir.'/licence.php');

		delayForTrial();
		if(getBusinessId() == 1){
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
		}
		
?>