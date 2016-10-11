<?php include 'inc/header.php'; ?>
<?php
if (!isset($_GET['proid']) || $_GET['proid'] == null) {
    echo "<script>window.location = '404.php';</script>";
} else {
    $id = $_GET['proid'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = $_POST['quantity'];
    $addCat = $ct->addToCart($quantity, $id);
}
?>

    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="cont-desc span_1_of_2">
                    <?php
                    $getPD = $pd->getSingleProduct($id);
                    if ($getPD) {
                        while ($result = $getPD->fetch_assoc()) {
                            ?>
                            <div class="grid images_3_of_2">
                                <a href="admin/<?php echo $result['image']; ?>" data-options="zoomWidth:400px; zoomHeight:400px" class="MagicZoom"> <img src="admin/<?php echo $result['image']; ?>" alt=""/> </a>

                            </div>
                            <div class="desc span_3_of_2">
                                <h2><?php echo $result['productName']; ?> </h2>

                                <div class="price">
                                    <p>Price: <span><?php echo $result['price']; ?></span></p>
                                    <p>Category: <span><?php echo $result['catName']; ?></span></p>
                                    <p>Brand:<span><?php echo $result['brandName']; ?></span></p>
                                </div>
                                <div class="add-cart">
                                    <form action="#" method="post">
                                        <input type="number" class="buyfield" name="quantity" value="1"/>
                                        <input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
                                    </form>
                                </div>

                                <span style="color:red; font-size: 18px;margin-top:15px;display: block">
                                    <?php
                                    if (isset($addCat)) {
                                        echo $addCat;
                                    }
                                    ?>
                            </span>
                            </div>
                            <div class="product-desc">
                                <h2>Product Details</h2>
                                <p><?php echo $result['body']; ?></p>

                            </div>
                        <?php }
                    }
                    ?>
                </div>
                <div class="rightsidebar span_3_of_1">
                    <h2>CATEGORIES</h2>

                    <ul>
                        <?php
                        $getCat = $ctgry->getAllcat();
                        if ($getCat) {

                            while ($result = $getCat->fetch_assoc()) {
                                ?>
                                <li>
                                    <a href="productbycat.php?catId=<?php echo $result['catID']; ?>"><?php echo $result['catName']; ?></a>
                                </li>
                            <?php }
                        } ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>