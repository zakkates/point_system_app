<?php 

    session_start();

    include('connection.php');

    if ($_POST['submit'] == 'Add Existing Child') {
        #test to see if the child ID exists
        try {
            $result = $db->prepare("SELECT child_id FROM children WHERE child_id= ?");
            $result->bindParam(1,$_POST['existing_child_id']);
            $result->execute();
        }   catch (Exception $e) {
            echo "Adding child to database failed.";
            exit;
        } 
        if ($result->fetch(PDO::FETCH_ASSOC)) {
        #add parent / child relationship
            try {
                $result = $db->prepare("INSERT INTO parent_child_relationship (parent_id, child_id) VALUES (?, ?) ");
                $result->bindParam(1,$_SESSION['id']);
                $result->bindParam(2,$_POST['existing_child_id']);
                $result->execute();
                header('Location:points.php');
            }   catch (Exception $e) {
                echo "Adding child to database failed.";
                exit;
            } 
        } else {
            $errormessage = "This Child ID doesn't exist. Please check your records and try again."; 
        }
    }

    include('header.php');
echo $error; 
?>

<h1>Add Existing Child</h1>
<?php if ($errormessage) { ?>
<span style="text-align: center; padding: 5px;  border-radius: 5px; width: 90%; display: block; margin: 0 auto 10px; color: #a13934; background: #f2e1e5;  "><?php echo $errormessage; ?></span>
<?php } ?>
<form method="post">
    <label for="existing_child_id">Existing Child ID:</label>
    <input type="text" name="existing_child_id" id="existing_child_id" value="" /><br />
    <input type="submit" name="submit" value="Add Existing Child" />
</form>


<?php include('footer.php'); ?>