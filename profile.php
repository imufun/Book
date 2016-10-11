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
            <div class="row ">
                <div class="col-md-6 col-md-offset-3">
                    <?php
                    $id = Session::get('cmrId');
                    $getdata = $customer->getCustomerData($id);
                    if ($getdata) {
                        while ($result = $getdata->fetch_assoc()) {

                            ?>

                            <form action="" method="POST" class="profile-edit">


                                <div class="form-group">
                                    <div class="col-sm-6 pull-left"><label for="exampleInputEmail1">Name</label></div>
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

                                    <div class="col-sm-6 pull-left"><label for="exampleInputPassword1">Country</label>
                                    </div>
                                    <div class="col-sm-6 pull-right"><p><?php echo $result['country']; ?></p></div>

                                </div>

                                <div class="form-group">
                                    <div class="col-sm-6 pull-left"><label for="exampleInputPassword1"> <label
                                                for="exampleInputPassword1">Email</label></label></div>
                                    <div class="col-sm-6 pull-right"><p><?php echo $result['email']; ?></p></div>

                                </div>

                                <div class="form-group">
                                    <div class="col-sm-6 pull-left"><label for="exampleInputPassword1"> <label
                                                for="exampleInputPassword1"><label
                                                    for="exampleInputPassword1">Zip</label></label></label></div>
                                    <div class="col-sm-6 pull-right"><p><?php echo $result['zip']; ?></p></div>

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-6 pull-left"><label for="exampleInputPassword1"> <label
                                                for="exampleInputPassword1">Phone</label></label></label></div>
                                </div>

                                <a href="profileUpdate.php">Profile Update</a>

                            </form>
                        <?php }
                    } ?>
                </div>

            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>