<?php
    require_once 'core/init.php';

    if (Session::exists('home')) {
        echo '<p>' . Session::flash('home') . '</p>';
    }

    $user = new User();
    if ($user->isLoggedIn()) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Home</title>

            <!-- Google Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Comfortaa:700" rel="stylesheet">

            <!-- style -->
            <link href="style/common.css" rel="stylesheet">
            <link href="style/home.css" rel="stylesheet">

        </head>
        <body>

        <header class="ax-header">
            <div class="ax-header-left">
                <a href="index.php" class="ax-header__title">AuctioX</a>
                <form class="ax-header-form">
                    <input type="text" placeholder="search" class="ax-header-form-input">
                    <button type="submit" class="ax-header-form-search-button">Search</button>
                </form>
            </div>
            <div class="ax-header-right">
                <div class="ax-header-button-group">
                    <button type="button"
                            class="ax-header-action-button ax-header-action-button--left ax-header-action-button__relative">
                        Export
                    </button>
                    <div class="ax-header-action-drop-down-container">
                        <a href="generateJSON.php" class="ax-header-action-drop-down-container--selector">
                            JSON file
                        </a>
                        <a href="" class="ax-header-action-drop-down-container--selector">
                            PDF file
                        </a>
                        <a href="" class="ax-header-action-drop-down-container--selector">
                            CSV file
                        </a>
                    </div>
                    <button type="button" class="ax-header-action-button ax-header-action-button--right">My auctions
                    </button>
                </div>
                <a href="logout.php" class="ax-header-action-button">logout</a>
            </div>
        </header>

        <main class="ax-container">

        </main>

        <footer class="ax-footer">
            <p class="ax-footer__time" id="ax-footer__time"></p>
        </footer>
        <script src="javascript/time.js"></script>
        </body>
        </html>

        <?php
    } else {
        header('Location: login.php ');
    }
?>