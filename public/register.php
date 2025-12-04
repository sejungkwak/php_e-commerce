<?php
    global $connection;
    require_once "../templates/header.php";
?>

    <title>Starry Earrings | Register</title>
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
                    <a class="nav-link active" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="p-5">
            <h1 class="mb-5">Create Account</h1>
            <form action="" method="post">

<?php

if (isset($_POST['submit'])) {
    require "../lib/functions.php";
    require_once "../src/DBconnect.php";

    $email_error = $password_error = $password_confirm_error = "";
    $email = escape($_POST['email']);
    $password = escape($_POST['password']);
    $password_confirm = escape($_POST['password_confirm']);

    if (empty($email)) {
        $email_error = "Email is required";
    } elseif (empty($password)) {
        $password_error = "Password is required";
    } elseif (empty($password_confirm)) {
        $password_confirm_error = "Confirm password is required";
    } elseif (!validate_email($email)) {
        $email_error = "Invalid email";
    } elseif (!validate_password($password)) {
        $password_error = "Password must be 8-20 characters long.";
    } elseif ($password != $password_confirm) {
        $password_confirm_error = "Passwords do not match.";
    } else {
        try {
            $new_user = array(
                "email" => $email,
                "password" => $password
            );
            $sql = sprintf( "INSERT INTO %s (%s) VALUES (%s)", "users", implode(", ", array_keys($new_user)), ":" . implode(", :", array_keys($new_user)));
            $statement = $connection->prepare($sql);
            $statement->execute($new_user);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    if (isset($_POST['submit']) && $statement) {
        echo "
            <div class='card border-success mb-3'>
                <h2 class='card-header'>Success</h2>
                <div class='card-body'>
                    <p class='card-text'>" . $new_user['email'] . " has been registered successfully.</p>
                    <a href='login.php' class='btn btn-success'>Sign in to my account</a>
                </div>
            </div>";
    }
}

?>

                <div class="form-group mb-3">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    <p class="text-danger"><?php echo $email_error; ?></p>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" minlength="8" maxlength="20" placeholder="Password" required>
                    <small class="text-muted">Password must be 8-20 characters long.</small>
                    <p class="text-danger"><?php echo $password_error; ?></p>
                </div>
                <div class="form-group mb-3">
                    <label for="password_confirm">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirm" id="password_confirm" minlength="8" maxlength="20" placeholder="Confirm Password" required>
                    <p class="text-danger"><?php echo $password_confirm_error; ?></p>
                </div>
                <button type="submit" name="submit" class="btn btn-dark mb-4">Submit</button>
            </form>
            <p><a href="login.php">I have an account</a></p>
        </section>
    </main>
</body>

<?php require_once "../templates/footer.php"; ?>