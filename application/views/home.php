<div class="sidebar_wrap">
    <div class="headings">CATEGORIES</div>
    <div class="sidebar_cont">
        <?php foreach ($type as $catagories) { ?>
            <div class="sidebar_buttons">&raquo; <a href="home?category=<?php echo $catagories['category']; ?>"><?php echo $catagories['category']; ?></a></div>
        <?php } ?>
    </div>
    <script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <div class="headings">Find us on facebook</div>
    <div class="fb-like-box" data-href="https://www.facebook.com/pages/DBS-Trade-Centre/1526654370937336" width="250" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
</div>
<div class="content_wrap">
    <div class="slideshow">
        <div id="carousel">
            <?php
            if (!empty($sliderImage)) {
                foreach ($sliderImage as $image) {
                    ?>
                    <div><img src="images/slideShow/<?php echo $image; ?>" /></div>
                    <?php
                }
            } else {
                echo 'Sorry no images to display.';
            }
            ?>

        </div>
        <div id="pager"><div id="title"></div></div>
    </div>
    <div class="featured_products">
        <?php
        if (!empty($productData)) {
            ?>
            <h3>Latest Products</h3>
            <?php
            foreach ($productData as $prods) {
                ?>
                <div class="panel panel-default panel_override">
                    <div class="pnl_heading"><h4><?php echo $prods['title']; ?></h4></div>
                    <div class="panel-body panel-body_override">
                        <div class="image_area"><img src="<?php echo $prods['imgPath']; ?>" class="prodImg"></div>
                        <div class="prod_cont">
                            <?php
                            if (strlen($prods['desc']) < 80) {
                                echo $prods['desc'];
                            } else {
                                echo substr($prods['desc'], 0, 80) . '... <a href="javascript:void();" onclick="readMore(' . $prods['id'] . ');">Read More</a>';
                            }
                            ?> 
                        </div>
                        <button type="button" class="btn btn-default pnl_btn_override" onclick="bookProduct(1);">Book Product</button>
                    </div>
                </div>
                <?php
            }
        } elseif (!empty($searchResult)) {
            if (!is_array($searchResult)) {
                ?>
                <h3>Category: <?php echo $searchResult; ?></h3>
                <?php
                echo 'No data available for this category.';
            } else {
                $i = 1;
                foreach ($searchResult as $prods) {
                    if ($i == 1) {
                        $i++;
                        ?>
                        <h3>Category: <?php echo $prods['category']; ?></h3>
                    <?php } ?>
                    <div class="panel panel-default panel_override">
                        <div class="pnl_heading"><h4><?php echo $prods['title']; ?></h4></div>
                        <div class="panel-body panel-body_override">
                            <div class="image_area"><img src="<?php echo $prods['imgPath']; ?>" class="prodImg"></div>
                            <div class="prod_cont">
                                <?php
                                if (strlen($prods['desc']) < 80) {
                                    echo $prods['desc'];
                                } else {
                                    echo substr($prods['desc'], 0, 80) . '... <a href="javascript:void();" onclick="readMore(' . $prods['id'] . ');">Read More</a>';
                                }
                                ?> 
                            </div>
                            <button type="button" class="btn btn-default pnl_btn_override" onclick="bookProduct()">Book Product</button>
                        </div>
                    </div>
                    <?php
                }
            }
        } else {
            if (!is_array($search)) {
                ?>
                <h3>Search Result for <?php echo $search; ?></h3>
                <?php
                echo 'Sorry no result to display.';
            } else {
                $i = 1;
                foreach ($search as $prods) {
                    if ($i == 1) {
                        $i++;
                        ?>
                        <h3>Search Result for <?php echo $prods['keyword']; ?></h3>
                    <?php } ?>
                    <div class="panel panel-default panel_override">
                        <div class="pnl_heading"><h4><?php echo $prods['title']; ?></h4></div>
                        <div class="panel-body panel-body_override">
                            <div class="image_area"><img src="<?php echo $prods['imgPath']; ?>" class="prodImg"></div>
                            <div class="prod_cont">
                                <?php
                                if (strlen($prods['desc']) < 80) {
                                    echo $prods['desc'];
                                } else {
                                    echo substr($prods['desc'], 0, 80) . '... <a href="javascript:void();" onclick="readMore(' . $prods['id'] . ');">Read More</a>';
                                }
                                ?> 
                            </div>
                            <button type="button" class="btn btn-default pnl_btn_override" onclick="bookProduct()">Book Product</button>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>
        <span class="stretch"></span>
    </div>
    <?php if (!empty($productData)) { ?>
        <nav style="text-align: right;">
            <ul class="pagination" >
                <?php if ($prods['page'] == 1) { ?>
                    <li><a href="javascript:void()" id="paginationOverrideDisable">&laquo;</a></li>
                <?php } else { ?>
                    <li><a href="home?page=<?php echo $prods['page'] - 1; ?>" id="paginationOverride">&laquo;</a></li>
                <?php } if ($prods['page'] == $num_page) { ?>
                    <li><a href="javascript:void()" id="paginationOverrideDisable">&raquo;</a></li>
                <?php } else { ?>
                    <li><a href="home?page=<?php echo $prods['page'] + 1; ?>" id="paginationOverride">&raquo;</a></li>
                <?php } ?>
            </ul>
        </nav>
    <?php } ?>
</div>
<div class="popupBackground" id="readMoreBack">
    <div class="popup" id="readMoreCont">
        <div class="headings"><span id="title"></span><a href="javascript:void()" id="readMoreClose" class="close_btn">X</a></div>
        <div class="popupContent" id="content"></div>
    </div>
</div>
