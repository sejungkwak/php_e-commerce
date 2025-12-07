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

    if (isset($_POST['update'])) {
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
        } elseif (!validate_email($email, $user_id)) {
            $email_error = "Email is invalid or already in use.";
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
                update_user($updated_user);

                $success_message = "
                    <div class='card border-success mb-3'>
                        <h2 class='card-header'>Success</h2>
                        <div class='card-body'>
                            <p class='card-text'>Your profile updated successfully.</p>
                        </div>
                    </div>";
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    // delete account
    if (isset($_POST['delete'])) {

        try {
            $sql = "DELETE FROM users WHERE id = :id";

            $statement = $connection->prepare($sql);
            $statement->bindParam(":id", $user_id);
            $statement->execute();

            header("Location: logout.php");
            exit;
        } catch (PDOException $e) {
            echo $e->getMessage();
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
                <div class='form-group mb-3'>
                    <label for="email">Email address</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $user["email"]; ?>" placeholder="Email" required>
                    <p class='text-danger'><?php echo $email_error; ?></p>
                </div>
                <div class='form-group mb-3'>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="<?php echo $user["password"]; ?>" minlength="8" maxlength="20" placeholder="Password" required>
                    <p class='text-danger'><?php echo $password_error; ?></p>
                </div>
                <div class='form-group mb-3'>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo $user["name"]; ?>" minlength="3" maxlength="30" placeholder="Name">
                    <p class='text-danger'><?php echo $name_error; ?></p>
                </div>
                <div class='form-group mb-3'>
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="<?php echo $user["address"]; ?>" placeholder="Address">
                    <p class='text-danger'><?php echo $address_error; ?></p>
                </div>
                <div class='form-group mb-3'>
                    <label for="phone">Phone number</label>
                    <input type="tel" name="phone" id="phone" class="form-control" value="<?php echo $user["phone"]; ?>" pattern="[0-9]{10}" placeholder="Phone Number">
                    <small>Format: 0861234567</small>
                    <p class='text-danger'><?php echo $phone_error; ?></p>
                </div>
                <button type="submit" name="update" class="btn btn-dark mb-4 d-block">Update</button>
                <button type="submit" name="delete" class="btn btn-outline-danger">Delete account</button>
            </form>
        </section>
    </main>

<?php require_once "../templates/footer.php"; ?>