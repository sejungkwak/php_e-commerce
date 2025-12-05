<?php
    require_once "../templates/header.php";
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
                    <a class="nav-link" href="#">Profile</a>
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
            <p class="alert alert-secondary mb-3">Total: €<?php echo $_SESSION['total']; ?></p>
            <form action="" method="post">
                <h2>Delivery Address</h2>
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" minlength="3" maxlength="30" placeholder="Name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" minlength="3" maxlength="255" placeholder="Address" required>
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Phone Number</label>
                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone Number" pattern="[0-9]{10}" required>
                    <small>Format: 0861234567</small>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-lg mb-4">Place your Order</button>
            </form>
        </section>
    </main>

<?php require_once "../templates/footer.php"; ?>