<?php 

    session_start();
    include('header.php');


    try {
        $result = $db->prepare("SELECT parent_child_relationship_id, parent_id, child_id 
        FROM parent_child_relationship  
        ORDER BY parent_child_relationship_id DESC");
        $result->execute();
    } catch (Exception $e) {
        echo "Data could not be retrieved from the database.";
        exit;
    }

    echo "<pre>";

        while ($results = $result->fetch(PDO::FETCH_ASSOC)) {
        var_dump($results);
        }
        echo "<br/>";

    echo "</pre>";


    include('footer.php'); ?>