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
                        <h1 class="font-w600 text-white mb-0 invisible" data-toggle="appear">Dashboard</h1>
                        <h2 class="h4 font-w400 text-white-75 mb-0 invisible" data-toggle="appear" data-timeout="250">
                            Welcome Administrator</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    <div class="content">
        <!-- Quick Overview -->

        <?php if(isset($_SESSION['success'])) { ?>
        <div class="alert alert-success"><?=$_SESSION['success']?></div>
        <?php $_SESSION['success'] = null; } else if (isset($_SESSION['danger'])) {?>
        <div class="alert alert-danger"><?=$_SESSION['danger']?></div>
        <?php $_SESSION['danger'] = null; } ?>

        <div class="row">
            <div class="col-6 col-lg-4">
                <a class="block block-link-shadow text-center" href="dashboard.php">
                    <div class="block-content block-content-full">
                        <div class="font-size-h2 text-primary"><?=$obj->count('faculty')?></div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Faculty
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-4">
                <a class="block block-link-shadow text-center" href="department.php">
                    <div class="block-content block-content-full">
                        <div class="font-size-h2 text-success"><?=$obj->count('department')?></div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Department
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-4">
                <a class="block block-link-shadow text-center" href="programme.php">
                    <div class="block-content block-content-full">
                        <div class="font-size-h2 text-dark"><?=$obj->count('programme')?></div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Programme
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <!-- END Quick Overview -->
    </div>



    <div class="block pad-lr-15" width="100%">
        <form method="POST" action="backend/add-faculty.php" class="row">
            <div class="col-md-7"><span class="txt-muted">Add new faculty</span></div>
            <div class="col-md-2">
                <label for="pid">Faculty</label>
                <input class="form-control" type="text" id="pid" name="faculty">
            </div>
            <div class="col-md-2">
                <label for="text">Abbreviation</label>
                <input class="form-control" type="text" id="qty" name="abbr">
            </div>
            <div class="col-md-1 ">
                <label for="rdate" style="color:white;">-</label>
                <button class="form-control btn btn-blue"><span class="fa fa-save"></span></button>
            </div>
        </form>
    </div>

    <!-- Hero -->
    <div class="bg-body-black">
        <div class="content content-full">
            <div class="content-heading"><span class="fa fa-list"></span> REGISTERED FACULTIES</div>
        </div>
    </div>

    <!-- Dynamic Table with Export Buttons -->
    <div class="block">
        <div class="alert alert-warning"><b>NOTE:</b><br>Once you delete a faculty will also delete the departments and
            programmes relates to it</div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">#</th>
                            <th class="d-sm-table-cell" style="width: 10%;">Registered at</th>
                            <th class="d-sm-table-cell">Faculty</th>
                            <th class="d-sm-table-cell">Abbreviation</th>
                            <th class="d-sm-table-cell" style="width: 5%;">Department</th>
                            <th>Programme</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($obj->getFaculty() as $key => $row) { ?>
                        <tr>
                            <td class="text-center font-size-sm"><?=$i?></td>
                            <td class="font-w600 font-size-sm">
                                <a href="be_pages_generic_blank.html"><?=$row['created_at']?></a>
                            </td>
                            <td class="d-sm-table-cell font-size-sm">
                                <?=$row['name']?>
                            </td>
                            <td class="d-sm-table-cell">
                                <?=$row['abbr']?>
                            </td>
                            <td class="text-center">
                                <a href=""><?=$obj->countDepartmentFacultyId($row['id'])?></a>
                            </td>
                            <td class="text-center">
                                <a href=""><?=$obj->countProgrammeFacultyId($row['id'])?></a>
                            </td>


                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="delete-faculty.php?id=<?=$row['id']?>" class="btn btn-sm "
                                        data-toggle="tooltip" title="One tap delete" style="background: transparent">
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