<?php 
	if(!empty($_POST['register']))
	{
		$errors = '';
		if($_POST['email'] == ''){
			$errors[] = 'Email is required.';
		}elseif(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])){
			$errors[] = 'Please enter a valid email address.';
		}else{
			$q = "select email from user where email='".$rodb->mysql_real_escape_string($_POST['email'])."'";
			$exists = $rodb->getCellFromDB($q);
			if($exists != ''){
				$errors[] = 'This email already exists.';
			}
		}
		if($_POST['phone'] == ''){
			$errors[] = 'Phone is required.';
		}
		if($_POST['password'] == ''){
			$errors[] = 'Pssword is required.';
		}
		if($_POST['c_password'] == ''){
			$errors[] = 'Confirm Password is required.';
		}
		if($_POST['password'] != $_POST['c_password']){
			$errors[] = 'Password and Confirm Password should be same.';
		}
		if(empty($errors))
		{
			$key = genRandomString();
			$registration_code = rand(1111, 9999);
			$data = "(username, password, email, phone, active, membership, activation_key, registration_code) values 
			('".$rodb->mysql_real_escape_string($_POST['email'])."', '".$rodb->mysql_real_escape_string($_POST['password'])."', '".$rodb->mysql_real_escape_string($_POST['email'])."', '".$rodb->mysql_real_escape_string($_POST['phone'])."', '0', '0', '".$key."', '".$registration_code."')";
			$err = $rodb->writeToDB($data, "user");
			
			$subject = "Your registration at rabta-online.com is almost complete.";
			$message = "
				Your registration at mabta-online.com is almost complete.
				<br />Please click on the following link to complete your registration.
				<br />".base_url()."activate.php?key=".$key."
			";
			$headers = "from: YouAccounts <no-reply@youaccounts.com>";
			
			// @mail($_POST['email'], $subject, $message, $headers);
			$mobile_message = "YOUACCOUNTS Registration code: ".$registration_code;
			send_sms_direct($_POST['phone'], $mobile_message);
			$msg = urlencode('You have been registered successfully. Please check your email and activate your account.');
			?>
			<meta http-equiv="refresh" content="0;url=<?php echo getPageUrl('confirm_registration')?>" />
			<?php
			exit;
		}
	}
?>
<form action="" method="post" name="form1" id="form1">
	<table width="100%" align="center" cellpadding="1" cellspacing="1">
		<tr><td colspan="2"><h1>Register</h1></td></tr>
		<tr><td colspan="2" style="border:0px solid red; color:#FF0000"><?php if(!empty($errors))echo implode('<br />', $errors);?></td></tr>
		<tr><td height="5" colspan="2"></td></tr>
		<tr><td height="5" colspan="2"></td></tr>
		<tr>
			<td><strong>Email:</strong></td>
			<td><input type="email" name="email" id="email" value="<?php echo (isset($_POST['email']))?$_POST['email']:''?>" /></td>
		</tr>
		<tr>
			<td><strong>Phone:</strong></td>
			<td><input type="phone" name="phone" id="phone" value="<?php echo (isset($_POST['phone']))?$_POST['phone']:''?>" /></td>
		</tr>
		<tr><td height="5" colspan="2"></td></tr>
		<tr>
			<td><strong>Password:</strong></td>
			<td><input type="password" name="password" id="password" value="<?php echo $_POST['password']?>" /></td>
		</tr>
		<tr><td height="5" colspan="2"></td></tr>
		<tr>
			<td><strong>Confirm Password:</strong></td>
			<td><input type="password" name="c_password" id="c_password" value="<?php echo $_POST['c_password']?>" /></td>
		</tr>
		<tr><td height="5" colspan="2"></td></tr>
		<tr><td onclick="2" align="left">
			<input type="submit" id="register" name="register" value="Register" />
			<a href="?page=login">Existing User?</a>
		</td></tr>
	</table>
</form>