<?php
    require_once "../lib/functions.php";
    require_once "../templates/header.php";

    // redirect the user to the login page if they access it directly via the address bar.
    if ($_SESSION["active"] !== true) {
        header("Location: login.php");
        exit;
    }

    $quantity_error = "";
    $user_id = $_SESSION['user_id'];

    if (isset($_POST['update'])) {
        foreach ($_POST['quantity'] as $id => $new_quantity) {
            $earring = get_earring($id);
            if ($new_quantity > $earring['stock']) {
                $quantity_error = "Quantity cannot exceed the available stock.";
            } elseif($new_quantity < 0) {
                $quantity_error = "Quantity cannot be negative.";
            } elseif ($new_quantity == 0) {
                unset($_SESSION['cart'][$id]);
            } else {
                $_SESSION['cart'][$id] = $new_quantity;
            }
        }
    }
?>

    <title>Starry Earrings | Cart</title>
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
            <h1 class="mb-5">Cart</h1>
                <?php
                    $total = 5;

                    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                        echo "Your cart is empty.";
                    } else {
                        echo "
                            <form action='' method='post'>
                            <table class='table'>
                                <thead>
                                    <th scope='col' class='col-3'>Item</th>
                                    <th scope='col' class='col-3 text-end'>Price</th>
                                    <th scope='col' class='col-3 text-end'>Quantity</th>
                                    <th scope='col' class='col-3 text-end'>Subtotal</th>
                                </thead>
                                <tbody>
                        ";
                        foreach ($_SESSION['cart'] as $id => $quantity) {
                            $earring = get_earring($id);
                            $price = $earring['price'];
                            $stock = $earring['stock'];
                            $subtotal = $price * $quantity;
                            $total += $subtotal;
                            $subtotal = number_format($subtotal, 2, '.', '');
                            $total = number_format($total, 2, '.', '');
                            $_SESSION['total'] = $total;
                            echo "
                                <tr>
                                    <td>
                                        <div class='row'>
                                            <img src='{$earring['image']}' class='col-4'>
                                            <p class='col-8'>{$earring['name']}</p>
                                        </div>
                                    </td>
                                    <td class='text-end'>€$price</td>
                                    <td class='text-end'>
                                        <input type='number' name='quantity[$id]' value='$quantity' min='0' max='$stock'>
                                        <button type='submit' name='update' class='btn btn-outline-primary'>Update</button>
                                        <p>($stock in stock)</p>
                                        <p class='text-danger'>$quantity_error</p>
                                    </td>
                                    <td class='text-end'>€$subtotal</td>
                                </tr>
                            ";
                        }
                        echo "
                                </tbody>
                            </table>
                        </form>
                        <p class='text-end'>Delivery: €5.00</p>
                        <h2 class='text-end'>Total: €$total</h2>
                        <div class='text-end mt-3'>
                            <a href='checkout.php' class='btn btn-primary btn-lg'>Proceed to Checkout</a>
                        </div>
                        ";
                    }
                ?>
        </section>
    </main>

<?php require_once "../templates/footer.php"; ?>