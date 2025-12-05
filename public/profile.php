<?php
    global $connection;
    require_once "../lib/functions.php";
    require_once "../templates/header.php";

    $user_id = $_SESSION['user_id'];

    // redirect the user to the login page if they access it directly via the address bar.
    if ($_SESSION["active"] !== true) {
        header("Location: login.php");
        exit;
    }

    if (isset($_GET['id'])) {
        try {
            $user = get_user($user_id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
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
            <form action="" method="post">
                <?php
                foreach ($user as $key => $value) {
                    if ($key == "phone") {
                        $input_type = "tel";
                    } elseif ($key == "name" || $key == "address") {
                        $input_type = "text";
                    } else {
                        $input_type = $key;
                    }
                    if ($key !== "id" && $key !== "created_at") {?>
                    <div class='form-group mb-3'>
                        <label for="<?php echo $key; ?>"><?php echo ucfirst($key) ?></label>
                        <input type="<?php echo $input_type; ?>" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $value; ?>" class="form-control" placeholder="<?php echo ucfirst($value); ?>">
                    </div>
                    <?php }
                } ?>
                <button type="submit" name="submit" class="btn btn-dark mb-4">Update</button>
            </form>
        </section>
    </main>

<?php require_once "../templates/footer.php"; ?>