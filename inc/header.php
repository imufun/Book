<?php
//    $filepath = realpath(dirname(__FILE__));
//    include ($filepath . '/../lib/Session.php');
//    Session::init();
//    include ($filepath . '/../lib/Database.php');
//    include ($filepath . '/../helpers/Format.php');


//  $filepath = realpath(dirname(__FILE__));
include 'lib/Session.php';
Session::init();
include 'lib/Database.php';
include 'helpers/Format.php';

spl_autoload_register(function ($class) {
    include_once "classes/" . $class . ".php";
});

$db = new Database();
$fm = new Format();
$pd = new Product();
$ct = new Cart();
$ctgry = new  Category();
$customer = new Customer();

?>
<?php
header('Cache-Control: no-cache, must-revalidate');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

?>

<?php
//
//
//$ouput = '';
//if (isset($_POST['search'])) {
//    $search = $_POST['search'];
//    $search = preg_replace("#[^0-9a-z]#i", "", $search);
//    $query = mysqli_query('',"SELECT *FROM tbl_product WHERE productName LIKE '%$search%' OR body LIKE '%$search%'") or die("Not Found");
//    //$query = mysqli_query("SELECT *FROM tbl_product WHERE productName LIKE '%$search%' OR body LIKE '%$search%' or price '%$search%' OR image '%$search%'") or die("Not Found");
//    $count = mysqli_num_rows($query);
//    if ($count == 0) {
//        $ouput = 'There are no search result';
//    } else {
//        while ($row = mysqli_fetch_array($query)) {
//            $proName = $row['productName'];
//            $probody = $row['body'];
//           // $proPrice = $row['price'];
//           /// $proimg = $row['image'];
//          //  $proId = $row['productId'];
//
//            $ouput .= '<div>' . $proName . ' ' . $probody . ' </div>';
//            //$ouput .= '<div>' . $proName . ' ' . $probody . ' ' . $proPrice . ' ' . $proimg . ' ' . $proId . '</div>';
//
//        }
//    }
//}
//?>

<!DOCTYPE HTML>
<head>
    <title>Store Website</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- Latest compiled and minified CSS -->
    <link type="text/css" rel="stylesheet" href="css/magiczoomplus.css"/>
    <script src="js/jquerymain.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script type="text/javascript" src="js/nav.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript" src="js/nav-hover.js"></script>
    <script type="text/javascript" src="js/magiczoomplus.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
        $(document).ready(function ($) {
            $('#dc_mega-menu-orange').dcMegaMenu({rowItems: '4', speed: 'fast', effect: 'fade'});
        });

        $(document).ready(function () {
            $('#search_text').keyup(function () {
                var text = $(this).val();
                if (text != '') {
                    $.ajax({
                        url: "fetch.php",
                        method: "post",
                        data: {search: text},
                        dataType: "text",
                        success: function (data) {
                            $('#result').html(data);
                        }

                    });

                } else {
                    $('#result').html('');

                }

                // alert(text);
            });

            $('#min_price').change(function () {
                var price = $(this).val();
                $("#price_range").text("Product under Price Rs." + price);
                $.ajax({
                    url: "load_product.php",
                    method: "POST",
                    data: {price: price},
                    success: function (data) {
                        $("#product_loading").fadeIn(500).html(data);
                    }
                });
            });






        });
    </script>
</head>
<body>
<div class="wrap">
    <div class="header_top">
        <div class="logo">
            <a href="index.php"><img src="images/logo.png" alt=""/></a>
        </div>
        <div class="header_top_right">
            <div class="search_box">
                <form action="" method="POST">
                    <input type="text" name="search" id="search_text">
                    <input type="submit" value="SEARCH">
                </form>

                <?php //print ("$ouput"); ?>
            </div>
            <div class="shopping_cart">
                <div class="cart">
                    <a href="#" title="View my shopping cart" rel="nofollow">
                        <span class="cart_title"> Cart:</span>
                        <span class="no_product">
                            <?php
                            $getData = $ct->checkCartTable();
                            if ($getData) {
                                $sum = Session::get("sum");
                                $qty = Session::get("qty");
                                echo $sum . " BDT " . "|" . " Qty: " . $qty;
                            } else {
                                echo "(Empty)";
                            }

                            ?>
</span>
                    </a>
                </div>
            </div>

            <?php // logout
            if (isset($_GET["cid"])) {
                $delData = $ct->delCustomerCart();
                Session::destroy();
            }
            ?>
            <div class="login">

                <?php
                $login = Session::get("cuslogin");
                if ($login == false) { ?>
                    <a href="login.php">Login</a>
                <?php } else { ?>
                    <a href="?cid=<?php Session::get("cmrId") ?>">Logout</a>


                <?php } ?>


            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="menu">
        <ul id="dc_mega-menu-orange" class="dc_mm-orange">
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="topbrands.php">Top Brands</a></li>

            <?php
            $chekCart = $ct->checkCartTable();
            if ($chekCart) {
                ?>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="payment.php">Payment</a></li>
            <?php } ?>

            <?php
            $login = Session::get("cuslogin");
            if ($login == true) { ?>
                <li><a href="profile.php">Profile</a></li>
            <?php } ?>
            <li><a href="contact.php">Contact</a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div id="result"></div>
