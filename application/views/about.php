<div class="cont_about_contact">
    <div class="popupCenter" style="width: 900px;">
        <?php foreach ($aboutData as $aboutInfo) { ?>
            <div class="about_contact_heading" style="border-bottom: 1px solid #aaa;">
                <h3><?php echo $aboutInfo['heading']; ?></h3>
            </div>
            <div class="contentAboutContact">
                <?php echo $aboutInfo['content']; ?>
            </div>
        <?php } ?>
    </div>
</div>