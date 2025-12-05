<?php
    require "../lib/functions.php";
    require_once "../templates/header.php";

    $id = $_GET['id'];
    $earring = get_earring($id);
    $earring_name = $earring['name'];

    $user_id = $_SESSION['user_id'];
?>

    <title>Starry Earrings | <?php echo $earring_name ?></title>
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
                    <a class="nav-link active" href="earrings.php">Earrings</a>
                </li>

                <?php
                if ($_SESSION["active"] == true) {
                    if ($_SESSION["role"] == "admin") {
                        echo "
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"#\">Add Item</a>
                </li>
            ";
                    } else {
                        echo "
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"cart.php\">Cart</a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"profile.php?id=$user_id\">Profile</a>
                </li>
            ";
                    }

                    echo "
            <li class=\"nav-item\">
                <form action='logout.php' method='post'>
                    <button type='submit' class=\"nav-link\">Logout</button>
                </form>
            </li>
        ";

                } else {
                    echo "
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"register.php\">Register</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"login.php\">Login</a>
            </li>
        ";
                }
                ?>

            </ul>
        </nav>
    </header>
    <main>
        <section class="row p-5">
            <div class="col-12 col-md-6">
                <img src="<?php echo $earring['image'] ?>" class="w-100">
            </div>
            <div class="col-12 col-md-6">
                <h1><?php echo $earring_name ?></h1>
                <p><?php echo $earring['price'] ?></p>
                <p><?php echo $earring['description'] ?></p>

                <?php

                if ($_SESSION["active"] == true) {

                    if (isset($_POST['submit'])) {

                        if (!isset($_SESSION["cart"])) {
                            $_SESSION["cart"] = array();
                        }

                        if ($_SESSION["cart"][$earring['id']]) {
                            $_SESSION["cart"][$earring['id']]++;
                        } else {
                            $_SESSION["cart"][$earring['id']] = 1;
                        }
                    }

                    echo "
                        <form action='' method='post'>
                            <button type='submit' name='submit' class=\"btn btn-primary btn-lg btn-block\">Add to cart</button>
                        </form>
                    ";
                } else {
                    echo "
                        <a href='login.php' class='btn btn-primary btn-lg btn-block'>Log in to add to cart</a>
                    ";
                }

                ?>

            </div>
        </section>
    </main>

<?php require_once "../templates/footer.php"; ?>