<!doctype html>
<html>
    <head>
        <meta charset="utf8">
        <meta name="viewport" content="width=device-width">

        <title><?=$title?></title>

        <link href="https://bootswatch.com/4/cosmo/bootstrap.css" rel="stylesheet">
        <link href="/client/public/bundle.css" rel="stylesheet">
    </head>
    <body>
        <?php include('blocks/navbar.php'); ?>
        <div class="container">
            <?php include('blocks/header.php'); ?>
            <div id="cart">
                <?php echo Flight::handlebars('/blocks/cart.hbs', $cart); ?>
            </div>
        </div>
        <script>
            window.__DATA__ = JSON.parse('<?=json_encode($cart)?>');
        </script>
        <script src="/client/public/bundle.js"></script>
    </body>
</html>

