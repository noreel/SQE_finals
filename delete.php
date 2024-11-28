<?php
    if ( isset($_GET["incident_id"])) {
        $incident_id = $_GET["incident_id"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "ims_db";

        $connection =  new mysqli($servername, $username, $password, $database);
        $sql = "DELETE FROM incidents WHERE incident_id=$incident_id";
        $connection->query($sql); 

        // Calculate the next AUTO_INCREMENT value
        $result = $connection->query("SELECT IFNULL(MAX(incident_id), 0) + 1 AS next_id FROM incidents");
        $row = $result->fetch_assoc();
        $nextId = $row['next_id'];

        // Reset AUTO_INCREMENT to the next available ID
        $resetSql = "ALTER TABLE incidents AUTO_INCREMENT = $nextId";
        $connection->query($resetSql);
        
        header("location: user.php");
        exit;
    }
?>