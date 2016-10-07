<?php include 'inc/header.php'; ?>
<?php

$login = Session::get("cuslogin");
if ($login == false) {
    header("Location:login.php");
}


if (isset($_SERVER) == 'POST' && isset($_POST['submit'])) {

}


?>

    <div class="main">
        <div class="content">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <?php
                    $id = Session::get('cmrId');
                    $getdata = $customer->getCustomerData($id);
                    ?>

                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name"
                                   name="name">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Address</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Address"
                                   name="address">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">City</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="City"
                                   name="city">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Country</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Country"
                                   name="country">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Email"
                                   name="email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Zip</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Zip"
                                   name="zip">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Phone"
                                   name="phone">
                        </div>

                        <button type="submit" class="btn btn-default ">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>