<div class="admin_edit_center">
    <h3>Add Product Information</h3>
    <a href="productManagement" style="outline: 0px;" title="Back"><i class="glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method="POST" action="insertProduct" enctype="multipart/form-data">
        <label for="title"><h5>Title:</h5></label> <input id="title" type="text" class="form-control admin_editBox_override" name="titleProduct" />
        <label for="desc"><h5>Description:</h5></label> <textarea id="desc" name="desc"></textarea>
        <label for="img"><h5>Image:</h5></label>
        <div class="input-group">
            <span class="btn btn-default btn-file">Browse <input type="file" name="imgFile"></span>
        </div>
        <input type="submit" value="Add" class="admin_edit_btn" />
    </form>
    <a href="productManagement"><button class="admin_edit_btn">Cancel</button></a>
</div>

<script type="text/javascript">
    var editor = CKEDITOR.replace('desc', {
        filebrowserBrowseUrl: '<?php echo base_url(); ?>ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '<?php echo base_url(); ?>ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl: '<?php echo base_url(); ?>ckfinder/ckfinder.html?Type=Flash',
        filebrowserUploadUrl: '<?php echo base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '<?php echo base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '<?php echo base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
    CKFinder.setupCKEditor(editor, '<?php echo base_url(); ?>ckfinder/');
</script>