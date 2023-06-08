<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Manage User</h1>
    </div>
</div>
<div class="row">


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List of system user

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <span style="float:right;">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addUser" data-id="<?php echo $_SESSION['userid']; ?>" id="getadduser"><i class="fa fa-plus-square"></i>Add New</button>
                            </p>
                        </span>

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th width="5%">SN</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th width="5%">Permisions</th>
                                    <th width="5%">Edit</th>
                                    <th width="5%">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $sel = $db->getMembers();
                                while ($rows = $sel->fetch()) {
                                    $member_id = $rows['member_id'];
                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo strtoupper($rows['firstname'] . " " . $rows['lastname']); ?></td>
                                        <td><?php echo strtoupper($rows['gender']); ?></td>
                                        <td><?php echo $rows['phone']; ?></td>
                                        <td><?php echo strtolower($rows['email']); ?></td>
                                        <td>
                                            <?php
                                            if ($rows['level'] == 'All') {
                                                echo 'Administrator';
                                            } elseif ($rows['level'] == 'Facility') {
                                                $category = $rows['wp_category_id'];
                                                $wp_id = $rows['wp_id'];
                                                include 'lib/criteria_setting.php';
                                                echo $cat . ' (' . $wpname . ')';
                                            } else {
                                                echo "";
                                            }
                                            ?>
                                        </td>

                                        <td><a href="?pg=mngUser&userPermisionLevel=<?= $rows['level'] ?>&user_id=<?= $rows['user_id'] ?>" class="btn btn-success btn-xs">Manage&nbsp;Permisions</a></td>
                                        <td align="center">
                                            <a href="#editUser" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?= $rows['member_id'] ?>" id="getedituser"><i class="fa fa-edit"></i>Edit</a>
                                        </td>

                                        <td align="center"><a href="#deleteUser" class="btn btn-danger btn-xs" data-toggle="modal" data-id="<?php echo $member_id; ?>" id="getdeleteuser"><i class="fa fa-trash"></i>Delete</a>
                                        </td>

                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>


<!--DEFINING MODALS--->
<!--Module to Add New User -->
<div id="addUser" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New User:</h4>
            </div>
            <div class="modal-body">

                <div id="addUser-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--Module to Edit -->
<div id="editUser" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit User</h4>
            </div>
            <div class="modal-body">

                <div id="editUser-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Delete -->
<div id="deleteUser" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete User:</h4>
            </div>
            <div class="modal-body">

                <div id="deleteUser-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_GET['userPermisionLevel'])) { ?>

    <script src="js/jquery.min.js"></script>
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#permitUser').modal('show');
        });
    </script>



    <div id="permitUser" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="">Manage User Permisions:</h4>
                </div>
                <div class="modal-body">
                    <form action="includes/process.php">
                        <table class="table table-bordered">
                            <tr>
                                <th style="text-align: center;">
                                    LIST OF PERMISIONS
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label style='cursor:pointer;'>
                                        <input type='checkbox' id="select_all"> Select All
                                    </label>
                                </th>
                            </tr>
                            <?php
                            $user_id = $_GET['user_id'];
                            $user_level = $_GET['userPermisionLevel'];
                            $userPerm = $db->getUserPermisions($user_id, $user_level);
                            $perms = $userPerm->fetch();
                            $columns = $db->getPermisions($user_level);
                            foreach ($columns as $key => $col) {
                                if ($userPerm->rowCount() > 0) {
                                    $value = '';
                                    $keys = array_keys($perms);
                                    foreach ($keys as $key => $index) {
                                        if ($index == $col) {
                                            $value = $perms[$index];
                                            if ($value == 'YES') {
                                                $checked = 'checked';
                                            } else {
                                                $checked = '';
                                            }
                                        }
                                    }
                            ?>
                                    <tr>
                                        <td>
                                            <label style='font-weight:normal;cursor:pointer;'>
                                                <input type='checkbox' <?= $checked ?> class='column' name='permision[]' value='<?= $col ?>'> <?= ucwords(str_replace("_", " ", $col)); ?>
                                            </label>
                                        </td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td>
                                            <label style='font-weight:normal;cursor:pointer;'>
                                                <input type='checkbox' class='column' name='permision[]' value='<?= $col ?>'> <?= ucwords(str_replace("_", " ", $col)); ?>
                                            </label>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>

                            <tr>
                                <td style="text-align: right">
                                    <input type="hidden" name="save_permisions">
                                    <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                                    <input type="hidden" name="user_level" value="<?= $user_level; ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#select_all").click(function(e) {
            $(".column").not(this).prop('checked', this.checked);
        });
    </script>
<?php } ?>