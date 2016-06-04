<?php 

    session_start();
    require_once("inc/update-password.php");
    include('header.php');
    
    

	 ?>

<h1>Reset Your Passcode</h1>
<?php if ($success) { ?>
<span style="text-align: center; padding: 5px;  border-radius: 5px; width: 90%; display: block; margin: 0 auto 10px; color: #6d8d5b; background: #e4f4df;  "><?php echo $success ; ?></span>
<?php } ?>
<?php if ($error) { ?>
<span style="text-align: center; padding: 5px; border-radius: 5px; width: 90%; display: block; margin: 0 auto 10px; color: #a13934; background: #f2e1e5; "><?php echo $error; ?></span>
<?php } ?>
<form method="post">
	<label for="currentpass">Current Password: </label>
	<input type="password" name="currentpass" id="currentpass" value="<?php echo addslashes($_POST['currentpass']); ?>"/><br /><br />
	<label for="newpass">New Password: </label>
	<input type="password" name="newpass" id="newpass" value="<?php echo addslashes($_POST['newpass']); ?>"/><br /><br />
	<label for="verifypass">Verify New Password: </label>
	<input type="password" name="verifypass" id="verifypass" value="<?php echo addslashes($_POST['verifypass']); ?>"/><br /><br />
	<input type="submit" name="submit" value="Change Password" />
</form>

<?php include('footer.php'); ?>