<?php include("header.php") ?>
<!------------Content ---->
<div class="wrapper">
    <div class="desc">
        <h1 class="title-product">Product List</h1>
        <div class="variation text-center">
            <ul>
                <?php $results = $db->query("SELECT * FROM product_categ ORDER BY id ");
                while ($row = $results->fetch_object()) : ?>
                    <li><a href="#"><?= $row->categ ?></a></li>
                <?php endwhile; ?>
            </ul>
        </div>

        <div class="content">
            <!-- content here -->
            <?php $results2 = $db->query("SELECT* FROM product_categ ORDER BY id ");
            while ($row2 = $results2->fetch_object()) : ?>

                <div class="product-grid product-grid--flexbox">
                    <div class="product-grid__wrapper">
                        <?php $results3 = $db->query("SELECT* FROM products WHERE categ=$row2->id");
                        while ($row3 = $results3->fetch_object()) : ?>
                            <!-- Product list start here -->
                            <!-- Single product -->
                            <form class="product-form" action="#">
                                <div class="product-grid__product-wrapper">
                                    <div class="product-grid__product">
                                        <div class="product-grid__img-wrapper">
                                            <img src="img/americano.jpg" width="100%" height="100%" />
                                        </div>
                                        <span class="product-grid__title"><?= $row3->product_name ?></span>
                                        <input type="hidden" name="product-title" value="<?= $row3->product_name ?>">
                                        <span class="product-grid__price"><?= $row3->price ?></span>
                                        <input type="hidden" name="product-price" value="<?= $row3->price ?>">
                                        <div class="product-grid__extend-wrapper">
                                            <div class="product-grid__extend">
                                                <p class="product-grid__description"><?= $row3->description ?></p>
                                                <input type="hidden" name="product-desc" value="<?= $row3->description ?>">
                                                <input class="product-grid__btn product-grid__add-to-cart " type="submit" value="Add to Cart">
                                                <input type="hidden" name="Add-to-Cart" value="Add to Cart">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>


    </div>
</div>



<?php include("footer.php") ?>