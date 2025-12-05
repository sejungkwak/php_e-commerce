<?php
    global $connection;
    require_once "../lib/functions.php";
    require_once "../src/DBconnect.php";
    require_once "../templates/header.php";

    // redirect the user to the login page if they access it directly via the address bar.
    if ($_SESSION["active"] !== true) {
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $success_message = "";

    if (isset($_POST['submit'])) {
        $email_error = $password_error = $name_error = $address_error = $phone_error = "";
        $email = escape($_POST["email"]);
        $password = escape($_POST["password"]);
        $name = escape($_POST["name"]);
        $address = escape($_POST["address"]);
        $phone = escape($_POST["phone"]);

        if (empty($email)) {
            $email_error = "Email is required";
        } elseif (empty($password)) {
            $password_error = "Password is required";
        } elseif (!validate_email($email)) {
            $email_error = "Invalid email.";
        } elseif (!validate_password($password)) {
            $password_error = "Password must be 8-20 characters long.";
        } elseif ($name && !validate_name($name)) {
            $name_error = "Name can only contain letters and spaces.";
        } elseif ($address && !validate_address($address)) {
            $address_error = "Address can only contain letters, numbers, hyphens, periods and spaces.";
        } elseif ($phone && !validate_phone($phone)) {
            $phone_error = "Phone number can only contain numbers.";
        } else {
            try {
                $updated_user = [
                    "id" => $user_id,
                    "email" => $email,
                    "password" => $password,
                    "name" => $name,
                    "address" => $address,
                    "phone" => $phone
                ];

                $sql = "UPDATE users 
                        SET email = :email, 
                            password = :password, 
                            name = :name, 
                            address = :address, 
                            phone = :phone 
                        WHERE id = :id";

                $statement = $connection->prepare($sql);
                $statement->execute($updated_user);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        if (isset($_POST['submit']) && $statement) {
            $success_message = "
                <div class='card border-success mb-3'>
                    <h2 class='card-header'>Success</h2>
                    <div class='card-body'>
                        <p class='card-text'>Your profile updated successfully.</p>
                    </div>
                </div>";
        }
    }

    if (isset($_GET['id'])) {
        try {
            $user = get_user($user_id);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        echo "Something went wrong";
        exit;
    }

?>

    <title>Starry Earrings | Profile</title>
</head>

<body class="d-flex flex-column vh-100">

    <header>
        <nav class="navbar navbar-expand-sm navbar-light bg-light justify-content-between m-0 px-5 py-2">
            <a class="navbar-brand" href="index.php">Starry Earrings</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="earrings.php">Earrings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="profile.php?id=<?php echo $user_id; ?>">Profile</a>
                </li>
                <li class="nav-item">
                    <form action='logout.php' method='post'>
                        <button type='submit' class="nav-link">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="p-5">
            <h1 class="mb-5">Profile</h1>

            <?php echo $success_message ?>

            <form action="" method="post">
                <?php
                foreach ($user as $key => $value) {

                    $ucfirst_key = ucfirst($key);

                    if ($key == "phone") {
                        $input_type = "tel";
                    } elseif ($key == "name" || $key == "address") {
                        $input_type = "text";
                    } else {
                        $input_type = $key;
                    }

                    if ($key == "email" || $key == "password") {
                        $required = "required";
                    } else {
                        $required = "";
                    }

                    if ($key !== "id" && $key !== "created_at") {?>
                    <div class='form-group mb-3'>
                        <?php echo "
                        <label for='$key'>$ucfirst_key</label>
                        <input type='$input_type' name='$key' id='$key' class='form-control' value='$value' placeholder='$ucfirst_key' $required>
                        <p class='text-danger'>" . ${$key . "_error"} . "</p>";
                        ?>
                    </div>
                    <?php }
                } ?>
                <button type="submit" name="submit" class="btn btn-dark mb-4">Update</button>
            </form>
        </section>
    </main>

<?php require_once "../templates/footer.php"; ?>