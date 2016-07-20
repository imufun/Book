<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Brand.php'; ?>

<?php
    $brand = new Brand();
   if (isset($_GET['deleteBrand'])) {
      $id = $_GET['deleteBrand'];
       $branddel = $brand->delBrandById($id);
  }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Brand List</h2>

        <div class="block">


            <?php
            if (isset($branddel)) {
                echo $branddel;
            }

            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $getBrand = $brand->getAllBrand();
                    if ($getBrand) {
                        $i = 0;
                        while ($result = $getBrand->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo $result['brandName']; ?> </td>
                                <td>
                                    <a href="brandedit.php?brandID=<?php echo $result['brandID']; ?>">Edit</a> ||
                                    <a onclick="return confirm('Are you sure to delete!')" href="?deleteBrand=<?php echo $result['brandID']; ?>">Delete</a>
                                </td>
                            </tr>

                        </tbody>
                    <?php }
                } ?>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>

