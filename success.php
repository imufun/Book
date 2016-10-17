<?php include 'inc/header.php'; ?>
<?php

$login = Session::get("cuslogin");
if ($login == false) {
    header("Location:login.php");
}

?>

    <div class="main">
        <div class="content">
            <div class="row ">
                <div class="col-md-6 col-md-offset-3">

                    <?php

                    ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="panel-title">Success Order</h3></div>
                        <div class="panel-body"> Total payable Amount (Include VAT):<?php echo $result['vat']; ?></div>
                    </div>

                    <a href="cart.php" class="btn btn-grey">Back</a>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>