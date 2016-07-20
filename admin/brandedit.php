<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>

<?php


    if (!isset($_GET['brandID']) || $_GET['brandID']==null) {
         echo "<script>window.location = 'brandlist.php';</script>";
    }else{
        $id = $_GET['brandID'];
    }
        $brand  = new Brand();

    if ($_SERVER['REQUEST_METHOD']== 'POST') {
        $brandName = $_POST['brandName'];
        $updateBrand = $brand->brandUpdate($brandName, $id);
    }

 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock">
                <?php
                    if (isset($updateBrand)){
                        echo $updateBrand;
                    }
                 ?>

                 <?php
                    $getBrand = $brand->getBrandByID($id);
                     if ($getBrand) {
                         while ($result = $getBrand->fetch_assoc()) {

                 ?>
                 <form method="post" action=" ">
                    <table class="form" >
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $result['brandName'];?>" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>

                    <?php  } }?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>