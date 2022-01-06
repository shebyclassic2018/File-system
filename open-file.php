<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";

    require_once CST_ROOT_URi . "/custodian.php";

    $obj = new Custodian();
    foreach($obj->std_info($_GET['uid']) as $key => $row)
    
    require_once 'pages/header.php'; 
    require_once 'pages/cust-template.php'; 
?>
<!-- Main Container -->
<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-dark">
        <div class="content content-full">
            <table class="std-info">
                <tr>
                    <td><b>Student Name</b></td>
                    <td><?=$row['std_name']?></td>

                </tr>
                <tr>
                    <td><b>Registration Number</b></td>
                    <td><?=$row['regno']?></td>

                </tr>
                <tr>
                    <td><b>Programme</b></td>
                    <td><?=$row['prog_name']?> (<?=$row['prog_abbr']?>)</td>

                </tr>
                <tr>
                    <td><b>Department</b></td>
                    <td><?=$row['dep_name']?> (<?=$row['dep_abbr']?>)</td>
                </tr>
                <tr>
                    <td><b>Faculty</b></td>
                    <td><?=$row['fac_name']?> (<?=$row['fac_abbr']?>)</td>
                    <td><em>Email</em> </td>
                    <td><?=$row['email']?></td>
                </tr>
                <tr>
                    <td><b>Academic year</b></td>
                    <td><?=$row['dep_name']?></td>
                    <td><em>Phone</em> </td>
                    <td><?=$row['phone_number']?></td>
                </tr>
            </table>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <?php if(isset($_SESSION['success'])) { ?>
        <div class="alert alert-success"><?=$_SESSION['success']?></div>
        <?php $_SESSION['success'] = null; } else if (isset($_SESSION['danger'])) {?>
        <div class="alert alert-danger"><?=$_SESSION['danger']?></div>
        <?php $_SESSION['danger'] = null; } ?>
        <div class="row">

            <div class="col-xl-12">
                <!-- Message List -->
                <div class="block">

                    <div class="block-content">

                        <!-- Messages and Checkable Table (.js-table-checkable class is initialized in Helpers.tableToolsCheckable()) -->
                        <div class="pull-x">
                            <table class="js-table-checkable table table-hover table-vcenter font-size-sm">
                                <tbody>
                                    <?php
                                        foreach($obj->std_documents() as $key => $doc) {
                                    ?>
                                    <tr>
                                        <td class="text-center" style="width: 60px;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="inbox-msg15-<?=$doc['folio']?>" name="inbox-msg15">
                                                <label class="custom-control-label font-w400"
                                                    for="inbox-msg15-<?=$doc['folio']?>"></label>
                                            </div>
                                        </td>
                                        <td class="d-sm-table-cell font-w600" style="width: 140px;">
                                            <?= $obj->date_format($doc['day'],$doc['month'], $doc['year']) ?>
                                        </td>
                                        <td data-toggle="modal" data-target="#inbox-message-<?=$doc['folio']?>">
                                            <a class="font-w600" data-toggle="modal"
                                                data-target="#inbox-message-<?=$doc['folio']?>"
                                                href="#"><?=$doc['subject']?></a>
                                            <div class="text-muted mt-1"><?=$doc['descript']?></div>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- END Messages and Checkable Table -->
                    </div>
                </div>
                <!-- END Message List -->
            </div>
        </div>

        <!-- Message Modal -->
        <?php
            foreach($obj->std_documents() as $key => $doc) {
        ?>

        <div class="modal fade" id="inbox-message-<?=$doc['folio']?>" tabindex="-1" role="dialog"
            aria-labelledby="one-inbox-message" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-popout" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title"><?=$doc['subject']?></h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="tooltip"
                                    data-placement="left" title="Forward" aria-label="Reply">
                                    <i class="fa fa-fw fa-share"></i>
                                </button>
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="block-content block-content-full text-center bg-image" style="">
                            <img class="img-avaar img-avatar96 img-avatar-thum" height="128" width=128
                                src="image/logo/logo.jpg" alt="">
                        </div>
                        <div
                            class="block-content block-content-full font-size-sm d-flex justify-content-between bg-body-light">
                            <a
                                href="javascript:void(0)"><?= $obj->date_format($doc['day'],$doc['month'], $doc['year']) ?></a>
                            <span class="text-muted"><em>2 min ago</em></span>
                        </div>
                        <div class="block-content">
                            <?=$doc['descript']?>
                        </div>
                        <div class="block-content bg-body-light">
                            <div class="grid-auto gutters-tiny items-push font-size-sm">

                                <?php
                                $rows = 1;
                                $tot_attachs = mysqli_num_rows($obj->doc_attachment($doc['doc_id']));
                                foreach($obj->doc_attachment($doc['doc_id']) as $key => $row) {
                                if($row['type'] == 'application/pdf') {
                            ?>
                                <div class="col-md-12">
                                    <div class="options-container fx-item-zoom-in mb-2">
                                        <a href="backend/documents/request/<?=$row['name']?>"><img
                                                class="img-fluid options-item" src="image/pdf2.png" alt="" width=128
                                                height=128></a>
                                    </div>
                                    <div class="text-muted"><a
                                            href="backend/documents/request/<?=$row['name']?>"><?=$row['name']?></a>
                                    </div>
                                </div>
                                <?php
                                    } else {
                                ?>
                                <div class="col-md-12">
                                    <div class="options-container fx-item-zoom-in mb-2">
                                        <a href="backend/documents/request/<?=$row['name']?>"><img
                                                class="img-fluid options-item" src="image/picicon.png" alt="" width=128
                                                height=128></a>
                                    </div>
                                    <div class="text-muted"><a
                                            href="backend/documents/request/<?=$row['name']?>"><?=$row['name']?></a></a>
                                    </div>
                                </div>
                                <?php
                                    }
                                    $rows++;
                                }
                            ?>
                            </div>
                            <form method="POST" action="js_pages/forward-document.php"
                                class="block-content block-content-full forwad-form">
                                <div class="underline">Forward</div><br>
                                
                                <div class="flex">
                                    <div class="flex-center">To: </div> &nbsp; &nbsp;
                                    <select name="des" class="form-control">
                                        <option disabled selected value>-- Select Recipient --</option>
                                        <?php
                                        // ******************** Print data selected from designation model ***
                                        // ******************** This function implemented at fs.php **********
                                        // ******************** start of Designation Loop ********************
                                        foreach($obj->getDesignation() as $key => $des) { ?>
                                        <option value="<?=$des['id']?>"><?= $des['type']?></option>
                                        <?php
                                        }
                                        // ******************** END of Designation Loop **********************
                                    ?>
                                    </select>&nbsp; &nbsp;

                                    <select name="dep" class="form-control">
                                        <option disabled selected value>-- Select Department --</option>
                                        <?php
                                        // ******************** Print data selected from designation model ***
                                        // ******************** This function implemented at fs.php **********
                                        // ******************** start of Designation Loop ********************
                                        foreach($obj->getDepartment() as $key => $row) { ?>
                                        <option value="<?=$row['id']?>"><?= $row['name']?> (<?= $row['abbr']?>)</option>
                                        <?php
                                        }
                                        // ******************** END of Designation Loop **********************
                                    ?>
                                    </select>

                                </div>
                                <div class="short-notes">
                                    <label for="shn">Description (Optional)</label>
                                    <textarea name="short-notes" id="" cols="30" rows="5"
                                        class="form-control"></textarea>
                                </div><br>
                                <input type="hidden" name="doc_id" value="<?=$doc['folio']?>">
                                <input type="hidden" name="uid" value="<?=$_GET['uid']?>">
                                <div class="foward-button flex">
                                    <div class="flex-1"></div>
                                    <button class="btn btn-blue"><span class="fa fa-share"></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            }
        ?>
        <!-- END Message Modal -->

    </div>
    <!-- END Page Content -->

</main>
<!-- END Main Container -->
</div>
<?php require_once 'pages/footer.php'; ?>