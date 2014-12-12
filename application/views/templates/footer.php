<?php if (!empty($name) || $title == 'Login') {
    ?>
    </body>
    <nav class=" <?php
    if ($title == 'Home' || $title == 'Login') {
        echo 'navbar navbar-default navbar-fixed-bottom';
    }else{
        echo 'footerNormal';
    }
    ?>">
        <div class="footer_center"><?php echo $footerData; ?></div>
    </nav>
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
    