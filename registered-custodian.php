<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";
    require_once FS_ROOT_URi . "/fs.php";
    $obj = new fs();
?>
<?php require_once 'pages/header.php'; ?>
<?php require_once 'pages/admin-template.php'; ?>
<!-- Main Container -->
<main id="main-container">
    <!-- Hero -->
    <div class="bg-image overflow-hidden" style="background-image: url('assets/media/photos/photo3@2x.jpg');">
        <div class="bg-primary-dark-op">
            <div class="content content-narrow content-full">
                <div
                    class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-5 mb-2 text-center text-sm-left">
                    <div class="flex-sm-fill">
                        <h1 class="font-w600 text-white mb-0 invisible" data-toggle="appear">Registered user</h1>
                        <h2 class="h4 font-w400 text-white-75 mb-0 invisible" data-toggle="appear" data-timeout="250">
                             CUSTODIANS OF REGISTRY</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    <div class="content">
        <!-- Stats -->
        <div class="row">
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x"
                    href="registered-students.php">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Students</div>
                        <div class="font-size-h2 font-w400 text-dark"><?=$obj->userByRole('student')?></div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x"
                    href="registered-custodian.php">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Custodian of registry</div>
                        <div class="font-size-h2 font-w400 text-dark"><?=$obj->userByRole('custodian')?></div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x"
                    href="registered-staff.php">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Staff</div>
                        <div class="font-size-h2 font-w400 text-dark"><?=$obj->userByRole('staff')?></div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x"
                    href="registered-admin.php">
                    <div class="block-content block-content-full">
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Administrator</div>
                        <div class="font-size-h2 font-w400 text-dark"><?=$obj->userByRole('admin')?></div>
                    </div>
                </a>
            </div>
        </div>
        <!-- END Stats -->
    </div>



    <!-- Dynamic Table with Export Buttons -->
    <div class="block">
    <?php if(isset($_SESSION['success'])) { ?>
        <div class="alert alert-success"><?=$_SESSION['success']?></div>
        <?php $_SESSION['success'] = null; } else if (isset($_SESSION['danger'])) {?>
        <div class="alert alert-danger"><?=$_SESSION['danger']?></div>
        <?php $_SESSION['danger'] = null; } ?>
        <div class="block-content block-content-full">
        <div class="table-responsive">
            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px;">#</th>
                        <th class="d-sm-table-cell">Student Name</th>
                        <th class="d-sm-table-cell">Marital status</th>
                        <th>Sex</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Date of birth</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach($obj->getUserInfo('custodian') as $key => $row) { ?>
                    <tr>
                        <td class="text-center font-size-sm"><?=$i?></td>
                        <td class="d-sm-table-cell font-size-sm">
                            <?=$row['username']?>
                        </td>
                        <td class="d-sm-table-cell">
                            <?=$row['marital']?>
                        </td>
                        <td class="text-center">
                        <?=$row['sex']?>
                        </td>
                        <td class="text-center">
                        <?=$row['phone_number']?>
                        </td>
                        <td>
                        <?=$row['email']?>
                        </td>
                        <td class="text-center">
                        <?=$row['dob']?> 
                        </td>

                        <td class="text-center">
                            <div class="btn-group">
                            <a href="delete-user.php?id=<?=$row['uid']?>&type=custodian" class="btn btn-sm " data-toggle="tooltip" title="One tap delete"
                                    style="background: transparent">
                                    <i class="fa fa-fw fa-times"></i>
                                </a>
                            </div>
                        </td>

                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <!-- END Dynamic Table with Export Buttons -->
    </div>
</main>
<!-- END Main Container -->
</div>
<?php require_once 'pages/footer.php'; ?>