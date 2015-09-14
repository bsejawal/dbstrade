<div class = "admin_edit_center">
    <h3>Edit Password</h3>
    <a href = "settings" style = "outline: 0px;" title = "Back"><i class = "glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
    <form method = "POST" action = "updatePassword" id="passForm">
        <input type="hidden" value="<?php echo $id; ?>" name="userId">
        <label for="oldPass" id="oldPassword"><h5>Old Password:</h5></label> <input id='oldPass' type="password" class="form-control admin_editBox_override" name = "oldPassword" />
        <label for="newPass" ><h5>New Password:</h5></label> <input id="newPass" type="password" class="form-control admin_editBox_override" name = "newPassword" />
        <label for="conPass" id='conPassword'><h5>Confirm Password:</h5></label> <input id="conPass" type="password" class="form-control admin_editBox_override" name = "conPassword" />
        <input type="submit" value="Update" class="admin_edit_btn" onclick="return checkPassword();" />
    </form>
    <a href = "settings"><button class="admin_edit_btn">Cancel</button></a>
</div>