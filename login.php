<?php include 'inc/header.php'; ?>

<?php

$login = Session::get("cuslogin");
if ($login == true) {
    header("Location:order.php");
} else {
    header("Location:login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $customerLog = $customer->customerLogin($_POST);

}
?>
<div class="main">
    <div class="content">
        <div class="login_panel">
            <?php
            if (isset($customerLog)) {
                echo $customerLog;
            }

            ?>
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>
            <form action="" method="POST">
                <input name="phone" type="text" placeholder="Phone">
                <input name="password" type="password" placeholder="Password">
                <div class="buttons">
                    <div>
                        <button class="grey" name="login">Sign In</button>
                    </div>
                </div>
            </form>


        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
            $customerReg = $customer->customerRegistration($_POST);

        }
        ?>
        <div class="register_account">
            <?php
            if (isset($customerReg)) {
                echo $customerReg;
            }
            ?>
            <h3>Register New Account</h3>
            <form action="" method="post">
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <div>
                                <input type="text" name="name" placeholder="name"/>
                            </div>

                            <div>
                                <input type="text" name="city" placeholder="City"/>
                            </div>

                            <div>
                                <input type="text" name="phone" placeholder="Phone"/>
                            </div>
                            <div>
                                <input type="email" name="email" placeholder="Email"/>
                            </div>
                        </td>
                        <td>
                            <div>
                                <input type="text" name="address" placeholder="Address"/>
                            </div>
                            <div>
                                <!--                               <input type="text" name="country" placeholder="Country"/>-->
                                <select id="country" name="country" onchange="change_country(this.value)"
                                        class="frm-field required">
                                    <option value="null">Select a Country</option>
                                    <option value="AF">Afghanistan</option>
                                    <option value="AL">Albania</option>
                                    <option value="DZ">Algeria</option>
                                    <option value="AR">Argentina</option>
                                    <option value="AM">Armenia</option>
                                    <option value="AW">Aruba</option>
                                    <option value="AU">Australia</option>
                                    <option value="AT">Austria</option>
                                    <option value="AZ">Azerbaijan</option>
                                    <option value="BS">Bahamas</option>
                                    <option value="BH">Bahrain</option>
                                    <option value="BD">Bangladesh</option>

                                </select>
                            </div>

                            <div>
                                <input type="text" name="zip" placeholder="Zip"/>
                            </div>

                            <div>
                                <input type="password" name="password" placeholder="password"/>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="search">
                    <div>
                        <button class="grey" name="register">Create Account</button>
                    </div>
                </div>

                <div class="clear"></div>
            </form>
        </div>
        <div class="clear"></div>
    </div>
</div>
</div>

<?php include 'inc/footer.php'; ?>
