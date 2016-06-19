<?php 

    session_start();
	include("connection.php"); 
    include("inc/update-profile.php"); 

    include('header.php');

	try {
        $sessionID = $_SESSION['id']; 
        $results = $db->prepare("SELECT * FROM `parents` WHERE `parent_id`= ? LIMIT 1");
        $results->bindParam(1,$sessionID);
        $results->execute();
    } catch (Exception $e) {
        echo "There's a problem w/ your database query";
        exit;
    }
    $row = $results->fetch(PDO::FETCH_ASSOC);

?>


<form method="post">
    <label for="parent_id">Parent ID: </label><?php echo addslashes($row["parent_id"]); ?><br />
	<label for="parent_first_name">First Name: </label>
	<input type="text" name="parent_first_name" id="parent_first_name" value="<?php echo $row['parent_first_name']; ?>"/><br />
	<label for="parent_last_name">Last Name: </label>
	<input type="text" name="parent_last_name" id="parent_last_name" value="<?php echo $row['parent_last_name']; ?>"/><br />
	<label for="parent_email_address">Email: </label>
	<input type="email" name="parent_email_address" id="parent_email_address" value="<?php echo addslashes($row['parent_email_address']); ?>"/><br />
	<input type="submit" name="submit" value="Update" />
</form>
 
<a href="password.php">Change Password</a>


<?php include('footer.php'); ?>