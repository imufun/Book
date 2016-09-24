<?php

//
//// include '../lib/Session.php';
//// Session::checkLogin();
//require_once '../lib/Database.php';
//require_once '../helpers/Format.php';
//
?>

<?php

$filepath = realpath(dirname(__FILE__));


require_once($filepath . '/../lib/Database.php');
require_once($filepath . '/../helpers/Format.php');
?>

<?php

class Category {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function catInsert($catName) {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (isset($catName) == '' || empty($catName)) {
            $msg = "<span class='error'>Category field must not be empty !</span>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_category(catName) values('$catName')";
            $catInsert = $this->db->insert($query);
            if ($catInsert) {
                $msg = "<span class='success'>Category Item insert</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Category not inserted</span>";
                return $msg;
            }
        }
    }

    public function getAllcat() {

        $query = "SELECT * FROM tbl_category ORDER BY catID DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCadByID($id) {
        $query = "SELECT * FROM tbl_category WHERE catID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function catUpdate($catName, $id) {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($catName)) {
            $msg = "<span class='error'>Category field must not be empty !</span>";
            return $msg;
        } else {
            // $query = "UPDATE  tbl_category SET (catName) values('$catName')";

            $query = "UPDATE tbl_category SET catName ='$catName' WHERE catID='$id' ";
            $update_row = $this->db->insert($query);

            if ($update_row) {
                $msg = "<span class='success'>Category Item Updated</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Category not Updated</span>";
                return $msg;
            }
        }
    }

    public function delCatByid($id) {
        $query = "DELETE FROM tbl_category WHERE catId='$id'";
        $deledata = $this->db->delete($query);
        if ($deledata) {
            $msg = "<span class='success'>Delete Item  </span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Ite, not deleted !!!</span>";
            return $msg;
        }
    }
    
 
//    public function ShowCatName($id){
//        
//        $query = "SELECT *FROM tbl_category WHERE catName='$id'";
//        $result = $this->db->select($query);
//        return $result;
//    }
}
?>