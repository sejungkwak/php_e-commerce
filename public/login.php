<?php
    global $connection;
    require_once "../templates/header.php";

    $email_error = $password_error = $login_error = "";

    if (isset($_POST['submit'])) {
        try {
            require "../lib/functions.php";
            require_once "../src/DBconnect.php";

            $email = escape($_POST['email']);
            $password = escape($_POST['password']);

            $row = get_user_by_email($email);

            if (empty($email)) {
                $email_error = "Email is required.";
                var_dump(gettype($row)); die;
            } elseif (empty($password)) {
                $password_error = "Password is required.";
            } elseif ($email && $row && $password == $row['password']) {
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['active'] = true;
                header("Location: index.php");
                exit;
            } else {
                $login_error = "Invalid email or password.";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

?>

    <title>Starry Earrings | Login</title>
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
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="login.php">Login</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="p-5">
            <h1 class="mb-5">Log in</h1>
            <form action="" method="post">
                <?php
                if ($login_error && $login_error !== "") {
                    echo "<div class='alert alert-danger' role='alert'>$login_error</div>";
                }
                ?>
                <div class="form-group mb-3">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    <p class="text-danger"><?php echo $email_error; ?></p>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    <p class="text-danger"><?php echo $password_error; ?></p>
                </div>
                <button type="submit" name="submit" class="btn btn-dark mb-4">Submit</button>
            </form>
            <p><a href="register.php">I don't have an account</a></p>
        </section>
    </main>

<?php require_once "../templates/footer.php"; ?>