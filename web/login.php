<?php
session_start();
require __DIR__.'/../library/Account.php';
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    header("Location: index.php");
    exit;
}

if (filter_has_var(INPUT_POST, 'username')) {
    $_SESSION['username'] = filter_input(INPUT_POST, 'username');
    $_SESSION['loggedIn'] = true;
    $_SESSION['account'] = new MyApp\Account;
    header("Location: index.php");
    exit;
}

?>
<html>
    <head>
        <link href="css/bootstrap.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <section>
                <form method="post" action="">
                    <label for="username">My name</label>
                    <input type="text" name="username" id="username" />
                    <button class="btn btn-primary">Login</button>
                </form>
            </section>
        </div>
    </body>
</html>