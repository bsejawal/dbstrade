<div class="cont_about_contact">
    <?php foreach ($aboutData as $aboutInfo) { ?>
        <h3><?php echo $aboutInfo['heading']; ?></h3>
        <?php echo $aboutInfo['content']; ?>
    <?php } ?>
</div>