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
                        <h1 class="font-w600 text-white mb-0 invisible" data-toggle="appear">New user</h1>
                        <h2 class="h4 font-w400 text-white-75 mb-0 invisible" data-toggle="appear" data-timeout="250">
                            Custodian</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    



    <!-- Dynamic Table with Export Buttons -->
    <div class="block">
    <?php if(isset($_SESSION['success'])) { ?>
        <div class="alert alert-success"><?=$_SESSION['success']?></div>
        <?php $_SESSION['success'] = null; } else if (isset($_SESSION['danger'])) {?>
        <div class="alert alert-danger"><?=$_SESSION['danger']?></div>
        <?php $_SESSION['danger'] = null; } ?>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <div class="flex bg-333 pad-8">
                <a href="new-user.php" class="flex-1 flex-center txt-ddd">New custodian</a>
                <a href="new-staff-form.php" class="flex-1 flex-center txt-ddd">New staff</a>
                <a href="new-admin-form.php" class="flex-1 flex-center txt-ddd">New administrator</a>
            </div>

            <form action="backend/new-user.php?user=custodian" class="pad-15" method="POST">
                <div class="row">
                    <div class="col-xs-12">Fill the fields below</div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-md-2 ">First name</div>
                    <div class="col-xs-12 col-md-2"><input type="text" name="fname" class="form-control"></div>
                    <div class="col-xs-12 col-md-2">Middle name</div>
                    <div class="col-xs-12 col-md-2 "><input type="text" name="mname" class="form-control"></div>
                    <div class="col-xs-12 col-md-2">Last name</div>
                    <div class="col-xs-12 col-md-2 "><input type="text" name="lname" class="form-control"></div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-md-2 ">Date of birth</div>
                    <div class="col-xs-12 col-md-2"><input type="date" name="dob" class="form-control"></div>
                    <div class="col-xs-12 col-md-2">Marital status</div>
                    <div class="col-xs-12 col-md-2 ">
                        <select name="marital_status" id="" class="form-control">
                            <option value="none">--Choose--</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                        </select>
                    </div>

                    
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-md-2 ">Phone</div>
                    <div class="col-xs-12 col-md-2"><input type="text" name="phone" class="form-control"></div>
                    <div class="col-xs-12 col-md-2">Gender</div>
                    <div class="col-xs-12 col-md-2 ">
                        <select name="sex" id="" class="form-control">
                            <option value="none">--Choose--</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-2 ">Email</div>
                    <div class="col-xs-12 col-md-2"><input type="email" name="email" class="form-control"></div>
                </div>
                <div class="row ">
                    <div class="col-md-10 "></div>
                    <div class="col-md-2 "><button class="btn btn-blue form-control">Register</button></div>         
                </div>
            </form>
        </div>
    </div>
    <!-- END Dynamic Table with Export Buttons -->
    </div>
</main>
<!-- END Main Container -->
</div>
<?php require_once 'pages/footer.php'; ?>