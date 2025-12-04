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

// query the database to fetch earrings by category.
// if no category is given, retrieve all earrings.
function get_earrings($category) {
    global $connection;
    require_once "../src/DBconnect.php";

    $query = "SELECT * FROM products WHERE stock > 0";
    if ($category != null) {
        $query .= " AND category = '$category'";
    }
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}

// sanitise user input
function escape($data) {
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    $data = trim($data);
    $data = stripslashes($data);

    return ($data);
}

function validate_email($email) {
    if (!filter_var($email, FILTER_SANITIZE_EMAIL)) {
        return false;
    }
    return true;
}

function validate_password($password) {
    if (strlen($password) < 8 || strlen($password) > 20) {
        return false;
    }
    return true;
}