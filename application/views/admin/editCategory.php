<div class = "admin_edit_center">
    <h3>Edit Category</h3>
    <a href = "category" style = "outline: 0px;" title = "Back"><i class = "glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method = "POST" action = "updateCategory">
        <input type="hidden" value="<?php echo $id;?>" name="cateId">
        <label for = "title"><h5>Category:</h5></label> <input id = "title" type = "text" class = "form-control admin_editBox_override" name = "category" value="<?php echo $category;?>"/>
        <label for = "desc"><h5>Description:</h5></label> <input id = "title" type = "text" class = "form-control admin_editBox_override" name = "description" value="<?php echo $desc;?>"/>
        <input type = "submit" value = "Update" class = "admin_edit_btn" />
    </form>
    <a href = "category"><button class = "admin_edit_btn">Cancel</button></a>
</div>