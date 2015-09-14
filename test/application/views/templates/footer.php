<?php if (!empty($name) || $title == 'Login') {
    ?>
    <nav class=" <?php
    if ($title == 'Home' || $title == 'Login' || $title == 'ContentManagement' || $title == 'AddCategory' || $title == 'EditCategory' || $title == 'EditUser' || $title == 'EditPassword' || $title == 'Settings' || $title == 'ShowSlider') {
        echo 'navbar navbar-default navbar-fixed-bottom';
    } else {
        echo 'footerNormal';
    }
    ?>" style="z-index:0;">
        <div class="footer_center"><?php echo $footerData; ?></div>
    </nav>
    </body>
    </html>
<?php } else {
    ?>
    <div class="footer">
        <div class="footer_links">
            <a href="home">Home</a> | <a href="about">About us</a> | <a href="contact">Contact</a>
        </div>
        <?php echo $footerData; ?>
    </div>
    </div>
    </div>
    </body>
    </html>
    <?php
}
    