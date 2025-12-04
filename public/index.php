<?php
    require "../lib/functions.php";
    require_once "../templates/header.php";
?>

    <title>Starry Earrings | Home</title>
</head>

<body class="d-flex flex-column">

    <header>
        <nav class="navbar navbar-expand-sm navbar-light bg-light justify-content-between m-0 px-5 py-2">
            <a class="navbar-brand" href="index.php">Starry Earrings</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Earrings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Add Item</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="card text-center">
            <img class="card-img" src="../images/hero.jpg" alt="Close-up details of lace, beads, pearls, and threads.">
            <div class="card-img-overlay d-flex flex-column justify-content-center gap-3">
                <h1 class="card-title">Timeless Earrings for Every Occasion</h1>
                <h2 class="card-text">Discover from <?php echo count_earrings() ?> pairs of earrings</h2>
                <div>
                    <a class="btn btn-dark btn-lg" href="#">Explore Now</a>
                </div>
            </div>
        </section>

        <section class="bg-light">
            <div class="row px-5 py-1">
                <div class="col-sm-3">
                    <div class="card">
                        <img class="card-img" src="../images/stud1.jpg" alt="Gold star stud earrings">
                        <div class="card-img-overlay">
                            <a href="#" class="btn btn-dark">Shop Stud Earrings</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <img class="card-img" src="../images/drop1.jpg" alt="Gold drop earrings with purple glass beads">
                        <div class="card-img-overlay">
                            <a href="#" class="btn btn-dark">Shop Drop Earrings</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <img class="card-img" src="../images/hoop1.jpg" alt="Twisted gold hoop earrings">
                        <div class="card-img-overlay">
                            <a href="#" class="btn btn-dark">Shop Hoop Earrings</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <img class="card-img" src="../images/clip1.jpg" alt="Multi-gemstone chandelier earrings">
                        <div class="card-img-overlay">
                            <a href="#" class="btn btn-dark">Shop Clip Earrings</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php require_once "../templates/footer.php"; ?>