<?php

    session_start();
        
        try {
            $result = $db->prepare("SELECT * FROM parents WHERE parent_id=?");
            $result->bindParam(1,$_SESSION['id']);
            $result->execute();
            $user_data = $result->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Your database update query didn't work";
        }


?>