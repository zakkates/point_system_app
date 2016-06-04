<?php 
# Delete Points
    if ($_GET['delete_points_id']) {
        try {
            $user_id = $_SESSION['id'];
            $results = $db->prepare("DELETE FROM points WHERE points_id= ?");
            $results->bindParam(1,$_GET['delete_points_id']);
            $results->execute();
            header("Location:?child_id=" . $child_id);
        } catch (Exception $e) {
            echo "Could not add points to the database.";
            exit;
        }
    }


?>
 