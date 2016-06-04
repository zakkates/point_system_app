<?php 

    session_start();
    include('header.php');

        
    try {
        $result = $db->prepare("SELECT parent_id, parent_first_name, parent_last_name, parent_email_address FROM parents  ORDER BY parent_id DESC");
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