<?php

// query the database to fetch earrings by category.
// if no category is given, retrieve all earrings.
function get_earrings($category) {
    global $connection;
    require_once "../src/DBconnect.php";

    $query = "SELECT * FROM products WHERE stock > 0";
    if ($category == "stud" || $category == "drop" || $category == "hoop" || $category == "clip") {
        $query .= " AND category = '$category'";
    }
    $statement = $connection->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}

// count the total number of earrings in stock
function count_earrings() {
    return count(get_earrings(null));
}

// retrieve single earring data by id.
function get_earring($id) {
    global $connection;
    require_once "../src/DBconnect.php";

    $query = "SELECT * FROM products WHERE id = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam(":id", $id, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

// subtract the stock of an item in the database
function subtract_stock($id, $quantity) {
    global $connection;
    require_once "../src/DBconnect.php";

    $query = "UPDATE products 
              SET stock = stock - :quantity 
              WHERE id = :id";
    $statement = $connection->prepare($query);
    $statement->bindValue(":quantity", $quantity, PDO::PARAM_INT);
    $statement->bindValue(":id", $id, PDO::PARAM_INT);
    $statement->execute();

    return $statement;
}

// create a new user record in the database.
function save_user($data) {
    global $connection;
    require_once "../src/DBconnect.php";

    $query = sprintf( "INSERT INTO %s (%s) VALUES (%s)", "users",
        implode(", ", array_keys($data)), ":" . implode(", :", array_keys($data)));
    $statement = $connection->prepare($query);
    $statement->execute($data);

    return $statement;
}

// retrieve single user data by id.
function get_user($id) {
    global $connection;
    require_once "../src/DBconnect.php";

    $query = "SELECT * FROM users WHERE id = :id";
    $statement = $connection->prepare($query);
    $statement->bindValue(":id", $id, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

// retrieve single user data by email.
function get_user_by_email($email) {
    global $connection;
    require_once "../src/DBconnect.php";

    $query = "SELECT id, email, password FROM users WHERE email = :email";
    $statement = $connection->prepare($query);
    $statement->bindValue(":email", $email, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

// update single user data in the database.
function update_user($data) {
    global $connection;
    require_once "../src/DBconnect.php";

    $query = "UPDATE users
              SET email = :email,
                  password = :password,
                  name = :name,
                  address = :address,
                  phone = :phone
              WHERE id = :id";

    $statement = $connection->prepare($query);
    $statement->bindValue(":id", $data["id"], PDO::PARAM_INT);
    $statement->bindValue(":email", $data["email"], PDO::PARAM_STR);
    $statement->bindValue(":password", $data["password"], PDO::PARAM_STR);
    $statement->bindValue(":name", $data["name"], PDO::PARAM_STR);
    $statement->bindValue(":address", $data["address"], PDO::PARAM_STR);
    $statement->bindValue(":phone", $data["phone"], PDO::PARAM_STR);
    $statement->execute();

    return $statement;
}

// delete a user record from the database
function delete_user($id) {
    global $connection;
    require_once "../src/DBconnect.php";

    $query = "DELETE FROM users WHERE id = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam(":id", $id);
    $statement->execute();

    return $statement;
}

// sanitise user input
function escape($data) {
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    $data = trim($data);
    $data = stripslashes($data);

    return ($data);
}

function validate_email($email, $id=0) {

    // check if the email is already exists in the database.
    global $connection;
    require_once "../src/DBconnect.php";

    $query = "SELECT * FROM users WHERE NOT id = :id AND email = :email";
    $statement = $connection->prepare($query);
    $statement->bindValue(":id", $id, PDO::PARAM_INT);
    $statement->bindValue(":email", $email, PDO::PARAM_STR);
    $statement->execute();

    if ($statement->fetch(PDO::FETCH_ASSOC)) {
        return false;
    }

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

function validate_name($name) {
    if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        return false;
    }
    return true;
}

function validate_address($address) {
    if (!preg_match("/^[a-zA-Z0-9-,. ]+$/", $address)) {
        return false;
    }
    return true;
}

function validate_phone($phone) {
    if (!preg_match("/^[0-9]{10}/", $phone)) {
        return false;
    }
    return true;
}