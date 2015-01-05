<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title ?> - DBS Trade Centre</title>
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>css/style.css" type="text/css" rel="stylesheet" />
        <script src="<?php echo base_url(); ?>js/jquery-2.1.1.min.js" type="text/javascript"></script>
        <link href="<?php echo base_url(); ?>css/admin_style.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>css/jquery.Jcrop.min.css" type="text/css" rel="stylesheet" />
        <script src="<?php echo base_url(); ?>ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>ckfinder/ckfinder.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/admin_js.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/jquery.Jcrop.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/js_pak.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/slide_show.js" type="text/javascript"></script>
    </head>
    <body <?php
    if (isset($flashData)) {
        if ($flashData[0] == 'ok') {
            echo 'onload="show_flash(\'success\');"';
        } elseif ($flashData[0] == 'error') {
            echo 'onload="show_flash(\'failed\');"';
        }
    }
    ?>>
            <?php
            if (isset($flashData)) {
                if ($flashData[0] == 'error') {
                    echo '<div class="flash_data_err" id="failed"><img src="' . base_url() . 'images/warning_shield_grey.png" height="20" width="20" /> ' . $flashData[1] . '</div>';
                }
                if ($flashData[0] == 'ok') {
                    echo '<div class="flash_data_ok" id="success"><img src="' . base_url() . 'images/tick.png" height="20" width="20" /> ' . $flashData[1] . '</div>';
                }
            }
            if ($title != 'Login' && empty($name)) {
                ?>
            <div class="site_center">
                <div class="wrap_site">
                    <div class="header">
                        <div class="logo_area"><img src="images/logo1.png" height="100" width="150" /></div>
                        <div class="social_med">
                            <div class="social_med_heading">Follow us on:</div>
                            <a href="https://www.facebook.com/pages/DBS-Trade-Centre/1526654370937336"><img src="<?php echo base_url(); ?>images/fb.png" class="social_med_link" /></a>
                            <a href="https://twitter.com/"><img src="<?php echo base_url(); ?>images/tw.png" class="social_med_link" /></a>
                            <a href="https://www.linkedin.com/"><img src="<?php echo base_url(); ?>images/in.png" class="social_med_link" /></a>
                        </div>
                    </div>
                    <nav class="navbar navbar_override navbar-default" role="navigation">
                        <div class="col-lg-6 input_box">
                            <div class="input-group">
                                <form method="GET" action="home">
                                    <input type="text" class="form-control form_override" name="keyword" placeholder="Search Product..." style="width: 225px;">
                                    <span class="input-group-btn">
                                        <input type="submit" class="btn btn-default btn_override" value="Go" />
                                    </span>
                                </form>
                            </div>
                        </div>
                        <ul>
                            <li><a href="home" class="nav_link" style="border-radius: 4px 0px 0px 4px;">HOME</a></li>
                            <li><a href="about" class="nav_link">ABOUT US</a></li>
                            <li><a href="contact" class="nav_link">CONTACT</a></li>
                            <li><a href="javascript:void()" onmouseover="javascript:menu_list_on()" onmouseout="javascript:menu_list_off()" class="nav_link" id="product">CATEGORIES</a>
                                <div class="menu_list" onmouseover="javascript:menu_list_on()" onmouseout="javascript:menu_list_off()">
                                    <?php foreach ($type as $catagories) { ?>
                                        <div><a href="home?category=<?php echo $catagories['category']; ?>"><?php echo $catagories['category']; ?></a></div>
                                    <?php } ?>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <?php
                } elseif (!empty($name)) {
                    ?>
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="home">DBS Trade Center - Admin Panel</a>
                            </div>
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li><a href="home" style="outline: 0px;">Home</a></li>
                                    <li><a href="contentManagement" style="outline: 0px;">Content Management</a></li>
                                    <li><a href="productManagement" style="outline: 0px;">Product Management</a></li>
                                    <li><a href="category" style="outline: 0px;">Category Management</a></li>

                                </ul>
                                <span class="nav_user_info">Hello,
                                    <?php
                                    if ($gender == 'male' || $gender == 'Male') {
                                        echo 'Mr. ';
                                    } else {
                                        echo 'Ms. ';
                                    }
                                    ?>
                                    <a href="javascript:void(0);" id="name_link"><?php echo ucfirst($name); ?></a></span>
                            </div>
                        </div>
                    </nav>
                    <div class="logout_box" id="logout_box">
                        <div class="arrow-up"></div>
                        <div class="logout_text">
                            <div class="logout_btns">&raquo; <a href="settings" style="outline: 0px;">Settings</a></div>
                            <div class="logout_btns">&raquo; <a href="logout">Logout</a></div>
                        </div>
                    </div>
                    <?php
                }                    