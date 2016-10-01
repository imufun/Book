<?php include 'inc/header.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    $updateCart = $ct->updateCartQuantity($cartId, $quantity);
}

if (isset($_GET['delpro'])) {
    $delid = $_GET['delpro'];
    $delProduct = $ct->delProductByCart($delid);
}

 if(!isset($_GET['id'])){
     //echo "<meta http-equiv='refresh' content='0'; URL='0;?id=Refresh' />";
 }


?>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Your Cart</h2>
                <?php

                if (isset($updateCart)) {
                    echo $updateCart;
                }

                if (isset($delProduct)) {
                    echo $delProduct;
                }

                ?>


                <table class="tblone">
                    <tr>
                        <th width="5%">SL</th>
                        <th width="15%">Product Name</th>
                        <th width="15%">Image</th>
                        <th width="10%">Price</th>
                        <th width="20%">Quantity</th>
                        <th width="20%">Total Price</th>
                        <th width="10%">Action</th>
                    </tr>

                    <?php
                    $getPro = $ct->getCartProduct();
                    if ($getPro) {
                        $i = 0;
                        $sum = 0;
                        $qty = 0;
                        while ($result = $getPro->fetch_assoc()) {

                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['productName']; ?></td>
                                <td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
                                <td><?php echo $result['price']; ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="cartId" value="<?php echo $result['catID']; ?>"/>
                                        <input type="number" name="quantity"
                                               value="<?php echo $result['quantity']; ?>"/>
                                        <input type="submit" name="submit" value="Update"/>
                                    </form>
                                </td>
                                <td>
                                    <?php
                                    $total = $result['price'] * $result['quantity'];
                                    echo $total;

                                    ?> </td>
                                <td><a onclick="return confirm('Are you sure to Delete?');"
                                       href="?delpro=<?php echo $result['catID']; ?>">X</a></td>

                            </tr>

                            <?php
                                $qty = $qty + $result['quantity'];
                                $sum = $sum + $total;
                                Session::set("qty", $qty);
                                Session::set("sum", $sum);
                            ?>
                        <?php }
                    } ?>

                </table>
                <?php
                $getData = $ct->checkCartTable();
                if ($getData){
                ?>
                <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Sub Total :</th>
                        <td><?php echo $sum; ?></td>
                    </tr>
                    <tr>
                        <th>VAT :</th>
                        <td>10%</td>
                    </tr>
                    <tr>
                        <th>Grand Total :</th>
                        <td>

                            <?php
                            $vat = $sum * 0.1;
                            $gtotal = $sum + $vat;
                            if (!$gtotal) {
                                echo "no product added";
                            } else {
                                echo $gtotal;
                            }


                            ?></td>
                    </tr>
                </table>
                <?php } else{

                    //header ("Location:index.php");
                    //  echo "Please buy something!! ";
                }?>
                <?php
                ?>
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt=""/></a>
                </div>
                <div class="shopright">
                    <a href="login.php"> <img src="images/check.png" alt=""/></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
</div>

<?php include 'inc/footer.php'; ?>
