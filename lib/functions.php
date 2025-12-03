<?php

// count the total number of earrings in stock
function count_earrings() {
    global $connection;
    require_once "../src/DBconnect.php";

    $query = "SELECT * FROM products WHERE stock > 0";
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    return count($result);
}