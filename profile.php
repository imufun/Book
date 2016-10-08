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
                                    <!--                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name"-->
                                    <!--                                           name="name">-->
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-6 pull-left"><label for="exampleInputEmail1"><label
                                                for="exampleInputPassword1">Address</label></label></div>
                                    <div class="col-sm-6 pull-right"><p><?php echo $result['address']; ?></p></div>

                                    <!---->
                                    <!--                                    <input type="password" class="form-control" id="exampleInputPassword1"-->
                                    <!--                                           placeholder="Address"-->
                                    <!--                                           name="address">-->
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-6 pull-left"><label for="exampleInputPassword1">City</label>
                                    </div>
                                    <div class="col-sm-6 pull-right"><p><?php echo $result['city']; ?></p></div>

                                    <!---->
                                    <!--                                    <input type="text" class="form-control" id="exampleInputPassword1"-->
                                    <!--                                           placeholder="City"-->
                                    <!--                                           name="city">-->
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-6 pull-left"><label for="exampleInputPassword1">Country</label>
                                    </div>
                                    <div class="col-sm-6 pull-right"><p><?php echo $result['country']; ?></p></div>
                                    <!--                                     -->
                                    <!--                                    <input type="text" class="form-control" id="exampleInputPassword1"-->
                                    <!--                                           placeholder="Country"-->
                                    <!--                                           name="country">-->
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-6 pull-left"><label for="exampleInputPassword1"> <label
                                                for="exampleInputPassword1">Email</label></label></div>
                                    <div class="col-sm-6 pull-right"><p><?php echo $result['email']; ?></p></div>

                                    <!---->
                                    <!--                                    <input type="text" class="form-control" id="exampleInputPassword1"-->
                                    <!--                                           placeholder="Email"-->
                                    <!--                                           name="email">-->
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-6 pull-left"><label for="exampleInputPassword1"> <label
                                                for="exampleInputPassword1"><label
                                                    for="exampleInputPassword1">Zip</label></label></label></div>
                                    <div class="col-sm-6 pull-right"><p><?php echo $result['zip']; ?></p></div>


                                    <!--                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Zip"-->
                                    <!--                                           name="zip">-->
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-6 pull-left"><label for="exampleInputPassword1"> <label
                                                for="exampleInputPassword1">Phone</label></label></label></div>
                                    <div class="col-sm-6 pull-right"><p><?php echo $result['phone']; ?></p></div>

                                    <!---->
                                    <!---->
                                    <!--                                    <input type="text" class="form-control" id="exampleInputPassword1"-->
                                    <!--                                           placeholder="Phone"-->
                                    <!--                                           name="phone">-->
                                </div>

                                <a href="profileUpdate.php">Profile Update</a>

                                <!--                                <button type="submit" class="btn btn-default ">Submit</button>-->
                            </form>
                        <?php }
                    } ?>
                </div>

            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>