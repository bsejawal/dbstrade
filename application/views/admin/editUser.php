<div class = "admin_edit_center">
    <?php echo $username; ?>
    <h3>Edit User Information</h3>
    <a href = "settings" style = "outline: 0px;" title = "Back"><i class = "glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method = "POST" action = "updateUser">
        <input type="hidden" value="<?php echo $id; ?>" name="userId">
        <label for = "title"><h5>Name:</h5></label> <input id = "title" type = "text" class = "form-control admin_editBox_override" name = "name" value="<?php echo $name; ?>"/>
        <label for = "title"><h5>Gender:</h5></label> 
        <select class="form-control selectOverride" name="gender">
            <?php if ($gender == 'Male' || $gender == 'male') { ?>
                <option selected="selected" value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                <option value="Female">Female</option>
            <?php } else { ?>
                <option selected="selected" value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                <option value="Male">Male</option>
            <?php } ?>
        </select>
        <label for = "title"><h5>Username:</h5></label> <input id = "title" type = "text" class = "form-control admin_editBox_override" name = "username" value="<?php echo $username; ?>"/>
        <input type = "submit" value = "Update" class = "admin_edit_btn" />
    </form>
    <a href = "settings"><button class = "admin_edit_btn">Cancel</button></a>
</div>