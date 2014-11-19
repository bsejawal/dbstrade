<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DB Traders</title>
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
        <link href="css/style.css" type="text/css" rel="stylesheet" />
        <script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="js/js_pak.js" type="text/javascript"></script>
        <script src="js/slide_show.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="site_center">
            <div class="wrap_site">
                <div class="header">
                    <div class="logo_area"><img src="images/logo1.png" height="100" width="150" /></div>
                    <div class="social_med">
                        <div class="social_med_heading">Follow us on:</div>
                        <a href="#"><img src="images/fb.png" class="social_med_link" /></a>
                        <a href="#"><img src="images/tw.png" class="social_med_link" /></a>
                        <a href="#"><img src="images/in.png" class="social_med_link" /></a>
                    </div>
                </div>
                <nav class="navbar navbar_override navbar-inverse" role="navigation">
                    <div class="col-lg-6 input_box">
                        <div class="input-group">
                            <input type="text" class="form-control form_override">
                            <span class="input-group-btn">
                                <button class="btn btn-default btn_override" type="button">Go</button>
                            </span>
                        </div>
                    </div>
                    <ul>
                        <li><a href="#" class="nav_link" style="border-radius: 4px 0px 0px 4px;">HOME</a></li>
                        <li><a href="#" class="nav_link">ABOUT US</a></li>
                        <li><a href="#" class="nav_link">CONTACT</a></li>
                        <li><a href="#" onmouseover="javascript:menu_list_on()" onmouseout="javascript:menu_list_off()" class="nav_link" id="product">PRODUCTS</a>
                            <div class="menu_list" onmouseover="javascript:menu_list_on()" onmouseout="javascript:menu_list_off()">
                                <div><a href="#">Herbs</a></div>   
                                <div><a href="#">Grains</a></div> 
                                <div><a href="#">Vegetables</a></div> 
                                <div><a href="#">Fruits</a></div> 
                                <div><a href="#">Spices</a></div> 
                            </div>
                        </li>
                    </ul>
                </nav>
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
                        <div class="panel panel-default panel_override">
                            <div class="pnl_heading"><h4>Heading 1</h4></div>
                            <div class="panel-body panel-body_override">
                                <div class="image_area"><img src="images/uploads/thumb/th1.jpg" width="120" height="120"></div>
                                <div class="prod_cont">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                                <button type="button" class="btn btn-default pnl_btn_override">Book Product</button>
                            </div>
                        </div>
                        <div class="panel panel-default panel_override">
                            <div class="pnl_heading"><h4>Heading 2</h4></div>
                            <div class="panel-body panel-body_override">
                                <div class="image_area"><img src="images/uploads/thumb/th2.jpg" width="120" height="120"></div>
                                <div class="prod_cont">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                                <button type="button" class="btn btn-default pnl_btn_override">Book Product</button>
                            </div>
                        </div>
                        <div class="panel panel-default panel_override">
                            <div class="pnl_heading"><h4>Heading 3</h4></div>
                            <div class="panel-body panel-body_override">
                                <div class="image_area"><img src="images/uploads/thumb/th3.png" width="120" height="120"></div>
                                <div class="prod_cont">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                                <button type="button" class="btn btn-default pnl_btn_override">Book Product</button>
                            </div>
                        </div>
                        <div class="panel panel-default panel_override">
                            <div class="pnl_heading"><h4>Heading 1</h4></div>
                            <div class="panel-body panel-body_override">
                                <div class="image_area"><img src="images/uploads/thumb/th1.jpg" width="120" height="120"></div>
                                <div class="prod_cont">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                                <button type="button" class="btn btn-default pnl_btn_override">Book Product</button>
                            </div>
                        </div>
                        <div class="panel panel-default panel_override">
                            <div class="pnl_heading"><h4>Heading 2</h4></div>
                            <div class="panel-body panel-body_override">
                                <div class="image_area"><img src="images/uploads/thumb/th2.jpg" width="120" height="120"></div>
                                <div class="prod_cont">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                                <button type="button" class="btn btn-default pnl_btn_override">Book Product</button>
                            </div>
                        </div>
                        <div class="panel panel-default panel_override">
                            <div class="pnl_heading"><h4>Heading 3</h4></div>
                            <div class="panel-body panel-body_override">
                                <div class="image_area"><img src="images/uploads/thumb/th3.png" width="120" height="120"></div>
                                <div class="prod_cont">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                                <button type="button" class="btn btn-default pnl_btn_override">Book Product</button>
                            </div>
                        </div>
                        <div class="panel panel-default panel_override">
                            <div class="pnl_heading"><h4>Heading 1</h4></div>
                            <div class="panel-body panel-body_override">
                                <div class="image_area"><img src="images/uploads/thumb/th1.jpg" width="120" height="120"></div>
                                <div class="prod_cont">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                                <button type="button" class="btn btn-default pnl_btn_override">Book Product</button>
                            </div>
                        </div>
                        <div class="panel panel-default panel_override">
                            <div class="pnl_heading"><h4>Heading 2</h4></div>
                            <div class="panel-body panel-body_override">
                                <div class="image_area"><img src="images/uploads/thumb/th2.jpg" width="120" height="120"></div>
                                <div class="prod_cont">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                                <button type="button" class="btn btn-default pnl_btn_override">Book Product</button>
                            </div>
                        </div>
                        <div class="panel panel-default panel_override">
                            <div class="pnl_heading"><h4>Heading 3</h4></div>
                            <div class="panel-body panel-body_override">
                                <div class="image_area"><img src="images/uploads/thumb/th3.png" width="120" height="120"></div>
                                <div class="prod_cont">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                                <button type="button" class="btn btn-default pnl_btn_override">Book Product</button>
                            </div>
                        </div>

                        <span class="stretch"></span>
                    </div>
                    <button type="button" class="btn btn-default btn_override_more">More Products <span>&raquo;</span></button>
                </div>
                <div class="footer">
                    <div class="footer_links">
                        <a href="#">Home</a> | <a href="#">About us</a> | <a href="#">Contact</a> | <a href="#">Products</a>
                    </div>
                    &COPY; <?php echo date('Y'); ?> DB Traders. All Rights Reserved. Privacy and Terms.
                </div>
            </div>
        </div>
    </body>
</html>