<div class="popupCenter">
    <div class="pnl_heading" style="border-bottom: 1px solid #ff6600;"><h3>Post a request</h3></div>
    <form method="POST" action="sendRequest" onsubmit="return check();">
        <input type="hidden" value="<?php
        if (!empty($title)) {
            echo $title;
        }
        ?>" name="product" />
        <label for="name"><h5>Full Name:</h5></label> <input id="name" type="text" class="form-control admin_editBox_override" name="name" placeholder="Full Name"/>
        <label for="contact"><h5>Contact Information:</h5></label> <input id="contact" type="text" class="form-control admin_editBox_override" name="contact" placeholder="Email or Phone Number" />
        <label for="request"><h5>Request:</h5></label><br /> <textarea id="request" name="request" rows="20"  class="form-control"style="width:100%;"></textarea>
        <input type="submit" value="Order Now" class="btn btn-default pnl_btn_override" style="margin-bottom: 10px;" />
    </form>
</div>
<script type="text/javascript">
    function check() {
        var name = document.getElementById('name').value;
        var contact = document.getElementById('contact').value;
        var request = document.getElementById('request').value;
        if (name === '' || contact === '' || request === '') {
            alert('Please fill all fields');
            return false;
        } else {
            return true;
        }
    }

</script>