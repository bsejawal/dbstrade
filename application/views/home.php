<div class="sidebar_wrap">
    <div class="headings">CATEGORIES</div>
    <div class="sidebar_cont">
        <div class="sidebar_buttons">&raquo; <a href="#">I Phone Cases</a></div>
        <div class="sidebar_buttons">&raquo; <a href="#">Headset Manager</a></div>
        <div class="sidebar_buttons">&raquo; <a href="#">Displays</a></div>
        <div class="sidebar_buttons">&raquo; <a href="#">I Phone Cases</a></div>
        <div class="sidebar_buttons">&raquo; <a href="#">Headset Manager</a></div>
        <div class="sidebar_buttons">&raquo; <a href="#">Displays</a></div>
    </div>
    <div class="headings">INFORMATIONS</div>
    <div class="sidebar_cont">
        <div class="sidebar_buttons">&raquo; <a href="#">Terms and Conditions</a></div>
        <div class="sidebar_buttons">&raquo; <a href="#">Delivery Method</a></div>
        <div class="sidebar_buttons">&raquo; <a href="#">Payment Method</a></div>
        <div class="sidebar_buttons">&raquo; <a href="#">Press</a></div>
    </div>
</div>
<div class="content_wrap">
    <div class="slideshow">
        <div id="carousel">
            <div><img src="images/uploads/1.png" title="Farm 1" id="img1"/></div>
            <div><img src="images/uploads/2.jpg" title="Farm 2"/></div>
            <div><img src="images/uploads/3.jpg" title="Farm 2"/></div>
            <div><img src="images/uploads/4.jpg" title="Farm 2"/></div>
            <div><img src="images/uploads/5.jpg" title="Farm 2"/></div>
        </div>
        <div id="pager">
            <div id="title"></div>
        </div>
    </div>
    <div class="featured_products">
        <h3>Latest Products</h3>
        <?php foreach ($productData as $prods) { ?>
            <div class="panel panel-default panel_override">
                <div class="pnl_heading"><h4><?php echo $prods['title']; ?></h4></div>
                <div class="panel-body panel-body_override">
                    <div class="image_area"><img src="<?php echo $prods['imgPath']; ?>" class="prodImg"></div>
                    <div class="prod_cont"><?php echo $prods['desc']; ?></div>
                    <button type="button" class="btn btn-default pnl_btn_override">Book Product</button>
                </div>
            </div>
        <?php } ?>
        <span class="stretch"></span>
    </div>
    <button type="button" class="btn btn-default btn_override_more">More Products <span>&raquo;</span></button>
</div>