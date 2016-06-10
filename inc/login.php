<?php 

	include("connection.php");


	if ($_POST['submit']=="Sign Up") {
		if(!$_POST['email'])  { $error.="<br />Please enter your email"; }
			else if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) { $error.="<br />Please enter a valid email address."; }
		if (!$_POST['password']) $error.="<br />Please enter a password";
			else {
			if(strlen($_POST['password'])<8) $error.="<br />Please enter a password with at least 8 characters long.";
			if (!preg_match('`[A-Z]`', $_POST['password'])) $error.="<br />Please include at least 1 capital letter in your passcode"; 
			
			}
            
        
        
		if ($error) { $createusererror = "There were error(s) in your sign up details: ".$error; }
	 else { 
		$newEmail = strtolower($_POST['email']);
		$result = $db->prepare("SELECT COUNT(*) FROM `parents` WHERE `parent_email_address`= ?");
        $result->bindParam(1,$newEmail);
        $result->execute(); 
		if ($result->fetchColumn() > 0) { 
			$createusererror = "User already exists.";
		} else {
			$result = $db->prepare("INSERT INTO `parents` (`parent_email_address`,`parent_password`) 
            VALUES( ? ,'".md5(md5($newEmail).$_POST['password'])."')");
			$result->execute(array($newEmail)); 
			$_SESSION['id']=$db->lastInsertId();
            setcookie("id",$_SESSION['id'],time()+60*60*24*14);
			header("Location:profile.php");
		}
	} 
	
	}	
	
    $loginemail = strtolower($_POST['loginemail']);
	if ($_POST['submit']=="Log In") {
        try { 
    $result = $db->prepare("SELECT * FROM `parents` 
    WHERE `parent_email_address`= ? 
    AND `parent_password`='".md5(md5($loginemail).$_POST['loginpassword'])."'");
    $result->bindParam(1,$loginemail);
    $result->execute(); 
        } catch (Exception $e) {
            echo "database login query failed";
            exit;
    }
	if ($result) {

		if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$_SESSION['id']=$row['parent_id'];
            setcookie("id",$_SESSION['id'],time()+60*60*24*14);
			header("Location:points.php");
		} else {
			$loginerror = "Your email and password did not match any records in the database. Please try again.";
		}
	}	
	
	}
	
	
?>            
		