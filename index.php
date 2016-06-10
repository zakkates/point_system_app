<?php 

    session_start(); 
    if ($_SESSION['id']) { header("Location:points.php"); }
    include('inc/logout.php');
	include("inc/login.php"); 
    include('header.php');


	 ?>

<?php if ($loggedout) { ?>
<span style="text-align: center; padding: 5px;  border-radius: 5px; width: 90%; display: block; margin: 0 auto 10px; color: #6d8d5b; background: #e4f4df;  ">
    <?php echo $loggedout; ?>
</span>
<?php } ?>

<h1>Point System - 1.0</h1>
<h2>Sign Up</h2>
<?php if ($createusererror) { ?>
<span style="text-align: center; padding: 5px;  border-radius: 5px; width: 90%; display: block; margin: 0 auto 10px; color: #a13934; background: #f2e1e5;  "><?php echo $createusererror; ?></span>
<?php } ?>
<form class="create-account" method="post">
	<label for="email">Email: </label>
	<input type="email" name="email" id="email" value="<?php echo addslashes($_POST['email']); ?>"/>
    <br/>
	<label for="password">Password: </label>
	<input type="password" name="password" id="password" value="<?php echo addslashes($_POST['password']); ?>"/>
    <br/>
	<input type="submit" name="submit" value="Sign Up" />
</form>

<h2>Login</h2>
<?php if ($loginerror) { ?>
<span style="text-align: center; padding: 5px; border-radius: 5px; width: 90%; display: block; margin: 0 auto 10px; color: #a13934; background: #f2e1e5; "><?php echo $loginerror; ?></span>
<?php } ?>
<form class="login" method="post">
	<label for="loginemail">Email: </label>
	<input type="email" name="loginemail" id="loginemail" value="<?php echo addslashes($_POST['loginemail']); ?>"/>
    <br/>
	<label for="loginpassword">Password: </label>
	<input type="password" name="loginpassword" id="loginpassword" value="<?php echo addslashes($_POST['loginpassword']); ?>"/>
    <br/>
	<input type="submit" name="submit" value="Log In" />
</form>


<?php include('footer.php'); ?>