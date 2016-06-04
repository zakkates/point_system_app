<?php 

    session_start();

    include('connection.php');

    if ($_POST['submit'] == 'Create New Child') {
        #create new child
        try {
            $result = $db->prepare("INSERT INTO children (child_first_name, child_last_name, child_gender,child_birthday) VALUES (?, ?, ?, ?) ");
            $result->bindParam(1,$_POST['child_first_name']);
            $result->bindParam(2,$_POST['child_last_name']);
            $result->bindParam(3,$_POST['child_gender']);
            $result->bindParam(4,$_POST['child_birthday']);
            $result->execute();
            $child_id = $db->lastInsertId(); ;    
        }   catch (Exception $e) {
            echo "Adding child to database failed.";
            exit;
        } 
        #add parent / child relationship
        try {
            $result = $db->prepare("INSERT INTO parent_child_relationship (parent_id, child_id) VALUES (?, ?) ");
            $result->bindParam(1,$_SESSION['id']);
            $result->bindParam(2,$child_id);
            $result->execute();
            header("Location:points.php");
        }   catch (Exception $e) {
            echo "Adding child to database failed.";
            exit;
        } 
    }

    include('header.php');
?>

<h1>New Child</h1>
<form method="post">
    <label for="child_first_name">First Name:</label>
    <input type="text" name="child_first_name" id="child_first_name" value="<?php echo $row['child_first_name']; ?>" />
    <br />
    <label for="child_last_name">Last Name:</label>
    <input type="text" name="child_last_name" id="child_last_name" value="<?php echo $row['child_last_name']; ?>" />
    <br />
    <label for="child_gender">Child Gender:</label>
    <select id="child_gender" name="child_gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>
    <br />
    <label for="child_birthday">Birthday:</label>
    <input type="text" name="child_birthday" id="child_birthday" value="<?php echo $row['child_birthday']; ?>" />
    <br />
    <input type="submit" name="submit" value="Create New Child" />
</form>


<?php include('footer.php'); ?>