<?php
    global $connection;
    require "../lib/functions.php";
    require_once "../src/DBconnect.php";
    require_once "../templates/header.php";

    // redirect the user to the login page if they access it directly via the address bar.
    if ($_SESSION["active"] !== true) {
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];

    if (isset($_POST['submit'])) {

        $name_error = $address_error = $phone_error = "";
        $name = escape($_POST['name']);
        $address = escape($_POST['address']);
        $phone = escape($_POST['phone']);

        if (empty($name)) {
            $name_error= "Name is required.";
        } elseif (empty($address)) {
            $address_error= "Address is required.";
        } elseif (empty($phone)) {
            $phone_error= "Phone number is required.";
        } elseif (!validate_name($name)) {
            $name_error= "Name can only contain letters and spaces.";
        } elseif (!validate_address($address)) {
            $address_error= "Address can only contain letters, numbers, hyphens, periods and spaces.";
        } elseif (!validate_phone($phone)) {
            $phone_error= "Phone number can only contain numbers.";
        } else {
            try {

                // subtract stocks for each item
                foreach ($_SESSION['cart'] as $id => $quantity) {

                    $earring = [
                        "id" => $id,
                        "stock" => $quantity
                    ];

                    $sql = "UPDATE products
                        SET stock = stock - :quantity
                        WHERE id = :id";
                    $statement = $connection->prepare($sql);
                    $statement->bindValue(":quantity", $quantity, PDO::PARAM_INT);
                    $statement->bindValue(":id", $id, PDO::PARAM_INT);
                    $statement->execute();
                }

                // assign display message
                $success_message = "<p class='alert alert-success mb-3'>Thank you for your order!</p>";

                // unset cart session
                unset($_SESSION['cart']);

            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }
    }
?>

    <title>Starry Earrings | Checkout</title>
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
                    <a class="nav-link active" href="cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php?id=<?php echo $user_id; ?>">Profile</a>
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
            <h1 class="mb-5">Checkout</h1>
            <?php
            if (empty($_SESSION['cart'])) {
                // after successfully submitting the form
                echo $success_message;
            } else {
                // when the page loads initially
                echo "<p class='alert alert-secondary mb-3'>Total: €{$_SESSION['total']}</p>";
            }
            ?>

            <form action="" method="post">
                <h2>Delivery Address</h2>
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" minlength="3" maxlength="30" placeholder="Name" required>
                    <p class="text-danger"><?php echo $name_error; ?></p>
                </div>
                <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" minlength="3" maxlength="255" placeholder="Address" required>
                    <p class="text-danger"><?php echo $address_error; ?></p>
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Phone Number</label>
                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone Number" pattern="[0-9]{10}" required>
                    <small>Format: 0861234567</small>
                    <p class="text-danger"><?php echo $phone_error; ?></p>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-lg mb-4">Place your Order</button>
            </form>
        </section>
    </main>

<?php require_once "../templates/footer.php"; ?>