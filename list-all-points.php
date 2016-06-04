<?php 

    session_start();
    include('header.php');

    include('inc/delete-points.php');


    try {
        $user_id = $_SESSION['id'];
        $results = $db->prepare("SELECT * FROM points 
        INNER JOIN parents ON parents.parent_id = points.points_parent_id
        ORDER BY points_id DESC");
        $results->bindParam(1,$child_id );
        $results->execute();
        $results_points_array = $results->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Data could not be retrieved from the database.";
        exit;
    }

    #List out points
    $output .= '<table class="points-table"><tr><th>Points</th><th>Activity</th><th>Parent</th><th>Delete</th></tr>';
    foreach ($results_points_array as $row) {
        $output .= "<tr>";
        $output .= "<td>" . $row['points'] . "</td>";
        $output .= "<td>" . $row['points_activity'] . "</td>";
        $output .= "<td>" . $row['parent_first_name'] . "</td>";
        $output .= "<td><a href='?child_id=".$child_id."&delete_points_id=" . $row['points_id'] . "'>x</a></td>";
        $output .= "</tr>";
    }
    $output .= "</table>";
    echo $output;


    include('footer.php'); ?>