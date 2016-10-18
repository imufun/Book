<?php include 'inc/header.php'; ?>

<?php

?>
<div class="main" xmlns="http://www.w3.org/1999/html">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Feature Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div id="product_loading" class="section group">
                    <?php
                    $getFd = $pd->getFeaturedProduct();
                    if ($getFd) {
                        while ($result = $getFd->fetch_assoc()) { ?>

                            <div class="grid_1_of_4 images_1_of_4">
                                <a href="details.php?proid=<?php echo $result['productId']; ?>"><img
                                        style="width: 100px;height: 100px" src="admin/<?php echo $result['image']; ?>"
                                        alt=""/>
                                </a>
                                <h2><?php echo $result['productName']; ?> </h2>
                                <p><?php echo $fm->textShorten($result['body'], 120); ?></p>
                                <p><span class="price"><?php echo $result['price']; ?></span></p>
                                <div class="button"><span><a
                                            href="details.php?proid=<?php echo $result['productId']; ?>"
                                            class="details">Details</a></span></div>
                            </div>

                        <?php }
                    } ?>

                </div>
            </div>
            <div class="col-md-4">

                <div align="center">
                    <span>100<input type="range" min="100" max="1500" step=" " value="10000" id="min_price"
                                    name="min_price"/>1500</span
                    <span id="price_range"></span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include 'inc/footer.php'; ?>
