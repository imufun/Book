<?php
    $filepath = realpath(dirname(__FILE__));
    require_once ($filepath. '/../lib/Session.php');
    Session::checkLogin();
    require_once($filepath . '/../lib/Database.php');
    require_once($filepath . '/../helpers/Format.php');

?>
<?php

$filepath = realpath(dirname(__FILE__));

?>


<?php

class Adminlogin
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function adminLogin($adminUser, $adminPassword)
    {
        $adminUser = $this->fm->validation($adminUser);
        $adminPassword = $this->fm->validation($adminPassword);

        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPassword = mysqli_real_escape_string($this->db->link, $adminPassword);

        if (empty($adminUser) || empty($adminPassword)) {
            $loginmsg = "User name or Password not empty";
            return $loginmsg;
        } else {
            $query = "SELECT  * FROM  tbl_admin WHERE adminUser='$adminUser' AND  adminPass='$adminPassword'";
            $result = $this->db->select($query);
           
            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set("adminLogin", true);
                Session::set("adminId", $value['adminId']);
                Session::set("adminName", $value['adminName']);
                Session::set("adminUser", $value['adminUser']);
                header('Location:dashboard.php');
            } else {
                $loginmsg = "User name or Password not match";
                return $loginmsg;
            }
        }
    }

}

?>