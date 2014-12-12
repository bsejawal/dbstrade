<div class="admin_edit_center">
    <h3>Content Management</h3>
    <div class="panel">
        <a href="home" style="outline: 0px;" title="Back"><i class="glyphicon glyphicon-circle-arrow-left back_btn"></i></a>
        <?php if ($role == 'dev') { ?><a href="addContent" style="outline: 0px;" title="Add"><i class="glyphicon glyphicon-plus-sign back_btn"></i></a><?php } ?>
        <table class="table table-hover table_override_content">
            <tr>
                <th width="20">S.No.</th>
                <th>Title</th>
                <th>Description</th>
                <th colspan="2" style="text-align: center">Action</th>
            </tr>
            <?php foreach ($getInfo as $info) { ?>
                <tr>
                    <td ><a href="editInfo?id=<?php echo $info['id']; ?>"><?php echo $info['sn']; ?></a></td>
                    <td><a href="editInfo?id=<?php echo $info['id']; ?>"><?php echo $info['heading']; ?></a></td>
                    <td><?php echo $info['description']; ?></td>
                    <td width="10"><a href="editInfo?id=<?php echo $info['id']; ?>" title="Edit"><i class="glyphicon glyphicon-list-alt glyphicon_list_override"></i></a></td>
                    <?php if ($role == 'dev') { ?><td width="10"><a href="#" title="Delete"><i class="glyphicon glyphicon-remove glyphicon_delete_override"></i></a></td><?php } ?>
                </tr>
            <?php } ?>
        </table>
    </div>
    <nav>
        <ul class="pagination">
            <li><a href="contentManagement?page=<?php echo 1; ?>"><span aria-hidden="true">&laquo; First</span><span class="sr-only">Previous</span></a></li>
            <?php for ($i = 1; $i <= $num_pages; $i++) { ?>
                <li><a href="contentManagement?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
            <li><a href="contentManagement?page=<?php echo $num_pages; ?>"><span aria-hidden="true">Last &raquo;</span><span class="sr-only">Next</span></a></li>
        </ul>
    </nav>
</div>