<?php
//require_once '../lib/Database.php';
//require_once '../helpers/Format.php';
//
//?>

<?php

$filepath = realpath(dirname(__FILE__));


require_once($filepath . '/../lib/Database.php');
require_once($filepath . '/../helpers/Format.php');
?>


<?php


Class Cart
{
    private $db;
    private $fm;

    function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    // Product -> add to cart
    public function addToCart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();


        $query = "SELECT *FROM tbl_product WHERE productId = '$productId' ";
        $result = $this->db->select($query)->fetch_assoc();

        $productname = $result['productName'];
        $price = $result['price'];
        $image = $result['image'];

        $checkquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId='$sId'";
        $getPro = $this->db->select($checkquery);

        if ($getPro) {
            $msg = 'Product Already Added';
            return $msg;
        } else {
            $query = "INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image) VALUES ('$sId','$productId','$productname',  '$price','$quantity','$image')";
            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                header("Location:cart.php");
            } else {
                header("Location:404.php");
            }
        }
    }


    public function getCartProduct()
    {
        $sId = session_id();
        $query = "SELECT *FROM tbl_cart WHERE sId = '$sId' ";
        $result = $this->db->select($query);
        return $result;
    }

}

?>