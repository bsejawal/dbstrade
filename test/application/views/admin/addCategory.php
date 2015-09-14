<div class = "admin_edit_center">
    <h3>Add Category</h3>
    <a href = "category" style = "outline: 0px;" title = "Back"><i class = "glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method = "POST" action = "insertCategory">
        <label for = "title"><h5>Category:</h5></label> <input id="title" type="text" class="form-control admin_editBox_override" name="category" />
        <label for="desc"><h5>Description:</h5></label> <input id="title" type="text" class="form-control admin_editBox_override" name="description" />
        <input type="submit" value="Add" class="admin_edit_btn" />
    </form>
    <a href="category"><button class="admin_edit_btn">Cancel</button></a>
</div>