<div class="admin_edit_center">
    <h3>Edit Information</h3>
    <a href="contentManagement" style="outline: 0px;" title="Back"><i class="glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method="POST" action="editContent">
        <input type="hidden" name="contentId" value="<?php echo $id; ?>">
        <label for="heading"><h5>Heading:</h5></label> <input id="heading" type="text" class="form-control admin_editBox_override" name="headingContact" value="<?php echo $heading; ?>">
        <label for="bodyContact"><h5>Content:</h5></label> <textarea id="bodyContact" name="bodyContact"><?php echo $content; ?></textarea>
        <input type="submit" value="Update" class="admin_edit_btn" />
    </form>
    <a href="contentManagement"><button class="admin_edit_btn">Cancel</button></a>
</div>

<script type="text/javascript">
    var editor = CKEDITOR.replace('bodyContact', {
        filebrowserBrowseUrl: '<?php echo base_url(); ?>ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '<?php echo base_url(); ?>ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl: '<?php echo base_url(); ?>ckfinder/ckfinder.html?Type=Flash',
        filebrowserUploadUrl: '<?php echo base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '<?php echo base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '<?php echo base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
    CKFinder.setupCKEditor(editor, '<?php echo base_url(); ?>ckfinder/');
</script>