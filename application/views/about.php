<div class="cont_about_contact">
    <div class="popupCenter" style="width: 900px;">
        <?php foreach ($aboutData as $aboutInfo) { ?>
            <div class="about_contact_heading" style="border-bottom: 1px solid #aaa;">
                <h3><?php echo $aboutInfo['heading']; ?></h3>
            </div>
            <div style="margin: 0 auto; text-align: justify;background: #f8f8f8;;padding: 10px; display: table;">
                <?php echo $aboutInfo['content']; ?>
            </div>
        <?php } ?>
    </div>
</div>