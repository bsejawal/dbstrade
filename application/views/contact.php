<div class="cont_about_contact">
    <div class="popupCenter" style="width: 900px;">
        <?php foreach ($contactData as $contactInfo) { ?>
            <div class="about_contact_heading" style="border-bottom: 1px solid #aaa;">
                <h3><?php echo $contactInfo['heading']; ?></h3>
            </div>
            <div style="margin: 0 auto; text-align: justify;background: #f8f8f8;padding: 10px; display: table;">
                <?php echo $contactInfo['content']; ?>
            </div>
        <?php } ?>
    </div>
</div>