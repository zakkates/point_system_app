<?php 

    session_start();
    include('header.php');


    try {
        $result = $db->prepare("SELECT child_id, child_first_name, child_last_name, child_birthday FROM children  ORDER BY child_id DESC");
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