<div class="admin_edit_center">
    <?php

    function get_image() {
        $files = scandir('images/uploads/');
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } else {
                $filePath[] = $file;
            }
        }
        return $filePath;
    }

    $filepath = get_image();
    ?>
    <?php if (count($filepath) < 10) { ?> <a onclick="readMore(0)"><button class="admin_edit_btn" style="float: right;">Upload Slider Image</button></a><?php } ?>
    <h3>Slider Management</h3>
    <div style="border-bottom: 1px solid #aaa;">
        <?php foreach ($filepath as $path) { ?>
            <div class="sliderPreview"><a href="editSlider?img=<?php echo $path; ?>"><img src="<?php echo base_url() . 'images/uploads/' . $path; ?>" class="iconSilder"/></a></div>
        <?php } ?>
    </div>
</div>
<div class="popupBackground" id="readMoreBack">
    <div class="popup" id="readMoreCont">
        <div class="headings">Upload Picture<a href="javascript:void();" id="readMoreClose" class="close_btn">X</a></div>
        <div class="popupContent" style="padding: 10px;">
            <div class="pnl_heading" style="border-bottom: 1px solid #ff6600;"><h3>Choose Picture</h3></div>
            <div class="input-group">
                <form method="POST" action="uploadImage" enctype="multipart/form-data" onsubmit="return checkImage();">
                    <span class="admin_edit_btn btn-file">Browse <input type="file" name="imgFile" id='img'></span>
                    <input type="submit" class="admin_edit_btn" value="Upload Image" style="float: right;">
                </form>
            </div>
            <label><h5>Preview:</h5> </label><img id='imgLocation' class='productImg' style="width: 700px;margin-bottom: 10px;">
        </div>
    </div>
</div>
<script>
    function checkImage() {
        if ($('#img').val() === '') {
            alert('Browse and select a picture.');
            return false;
        } else {
            return true;
        }
    }
</script>