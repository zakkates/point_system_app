<?php

    include('connection.php');

    #Grabbing Current User Data
        try { 
            $result = $db->prepare("SELECT * FROM `parents` WHERE `parent_id`= ?");
            $result->bindParam(1,$_SESSION['id']);
            $result->execute(); 
        } catch (Exception $e) {
                echo "database login query failed";
                exit;
        }    
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $emailAddress = $row['parent_email_address'];

    #if sumbitting to change password
    if ($_POST['submit'] == 'Change Password') {

    #Testing Current Pass
        try { 
            $result = $db->prepare("SELECT * FROM `parents` WHERE `parent_id`= ? AND `parent_password`='".md5(md5($emailAddress).$_POST['currentpass'])."'");
            $result->bindParam(1,$_SESSION['id']);
            $result->execute(); 
        } catch (Exception $e) {
                echo "database login query failed";
                exit;
        }    
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if ($row) {
             if ($_POST['newpass'] == $_POST['verifypass']) {
                if (strlen($_POST['newpass'])<8) { $error.="<br />Please enter a password with at least 8 characters long.<br />"; }
                if (!preg_match('`[A-Z]`', $_POST['newpass'])) { $error.="<br />Please include at least 1 capital letter in your passcode.<br/>"; }
             } else {
                 $error .= "Your two new passwords aren't the same.<br />";
             }
        } else {
            $error .= "You've incorrectly typed in your Current Password<br />";
        }
    #Adding new password to database
        if (!$error) {
            try {
                $result = $db->prepare("UPDATE `parents` SET `parent_password`='".md5(md5($emailAddress).$_POST['newpass'])."' WHERE `parent_id`= ?");
                $result->bindParam(1,$_SESSION['id']);
                $result->execute();
                $success = "You've successfully updated your passcode.";
                header("Location:../profile.php");
            } catch (Exception $e) {
                echo "Updating your password failed.";
                
            }
        }
   
    }

?>