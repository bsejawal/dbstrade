<div class="admin_edit_center">
    <div style="border: 1px solid black;width: 702px; float: left; margin-right: 20px"><img src="<?php echo base_url() ?>images/uploads/<?php echo $imageName; ?>" id="cropbox" style="width: 700px;" /></div>
    <h4>Tips:</h4>
    <ol>
        <li>Click on the image.</li>
        <li>Adjust the selection box UP or DOWN.</li>
        <li>Click on <b>Crop & Save</b>.</li>
    </ol>
    <h4>Trouble cropping?</h4>
    Try resizing image before uploading.
    <form action="cropImage" method="post" onsubmit="return checkCoords();">
        <input type="hidden" name="imgPath" value="<?php echo base_url() ?>images/uploads/<?php echo $imageName; ?>" />
        <input type="hidden" id="x" name="x" />
        <input type="hidden" id="y" name="y" />
        <input type="hidden" id="w" name="w" />
        <input type="hidden" id="h" name="h" />
        <input type="submit" value="Crop & Save" class="admin_edit_btn" />
    </form>
    <a href="deleteImage?img=<?php echo $imageName; ?>" onclick="return confirm('Are you sure?')"><button class="admin_edit_btn">Delete Image</button></a>
</div>
<script type="text/javascript">
    $(function () {
        $('#cropbox').Jcrop({
            aspectRatio: 0,
            onSelect: updateCoords,
            minSize: [700, 300],
            maxSize: [700, 300]
        });
    });
    function updateCoords(c) {
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    }
    ;
    function checkCoords() {
        if (parseInt($('#w').val()))
            return true;
        alert('Please select a crop region then press submit.');
        return false;
    }
    ;
</script>
