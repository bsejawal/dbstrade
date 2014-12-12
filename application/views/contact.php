<div class="cont_about_contact">
    <?php foreach ($contactData as $contactInfo) { ?>
        <h3><?php echo $contactInfo['heading']; ?></h3>
        <?php echo $contactInfo['content']; ?>
    <?php } ?>
</div>