<?php
//load_product.php
$connect = mysqli_connect("localhost", "root", "", "store");
if (isset($_POST["price"])) {
    $output = '';
    $query = "SELECT * FROM tbl_product WHERE price <= " . $_POST['price'] . " ORDER BY price desc";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .= '  
                     <div class="col-md-4">  
                          <div style="">  
                               <img src="admin/' . $row["image"] . '" class="img-responsive" />  
                               <h3>' . $row["productName"] . '</h3>  
                               <h3>' . $row["body"] . '</h3>  
                               <h4>Price - ' . $row["price"] . '</h4>  
                          </div>  
                     </div>  
                ';
        }
    } else {
        $output = "No Product Found";
    }
    echo $output;
}
?>
