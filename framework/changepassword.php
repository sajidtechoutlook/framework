<? //include "header.php"; ?>

	<form id="form1" name="form1" method="post" action="<?php echo getPageUrl("change_password")?>">

		<table align="center" style="font-family:'Courier New', Courier, monospace; color:#000066" class="Tb3">

			<tr>

				<td colspan="2" align="center" style="color:#FF0000"><?=(isset($_REQUEST['msg']))?$_REQUEST['msg']:''?></td>

			</tr>

			<tr>

				<td colspan="2" class="headbld2" align="center">Change Password</td>

			</tr>

			<tr><td colspan="2" height="5"></td></tr>

			<tr>

				<td>Old Password</td>

				<td><input name="oldpassword" type="password" /></td>

			</tr>

			<tr>

				<td>New Password</td>

				<td><input name="newpassword" type="password" /></td>

			</tr>

			<tr>

				<td>Confirm New Password</td>

				<td><input name="confirmnewpassword" type="password" /></td>

			</tr>

			<tr>

				<td colspan="2" align="center">

					<input name="" type="submit" value="Change!" style="font-family:Verdana, Arial, Helvetica, sans-serif;" />

					<input name="Input" type="reset" value="Clear Form!" style="font-family:Verdana, Arial, Helvetica, sans-serif;" />

				</td>

			</tr>

		</table>

	</form>

<? //include "footer.php"; ?>