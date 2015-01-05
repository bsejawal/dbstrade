<div class="popupCenter">
    <div class="pnl_heading" style="border-bottom: 1px solid #ff6600;"><h3>Post a request</h3></div>
    <form method="POST" action="sendRequest">
        <label for="name"><h5>Full Name:</h5></label> <input id="name" type="text" class="form-control admin_editBox_override" name="name" placeholder="Full Name"/>
        <label for="contact"><h5>Contact Information:</h5></label> <input id="contact" type="text" class="form-control admin_editBox_override" name="contact" placeholder="Email or Phone Number" />
        <label for="request"><h5>Request:</h5></label> <textarea id="request" name="request"></textarea>
        <input type="submit" value="Order Now" class="btn btn-default pnl_btn_override" style="margin-bottom: 10px;" />
    </form>
</div>

<script type="text/javascript">
    var editor = CKEDITOR.replace('request', {
        filebrowserBrowseUrl: '<?php echo base_url(); ?>ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '<?php echo base_url(); ?>ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl: '<?php echo base_url(); ?>ckfinder/ckfinder.html?Type=Flash',
        filebrowserUploadUrl: '<?php echo base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '<?php echo base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '<?php echo base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
    CKFinder.setupCKEditor(editor, '<?php echo base_url(); ?>ckfinder/');
</script>