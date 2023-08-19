<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="css/admin_login.css">
    <title>PG Life</title>
</head>

<body>

    <!-- navbar -->
    <div class="header sticky-top">
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <a class="navbar-brand" href="home.php">
                <img src="img/logo.png" alt="">
            </a>
        </nav>
    </div>

    <div id="loading">

    </div>

    <!-- contant -->
    <div class="page-container" method="post">
        <div>
            <img src="img/bg7.jpg" alt="">
        </div>
        <div>

            <form id="admin-login-form" class="form" role="form" method="post" action="api/admin_login_submit.php">
                <div class="modal-header">
                    <h2><u>Login Admin with PGLife</u></h2>
                </div>
                <div class="modal-body" style="padding: 10px 0px;">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-user"></i>
                        </span>
                        <input required type="text" name="email" class="form-control" placeholder="Enter yuor Email"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-lock"></i>
                        </span>
                        <input required type="password" name="password" class="form-control" placeholder="Password"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-info" style="width: 100%;">Login</button>
                    </div>
            </form>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="js/admin_login.js"></script>
</body>

</html>