<?php
if(!empty($_POST['registration_code'])){
    $registration_code = $rodb->mysql_real_escape_string($_POST['registration_code']);
    $q = "select uid from user where registration_code='".$registration_code."' and registration_code!=''";
    $uid = $rodb->getCellFromDB($q);
    if(isset($uid) && $uid > 0){
        $one_month_later = time()+(60*60*24*30);
        $licence = base64_encode(base64_encode(base64_encode(@date('Y-m-d', $one_month_later))));
        $update_q = "update user set active=1, licence='".$licence."', registration_code = '' where registration_code='".$registration_code."' and uid = '".$uid."'";
        $rodb->execute($update_q);
        ?>
            You have successfully activated your account.
            <meta http-equiv="refresh" content="0; <?php echo getPageUrl('login')?>" />
        <?php
    }else{
        $err = "Invalid Code";
    }
}
?>
<form action="" name="mp_form" method="post">
  <table width="100%" align="center" border="1" style="border-collapse:collapse">
  <?php if(isset($err)){?>
    <tr bgcolor="#EDE7EB">
      <td align="center" colspan="3"> <h1 style="color:#ff0000"><?php echo $err?></h1> </td>
    </tr>
  <?php }?>
    <tr bgcolor="#EDE7EB">
      <td align="center" colspan="3"> <h1 style="color:#003366">Please enter the registration code</h1> </td>
    </tr>
	<tr bgcolor="#F9F7F7">
		<td align="center">
            <input type="text" name="registration_code" value="" /></td>
		<td align="left">
            <input type="submit" name="" value="Confirm" />
		</td>
	</tr>
  </table>
</form>