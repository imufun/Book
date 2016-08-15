<?php

// include '../lib/Session.php';
// Session::checkLogin();
require_once '../lib/Database.php';
require_once '../helpers/Format.php';
?>

<?php

Class Product
{

    private $db;
    private $fm;

    function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function ProductInsert($data, $file)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandID = mysqli_real_escape_string($this->db->link, $data['brandID']);
        $body = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);


        //File upload
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $catId == "" || $brandID == "" || $body == "" || $price == "" || $file_name == "" || $type == "") {
            $msg = "<span class='error'>Field must not be empty!</span>";
            return $msg;
        } elseif ($file_size > 2048567) {
            echo "<span class='error'>File Size should be less then 2MB</span>";
        } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can only upload:-" . implode(',', $permited) . "</span>";
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName,catID,brandID,body,price,image,type) VALUES ('$productName','$catId','$brandID','$body','$price','$uploaded_image ','$type')";

            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                $msg = "<span class='success' style='color:green'>Product Insert Successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Product Insert not Successfully</span>";
                return $msg;
            }
        }


    }
}

?>