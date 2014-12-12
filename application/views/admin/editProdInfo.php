<div class="admin_edit_center">
    <h3>Edit Contact Information</h3>
    <a href="productManagement" style="outline: 0px;" title="Back"><i class="glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method="POST" action="editProduct">
        <input type="hidden" name="contentId" value="<?php echo $id; ?>">
        <label for="heading"><h5>Title:</h5></label> <input id="heading" type="text" class="form-control admin_editBox_override" name="title" value="<?php echo $prodTitle; ?>">
        <label for="img"><h5>Preview:</h5></label> <img src="<?php echo $imgPath; ?>" class="productImg" id="img"/>
        <label for="bodyContact"><h5>Description:</h5></label> <textarea id="bodyContact" name="desc"><?php echo $desc; ?></textarea>
        <input type="hidden" name="imgPath" value="<?php echo $mainPath; ?>">
        <input type="submit" value="Update" class="admin_edit_btn" />
    </form>
    <a href="productManagement"><button class="admin_edit_btn">Cancel</button></a>
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