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

    //update cart Quantity
    public function updateCartQuantity($cartId, $quantity)
    {
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);

        $query = "UPDATE tbl_cart SET quantity ='$quantity' WHERE catID ='$cartId' ";
        $update_row = $this->db->update($query);
        if ($update_row) {
            $msg = "<span class='success'>Update Quantity</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Update not update</span>";
            return $msg;
        }
    }

    //Delete item product
    function delProductByCart($delid)
    {
        $delId = mysqli_real_escape_string($this->db->link, $delid);
        $query = "DELETE FROM tbl_cart WHERE catID = '$delId'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            echo "<script>window.location = 'cart.php';</script>";
        } else {
            $msg = "<span class='error'>Product  not Delete</span>";
            return $msg;
        }
    }


}

?>