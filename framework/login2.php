<?php
	if( isset($_POST) && isset($_POST['login_form_submitted']) && $_POST['login_form_submitted'] == 'yes' ){
		$q = " select * from user where username = '".$rodb->mysql_real_escape_string($_REQUEST['username'])."' and password = '".$rodb->mysql_real_escape_string($_REQUEST['password'])."' and active = '1'";
		$result = $rodb->getTableFromDB($q);
		if(isset($result[0]['uid'])){
			
			$trial_result = isTrialContinued($result[0]['licence']);
			
			if($licence === getMac()){
			}elseif('trial' === $trial_result){
				$_SESSION['trial'] = true;
			}else if($trial_result){
			}else{
				// echo 
				'Please renew your licence by sending amount on <br />
				HBL <br />
				0006187902113403<br />
				MUHAMMAD SAJID<br />
				----------------------------------------------<br />
				STANDARD CHARTERED<br />
				01395908201<br />
				MUHAMMAD SAJID<br />
				----------------------------------------------<br />
				JAZZ CASH<br />
				03004157815';
				$_SESSION['trial'] = true;
			}
			if($result[0]['user_of'] != '0'){
				//getBusinessId() = $result[0]['user_of']; 
				setBusinessId($result[0]['user_of']);
				unsetSuperAdmin($result[0]['uid']);
				setWorkerId($result[0]['uid']);
			}else{
				//getBusinessId() = $result[0]['uid']; 
				setBusinessId($result[0]['uid']);
				setWorkerId($result[0]['uid']);
				setSuperAdmin($result[0]['uid']);
			}
			if($result[0]['membership'] == '0'){
				$_SESSION['ses_table_prefix'] = '0';
			}else{
				$_SESSION['ses_table_prefix'] = getBusinessId();
			}
			$_SESSION['username'] = $result[0]['username']; 
			$_SESSION['ses_production'] = $result[0]['production']; 
			$_SESSION['ses_p_and_l'] = $result[0]['p_and_l']; 
			$_SESSION['lang'] = $result[0]['lang']; 
			
			$_SESSION['product_label1'] = $result[0]['product_label1']; 
			$_SESSION['product_label2'] = $result[0]['product_label2'];
			$_SESSION['product_label3'] = $result[0]['product_label3'];
			$_SESSION['customer_label1'] = $result[0]['customer_label1'];
			$_SESSION['customer_label2'] = $result[0]['customer_label2'];
			$_SESSION['customer_label3'] = $result[0]['customer_label3'];
			$_SESSION['flag_outstanding_balance'] = $result[0]['flag_outstanding_balance'];
			redirect(getPageUrl("dashboard"));
			exit;
		}else{
			redirect($webUrl."index.php?error=yes");
			exit;
		}
	}
?>
<form id="form1" name="form1" method="post" action="">
<input type="hidden" name="login_form_submitted" id="login_form_submitted" value="yes" />
	<table align="center" style="font-family:'Courier New', Courier, monospace; color:#000066">
		<tr>
			<td style="color:#FF0000; font-weight:bold;" align="center" colspan="2">
				<?php
				if(isset($_GET) && isset($_GET['error']) && $_GET['error']=='yes')
				{
					echo "Wrong user and/or password.";
				}
				?>
			</td>
		</tr>
		<tr>
			<td>Username</td>
			<td><input name="username" type="text" width="15" /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input name="password" type="password" width="15" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input name="" type="submit" value="Login!" style="font-family:Verdana, Arial, Helvetica, sans-serif;" />
				<a href="?page=register">New User?</a>
			</td>
		</tr>
	</table>
</form>