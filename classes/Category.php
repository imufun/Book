 <?php 
 	// include '../lib/Session.php';
 	// Session::checkLogin();
 	include '../lib/Database.php';
 	include '../helpers/Format.php';

 ?>
  
<?php  
	class Category
	{
	    private $db;
   	  	private $fm;

   		public function __construct(){
   			$this->db  = new Database();
   			$this->fm = new Format();
   		}


	public function catInsert($catName){
		$catName = $this->fm->validation($catName);
		$catName = mysqli_real_escape_string($this->db->link, $catName);
		
		if (isset($catName)=='' || empty($catName)) {
			 $msg = "<span class='error'>Category field must not be empty !</span>";
			 return $msg;
		 }else{
		 	$query = "INSERT INTO tbl_category(catName) values('$catName')";
			$catInsert =  $this->db->insert($query);		 	
			if ($catInsert) {
				$msg = "<span class='success'>Category Item insert</span>";
				 return $msg; 
			 }else{
			 	 $msg = "<span class='error'>Category not inserted</span>";
				 return $msg; 
			 }			
		 }		
	}


	public function getAllcat(){

		$query = "SELECT * FROM tbl_category ORDER BY catID DESC";
		$result = $this->db->select($query);
		return $result;		
	}
}
?>