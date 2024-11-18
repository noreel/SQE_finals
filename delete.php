<?php
    if ( isset($_GET["incident_id"])) {
        $incident_id = $_GET["incident_id"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "testdb";

        $connection =  new mysqli($servername, $username, $password, $database);
        $sql = "DELETE FROM incidents WHERE incident_id=$incident_id";
        $connection->query($sql); 

        header("location: /ims-main/queue.php");
        exit;
    }
?>