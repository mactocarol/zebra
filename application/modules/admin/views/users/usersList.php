<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = $startFrom; foreach($userList as $oneRow){ ?>
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $oneRow['firstName']; ?></td>
            <td><?php echo $oneRow['lastName']; ?></td>
            <td><?php echo $oneRow['email']; ?></td>
            <td>
                <?php if($oneRow['status'] == 'Active'){ ?>
                    <span class="tag tag-success ">ACTIVE</span>
                <?php }else{ ?>
                    <span class="tag tag-danger ">INACTIVE</span>
                <?php } ?>
            </td>
            <td>
                <?php if($oneRow['status'] == 'Active'){ ?>
                    <span class="tag tag-danger"><i class="icon-android-close"></i></span>
                <?php }else{ ?>
                    <span class="tag tag-success"><i class="icon-android-close"></i></span>
                <?php } ?>
            </td>
        </tr>
        <?php $i++; } ?>
    </tbody>
</table>

<?php print_r($links); ?>
