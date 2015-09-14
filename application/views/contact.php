<div class="cont_about_contact">
    <div class="popupCenter" style="width: 900px;">
        <?php foreach ($contactData as $contactInfo) { ?>
            <div class="about_contact_heading" style="border-bottom: 1px solid #aaa;">
                <h3><?php echo $contactInfo['heading']; ?></h3>
            </div>
            <div class="contentAboutContact">
                <?php echo $contactInfo['content']; ?>
            </div>
        <?php } ?>
    </div>
</div>