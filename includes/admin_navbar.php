<div class="header sticky-top">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <img src="img/logo.png" alt="">
        <div class="collapse navbar-collapse justify-content-end" id="my-navbar">
            <ul class="navbar-nav">
                <div class='nav-name'>
                    <h6 style="padding-top: 13px; padding-right: 30px; font-weight: bold;"> Hi,
                        <?php echo $_SESSION["full_name"] ?>
                    </h6>
                </div>
                <li class="nav-item">
                    <a class="nav-link" href=# data-bs-toggle="modal" data-bs-target="#addPropertyModal">
                        <i class="fas fa-solid fa-plus"></i>
                        Add property
                    </a>
                </li>
                <div class="nav-vl"></div>
                <li class="nav-item">
                    <a class="nav-link" href="admin_logout.php">
                        <i class="fas fa-sign-out-alt"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<div id="loading">


</div>