<?php 

    session_start();
    include('connection.php');

# Remove Child from your list
    if ($_GET['remove_child_id']) { 
        try {
            $result = $db->prepare("DELETE FROM `parent_child_relationship` 
            WHERE `child_id`= ? AND `parent_id`= ?
            LIMIT 1");
            $result->bindParam(1,$_GET['remove_child_id']);
            $result->bindParam(2,$_SESSION['id']);
            $result->execute();
            header("Location:points.php");
            exit;
        } catch (Exception $e) {
            echo "Could not remove child from database.";
            exit;
        }
    } # end if get remove_child_id

    include('header.php');

    $child_id = $_GET['child_id'];

    include('inc/delete-points.php');

# add points
    if ($_POST['submit'] == 'Submit Point(s)') {
        try {
            $user_id = $_SESSION['id'];
            $results = $db->prepare("INSERT INTO points (points_child_id, points, points_activity, points_parent_id) VALUES (?, ?, ?, ?)");
            $results->bindParam(1,$child_id );
            $results->bindParam(2,$_POST['points']);
            $results->bindParam(3,$_POST['points_activity']);
            $results->bindParam(4,$_SESSION['id']);
            $results->execute();
            header("Location:?child_id=" . $child_id);
        } catch (Exception $e) {
            echo "Could not add points to the database.";
            exit;
        }
    }


	include("nav.php");	


# query the points
    try {
        $user_id = $_SESSION['id'];
        $results = $db->prepare("SELECT * FROM points 
        INNER JOIN parents ON parents.parent_id = points.points_parent_id
        INNER JOIN children ON children.child_id = points.points_child_id
        WHERE points_child_id = ? 
        ORDER BY points_id DESC");
        $results->bindParam(1,$child_id );
        $results->execute();
        $results_points_array = $results->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Data could not be retrieved from the database.";
        exit;
    }

?>

<?php 
#If there's a child ID
if ($_GET['child_id']) { ?>
    <h1>Earn a Point!</h1>
    <form method="post" class="add-points">
        <label for="points">How Many Points:</label>
        <input type="number"  pattern="[0-9]*" name="points" id="points" value="" /><br />
        <label for="points_activity">Why?:</label>
        <input type="text" name="points_activity" id="points_activity" value="" /><br />
        <input type="submit" name="submit" value="Submit Point(s)" />
    </form>

    <?php 
    # display total points
    $total_points = 0;
    foreach ($results_points_array as $result) {
        $total_points = $total_points + $result['points'];
        $child_first_name = $result['child_first_name'];
        $child_id = $result['child_id'];
    }
    echo '<span class="total-points">';
    if ($child_first_name): echo $child_first_name.'\'s '; endif;
    echo 'Total Points: ' . $total_points . '</span>'; 
    #List out points
    if ($results_points_array):
            $output .= '<table class="points-table"><tr><th>Date</th><th>Parent</th><th>Activity</th><th>Points</th></tr>';
            foreach ($results_points_array as $row) {
                if ($row['points_date'] != null) { $date = date('M j', strtotime($row['points_date'])); } else {$date = "";}
                $output .= "<tr>";
                #strtodate manual: http://php.net/manual/en/function.date.php
                $output .= "<td>".$date." <a href='?child_id=".$child_id."&delete_points_id=" . $row['points_id'] . "'>x</a></td>";
                $output .= '<td><span class="parent-circle" title="'.$row['parent_first_name'].' '.$row['parent_last_name'].'">' . substr($row['parent_first_name'],0,1) . '</span></td>';
                $output .= "<td>" . $row['points_activity'] . "</td>";
                $output .= "<td>" . $row['points'] . "</td>";
                
                $output .= "</tr>";
            }
            $output .= "</table>";
            echo $output;
    endif;
        ?>
<a class="remove-child" href="points.php?remove_child_id=<?php echo $child_id; ?>">Click here to remove <?php echo $child_first_name; ?> from your children list.</a>
<?php } else {  

    $output .= '<ul class="points-children-list">';
    try {
        $result = $db->prepare("SELECT * 
        FROM children INNER JOIN parent_child_relationship 
        ON children.child_id = parent_child_relationship.child_id
        WHERE `parent_id`= ?
        ORDER BY children.child_first_name ASC");
        $result->bindParam(1,$_SESSION['id']);
        $result->execute();
    } catch (Exception $e) {
        echo "Querying Children Failed";
    }

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $output .= '<li class="'.$row['child_gender'].'"><a href="?child_id=' . $row['child_id'] . '">' . $row['child_first_name'] . ' - ID: ' . $row['child_id'] . '</a>';
    }
    $output .= '<li><a href="create-new-child.php">Add New Child</a></li>';
    $output .= '<li><a href="add-existing-child.php">Add Existing Child</a></li>';
    $output .= '</ul>';
    echo $output; 
    
    
    
 } 





?>





<?php include('footer.php'); ?>