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
            <div class="col-md-6 col-md-offset-3"
                 style="border: 1px solid #B2BBD0;height: 300px;border-radius4px;padding: 10px;text-align: center">
                <div class="payment-section">
                    <h3 style="text-align: center;padding-top: 20px">Success Order</h3>

                </div>
                <a href="cart.php" class="btn btn-grey">Back</a>
            </div>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>
<?php include 'inc/footer.php'; ?>