<?php
$page = basename($_SERVER['PHP_SELF'], ".php");


?>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="#">📝 Blog Website</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= ($page === "index") ? 'active fw-semibold' : '' ?>" href="../index.php">
                        Home
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">🏀 Sports</a></li>
                        <li><a class="dropdown-item" href="#">🏛️ Politics</a></li>
                        <li><a class="dropdown-item" href="#">💻 Technology</a></li>
                    </ul>
                </li>


            </ul>

            <div class="d-flex justify-content-center align-items-center gap-3">
                <form class="d-flex" role="search">
                    <input class="form-control me-2 rounded-3" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light rounded-3 px-3" type="submit">Search</button>
                </form>
                <a class=" btn btn-primary  <?= ($page === "login") ? 'active fw-semibold' : '' ?>" href="../login.php">
                    Login
                </a>
            </div>
        </div>
    </div>
</nav>