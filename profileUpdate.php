<?php include 'inc/header.php'; ?>
<?php

$login = Session::get("cuslogin");
if ($login == false) {
    header("Location:login.php");
}


?>
<?php

$cmrId = Session::get("cmrId");
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $profileupdate = $customer->CustomerUpdate($_POST, $cmrId);
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

                                <?php
                                if (isset($profileupdate)){
                                    echo $profileupdate;
                                }
                                ?>
                                <div class="form-group">
                                    <div class="col-sm-3 pull-left"><label for="exampleInputEmail1">Name</label></div>
                                    <div class="col-sm-9 pull-right"><input type="text" class="form-control"
                                                                            id="exampleInputEmail1"
                                                                            value="<?php echo $result['name']; ?>"
                                                                            name="name"></div>

                                </div>

                                <div class="form-group">
                                    <div class="col-sm-3 pull-left"><label for="exampleInputEmail1"><label
                                                for="exampleInputPassword1">Address</label></label></div>
                                    <div class="col-sm-9 pull-right"><input type="text" class="form-control"
                                                                            id="exampleInputPassword1"
                                                                            value="<?php echo $result['address']; ?>"
                                                                            name="address"></div>

                                </div>

                                <div class="form-group">
                                    <div class="col-sm-3 pull-left"><label for="exampleInputPassword1">City</label>
                                    </div>
                                    <div class="col-sm-9 pull-right"><input type="text" class="form-control"
                                                                            id="exampleInputPassword1"
                                                                            value="<?php echo $result['city'] ?>"
                                                                            name="city"></div>

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-3 pull-left"><label for="exampleInputPassword1">Country</label>
                                    </div>
                                    <div class="col-sm-9 pull-right"><input type="text" class="form-control"
                                                                            value="<?php echo $result['country'] ?>"
                                                                            name="country"></div>

                                </div>

                                <div class="form-group">
                                    <div class="col-sm-3 pull-left"><label for="exampleInputPassword1"> <label
                                                for="exampleInputPassword1">Email</label></label></div>
                                    <div class="col-sm-9 pull-right">
                                        <input type="text" class="form-control" id="exampleInputPassword1"
                                               value="<?php echo $result['email'] ?>"
                                               name="email"></div>


                                </div>

                                <div class="form-group">
                                    <div class="col-sm-3 pull-left"><label for="exampleInputPassword1">Zip</label></div>
                                    <div class="col-sm-9 pull-right">
                                        <input type="text" class="form-control" id="exampleInputPassword1"
                                               value="<?php echo $result['zip'] ?>"
                                               name="zip"></div>


                                </div>

                                <div class="form-group">

                                    <div class="col-sm-3 pull-left"><label for="exampleInputPassword1"> Phone</label>
                                    </div>
                                    <div class="col-sm-9 pull-right">

                                        <input type="text" class="form-control" id="exampleInputPassword1"
                                               value="<?php echo $result['phone'] ?>"
                                               name="phone"></div>


                                </div>

                                <button type="submit" class="btn btn-default " name="submit">Submit</button>
                            </form>
                        <?php }
                    } ?>
                </div>

            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>