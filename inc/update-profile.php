<?php

	if ($_POST['submit']=="Update") {
        
        try {
            $result = $db->prepare("UPDATE `parents` SET `parent_first_name`= ?, `parent_last_name`= ? WHERE `parent_id`= ?");
            $result->bindParam(1,$_POST['parent_first_name'],PDO::PARAM_STR,155);
            $result->bindParam(2,$_POST['parent_last_name'],PDO::PARAM_STR,155);
            $result->bindParam(3,$_POST['parent_id'],PDO::PARAM_INT);
            $result->execute();
        } catch (Exception $e) {
            echo "Your database update query didn't work";
        }

    }

?>