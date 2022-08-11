<?php

require_once('private/initialize.php');

$product_set = find_all_product();
$layout = get_style_by_view(1);

$count = 0;
if (user_is_logged_in()) {  // if user is logged in
    $cart = get_cart_by_email($_SESSION["user_email"]);
    // count item is shopping cart
    foreach ($cart as $key => $value) {
        $count++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Indoor plants, windsor, personal garden, zen garden, home decoration - plants">
    <meta name="description" content="Windosr local indoor plants">
    <meta name="author" content="SiChao Chen, Arthur Wei, Zaiqing Zhang, Zixun Wang">
    <link rel="stylesheet" href="css/style.css">
    <title>Shop</title>

    <!-- load style from database -->
    <style>
        body {
            background-color: <?php echo $layout["background_color"]; ?>;
        }

        .topnav {
            background-color: <?php echo $layout["margin_color"]; ?>;
        }

        .topnav a {
            color: <?php echo $layout["margin_text_color"]; ?>;
        }

        .container_footer {
            background-color: <?php echo $layout["margin_color"]; ?>;
            color: <?php echo $layout["margin_text_color"]; ?>;
        }

        .container_footer .footer_text {
            color: <?php echo $layout["margin_text_color"]; ?>;
        }

        .copyright {
            color: <?php echo $layout["margin_text_color"]; ?>;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="topnav" id="myTopnav">
            <a href="index.php"><img src="images/logo.png" alt="logo" class="logo"></a>
            <a href="index.php" class="htext htext2">Home</a>
            <a href="products.php" class="htext">Shop</a>
            <a href="account/account.php" class="htext">Account</a>
            <a href="account/cart.php" class="htext"><?php if ($count != 0) {
                                                            echo "Cart•";
                                                        } else {
                                                            echo "Cart";
                                                        } ?></a>
            <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="header_menu()">&#9776;</a>
            <a href="contact.php" class="htext">Contact</a>
            <a href="shipping-policy.php" class="htext_bottom">Shipping Policy</a>
            <a href="privacy-policy.php" class="htext_bottom">Privacy Policy</a>
            <a href="return-policy.php" class="htext_bottom">Return Policy</a>
        </div>
    </header>

    <div class="center_block80">
        <br>
        <h1 class="page_title">Products</h1>
        <hr>
        <br><br><br>

        <!-- Display all product -->
        <?php while ($product = mysqli_fetch_assoc($product_set)) { ?>
            <a style="color: #000000;" href="product.php<?php echo ('?id=' . h(u($product['product_id']))); ?>">
                <div class="product_gallery">
                    <div class="card">
                        <img style="width:100%;" src="admin/product/images/<?php echo h($product['product_img']); ?>" alt="Image of Product">
                        <h1 style="margin-bottom: 0;"><?php echo h($product['product_name']); ?></h1>
                        <p class="price">$<?php echo h($product['product_price']); ?></p>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>

    <div style="clear: both;"><br><br><br></div>

    <footer>
        <div class="container_footer">
            <br>
            <a href="index.php"><img src="images/logo.png" alt="logo" class="footer_logo"></a>
            <div class="center">
                <a href="contact.php" class="footer_text">Contact</a>
                <a href="shipping-policy.php" class="footer_text">Shipping Policy</a>
                <a href="privacy-policy.php" class="footer_text">Privacy Policy</a>
                <a href="return-policy.php" class="footer_text">Return Policy</a>
                <a href="terms-and-conditions.php" class="footer_text">Term and Conditions</a>
            </div>
            <p class="copyright">Copyright &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script> WEB | All Rights Reserved
            </p>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>


</html>

<?php db_disconnect($db); ?>