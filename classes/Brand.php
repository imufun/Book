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

class Brand
{

    function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function brandInsert($brandName)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        if (isset($brandName) == '' || empty($brandName)) {
            $msg = "<span class='error'>Category field must not be empty !</span>";
            return $msg;
        } else {
            $query = "INSERT INTO  tbl_brand(brandName) values('$brandName')";
            $catInsert = $this->db->insert($query);
            if ($catInsert) {
                $msg = "<span class='success'>Brand insert</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Brand not inserted</span>";
                return $msg;
            }
        }
    }

    public function brandUpdate($brandName, $id)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($brandName)) {
            $msg = "<span class='error'>Category field must not be empty !</span>";
            return $msg;
        } else {
            // $query = "UPDATE  tbl_category SET (catName) values('$catName')";

            $query = "UPDATE tbl_brand SET brandName ='$brandName' WHERE brandID='$id' ";
            $update_row = $this->db->update($query);

            if ($update_row) {
                $msg = "<span class='success'>Brand Item Updated</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Brand not Updated</span>";
                return $msg;

            }
        }
    }

    public function getAllBrand()
    {
        $query = "SELECT * FROM tbl_brand ORDER BY brandID  ";
        $result = $this->db->select($query);
        return $result;
    }


    public function getBrandByID($id) {
        $query = "SELECT * FROM tbl_brand WHERE brandID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function delBrandById($id)
    {
        $query = "DELETE FROM tbl_brand WHERE brandID='$id'";
        $deledata = $this->db->delete($query);
        if ($deledata) {
            $msg = "<span class='success'>Brand Delete Item  </span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Brand not deleted !!!</span>";
            return $msg;
        }
    }


}

?>