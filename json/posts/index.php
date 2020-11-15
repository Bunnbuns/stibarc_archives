<?php

include('../../common.inc.php');
include('../../db.inc.php');

try {
    $connection = new PDO($sql_dsn, $sql_username, $sql_password, $sql_options);
    if($_GET['type'] == "all") {
        $sql = "SELECT * 
                FROM all_posts 
                ";
    } else {
        $sql = "SELECT * 
                FROM posts 
                ";
    }
    
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $error) {
    $result = array("error" => $error->getMessage());
}

header('Content-Type: application/json');

if ($_GET['pp']) {
    echo json_encode($result, JSON_PRETTY_PRINT);
} else {
    echo json_encode($result);
}
?>