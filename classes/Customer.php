<?php

$filepath = realpath(dirname(__FILE__));


require_once($filepath . '/../lib/Database.php');
require_once($filepath . '/../helpers/Format.php');
?>


<?php

Class Customer
{

    private $db;
    private $fm;

    function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function customerRegistration($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        $zip = mysqli_real_escape_string($this->db->link, $data['zip']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

        if ($name == "" || $address == "" || $city == "" || $country == "" || $email == "" || $password == "" || $zip == "" || $phone == "") {
            $msg = "<span class='error'>Field must not be empty!!!</span>";
            return $msg;
        }
        $phonechek = "SELECT * FROM tbl_customer WHERE phone='$phone' ";
        $mailchk = $this->db->select($phonechek);
        if ($mailchk != false) {
            $msg = "<span class='error'>number already exits. </span>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_customer (name,address,city,country,email,password,zip,phone)values('$name','$address','$city','$country',' $email','$password','$zip','$phone')";
            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                $msg = "<span class='successdd '>You have been Registered.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>You are not Registered</span>";
                return $msg;
            }
        }


    }

    public function customerLogin($data)
    {
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if (empty($phone) || empty($password)) {
            echo "Field must no be empty";
        }

        $query = "SELECT  * FROM tbl_customer WHERE phone= '$phone' AND password = '$password'";
        $result = $this->db->select($query);
        if ($result != false) {
            $value = $result->fetch_assoc();
            Session::set("cuslogin", true);
            Session::set("cmrId", $value['id']);
            Session::set("cmrName", $value['name']);

            header("Location:cart.php");
        } else {
            $msg = "<span class='error'>Phone number & Password not matched !</span>";
            return $msg;
        }

    }


    public function getCustomerData($Id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id ='$Id'";
        $result = $this->db->select($query);
        return $result;

    }

    public function CustomerUpdate($data, $cmrId)
    {

        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $zip = mysqli_real_escape_string($this->db->link, $data['zip']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

        if ($name == "" || $address == "" || $city == "" || $country == "" || $email == "" || $zip == "" || $phone == "") {
            $msg = "<span class='error'>Field must not be empty!!!</span>";
            return $msg;
        } else {
           // $query = "UPDATE INTO tbl_customer (name,address,city,country,email,zip,phone)values('$name','$address','$city','$country',' $email','$zip','$phone')";
            $query = "UPDATE  tbl_customer 
                        SET 
                              name='$name', 
                              address='$address',
                              city='$city',
                              country='$country',
                              email='$email',
                              zip='$zip',
                              phone='$phone' 
                              
                         WHERE  id='$cmrId'";

            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                $msg = "<span class='successdd '>Customer Data Updated</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Customer data not updated</span>";
                return $msg;
            }
        }


    }


}

?>