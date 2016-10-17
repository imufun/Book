<?php

$connect = mysqli_connect("localhost", "root", "", "store");
$output = '';
$sql = "SELECT * FROM tbl_product WHERE productName LIKE '%" . $_POST['search'] . "%'";
$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) > 0) {
    $output .= '<h4 align="center"></h4>';
    $output .= '<div class="table-responsive">
                   <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Product Name</th>
                          <th>Description</th>
                          <th>Price</th>
                          <th>Image</th>
                        </tr> ';
    while ($row = mysqli_fetch_array($result)){
        $output .='
                <tr>
                    <td>'.$row["productName"].'</td>
                    <td>'.$row["body"].'</td>
                    <td>'.$row["price"].'</td>
                    <td>'.$row["image"].'</td>
                </tr>
              ';
        echo $output;
    }
} else {
    echo "Data Not Found";
}
?>