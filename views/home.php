<?php
session_start();
ob_start();
define("BASE", "../");
if (isset($_SESSION['session_admin'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include BASE . 'commons/head.php'; ?>
        <title>Home</title>
    </head>

    <body>
        <?php include BASE . 'commons/header.php'; ?>
        <div class="d-flex" id="wrapper">
            <?php include BASE . 'commons/sliderbar.php'; ?>
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <main>

                    </main>
                </div>
            </div>
        </div>
        <?php include BASE . 'commons/footer.php'; ?>
        <!-- <script src="<?= BASE ?>assets/js/function_stock.js?v=<?= time(); ?>" type="text/javascript"></script> -->
    </body>
    </body>

    </html>
<?php
} else {
    header('Location: ' . BASE . 'index.php');
}
?>