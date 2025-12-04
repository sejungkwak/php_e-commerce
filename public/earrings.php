<?php
    require "../lib/functions.php";
    require_once "../templates/header.php";

    $category = null;
    if (isset($_GET['category'])) {
        $category = $_GET['category'];
    }

    $earrings = get_earrings($category);
?>

    <title>Starry Earrings | Products</title>
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
                <a class=\"nav-link\" href=\"#\">Cart</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"#\">Profile</a>
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
    <section class="p-5">
        <h1 class="mb-5">Earrings</h1>
        <div class="row">
            <?php foreach ($earrings as $earring) { ?>
            <div class="col-sm-4 col-md-3">
                <div class="card text-center mb-2">
                    <div class="card-body">
                        <a href="earring_details.php?id=<?php echo $earring['id']?>" class="text-decoration-none text-dark">
                            <img class="card-img-top" src="<?php echo $earring['image']; ?>">
                        </a>
                        <h2 class="card-title">
                            <a href="earring_details.php?id=<?php echo $earring['id']?>" class="text-decoration-none text-dark">
                                <?php echo $earring['name'] ?>
                            </a>
                        </h2>
                        <p class="card-text">
                            <a href="earring_details.php?id=<?php echo $earring['id']?>" class="text-decoration-none text-dark">
                                <?php echo "€" . $earring['price'] ?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
</main>

<?php require_once "../templates/footer.php"; ?>