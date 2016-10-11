<?php include 'inc/header.php'; ?>
<?php

$login = Session::get("cuslogin");
if ($login == false) {
    header("Location:login.php");
}


?>

<?php

if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $cmrId = Session::get('cmrId');
    $insertOrder = $ct->orderProduct($cmrId);
    $delData = $ct->delCustomerCart();
    header("Location:success.php");
}
?>

    <div class="main">
        <div class="content">
            <div class="container">
                <div class="row ">
                    <div class="col-md-6 clearfix">
                        <table class="tblone">
                            <tr>
                                <th>SL</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
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
                                        <td><?php echo $result['price']; ?></td>
                                        <td><?php echo $result['quantity']; ?></td>

                                        <td>
                                            <?php
                                            $total = $result['price'] * $result['quantity'];
                                            echo $total;

                                            ?> </td>

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
                        if ($getData) {
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
                        <?php } else {

                            //header ("Location:index.php");
                            //  echo "Please buy something!! ";
                        } ?>
                        <?php
                        ?>
                        <a href="?orderid=order" class="btn btn-blue text-center clearfix col-md-12"
                           style="margin-top:100px">Order Now</a>
                    </div>
                    <div class="col-md-6 ">

                        <?php
                        $id = Session::get('cmrId');
                        $getdata = $customer->getCustomerData($id);
                        if ($getdata) {
                            while ($result = $getdata->fetch_assoc()) {

                                ?>

                                <form action="" method="POST" class="profile-edit">


                                    <div class="form-group">
                                        <div class="col-sm-6 pull-left"><label for="exampleInputEmail1">Name</label>
                                        </div>
                                        <div class="col-sm-6 pull-right"><p><?php echo $result['name']; ?></p></div>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-6 pull-left"><label for="exampleInputEmail1"><label
                                                    for="exampleInputPassword1">Address</label></label></div>
                                        <div class="col-sm-6 pull-right"><p><?php echo $result['address']; ?></p></div>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-6 pull-left"><label for="exampleInputPassword1">City</label>
                                        </div>
                                        <div class="col-sm-6 pull-right"><p><?php echo $result['city']; ?></p></div>


                                        <div class="form-group">

                                            <div class="col-sm-6 pull-left"><label
                                                    for="exampleInputPassword1">Country</label>
                                            </div>
                                            <div class="col-sm-6 pull-right"><p><?php echo $result['country']; ?></p>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-6 pull-left"><label for="exampleInputPassword1"> <label
                                                        for="exampleInputPassword1">Email</label></label></div>
                                            <div class="col-sm-6 pull-right"><p><?php echo $result['email']; ?></p>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-6 pull-left"><label for="exampleInputPassword1"> <label
                                                        for="exampleInputPassword1"><label
                                                            for="exampleInputPassword1">Zip</label></label></label>
                                            </div>
                                            <div class="col-sm-6 pull-right"><p><?php echo $result['zip']; ?></p></div>

                                        </div>

                                        <div class="form-group">

                                            <div class="col-sm-6 pull-left"><label for="exampleInputPassword1"> <label
                                                        for="exampleInputPassword1">Phone</label></label></label></div>
                                            <div class="col-sm-6 pull-right"><p><?php echo $result['phone']; ?></p>
                                            </div>
                                        </div>

                                        <a href="profileUpdate.php">Profile Update</a>

                                </form>
                            <?php }
                        } ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
<?php include 'inc/footer.php'; ?>
<?php include 'inc/footer.php'; ?>