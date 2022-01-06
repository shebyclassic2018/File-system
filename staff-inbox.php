<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";

    require_once STF_ROOT_URi . "/staff.php";

    $obj = new staffController();    
    $dep_id = $_SESSION['dep_id'];
    $designation = $_SESSION['designation'];

 
    require_once 'pages/header.php'; 

    require_once 'pages/cust-template.php'; 
?>
<!-- Main Container -->
<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-dark">

    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="pad-15 content-heading">INBOX - <?=$_SESSION['designation']?></div>
        <?php if(isset($_SESSION['success'])) { ?>
        <div class="alert alert-success"><?=$_SESSION['success']?></div>
        <?php $_SESSION['success'] = null; } else if (isset($_SESSION['danger'])) {?>
        <div class="alert alert-danger"><?=$_SESSION['danger']?></div>
        <?php $_SESSION['danger'] = null; } ?>
        <div class="row">

            <div class="col-xl-12">
                <!-- Message List -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            15-30 <span class="font-w400 text-lowercase">from</span> 700
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="left"
                                title="Previous 15 Messages">
                                <i class="si si-arrow-left"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="left"
                                title="Next 15 Messages">
                                <i class="si si-arrow-right"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="fullscreen_toggle"></button>
                        </div>
                    </div>
                    <div class="block-content">

                        <!-- Messages and Checkable Table (.js-table-checkable class is initialized in Helpers.tableToolsCheckable()) -->
                        <div class="pull-x">
                            <table class="js-table-checkable table table-hover table-vcenter font-size-sm">
                                <tbody>
                                    <?php
                                        foreach($obj->inbox($designation, $dep_id) as $key => $row) {
                                    ?>
                                    <tr>
                                        <td class="text-center" style="width: 60px;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="inbox-msg15-<?=$row['_index']?>" name="inbox-msg15">
                                                <label class="custom-control-label font-w400"
                                                    for="inbox-msg15-<?=$row['_index']?>"></label>
                                            </div>
                                        </td>
                                        <td class="d-sm-table-cell font-w600" style="width: 140px;">
                                            <?= $row['date_at'] ?>
                                        </td>
                                        <td data-toggle="modal" data-target="#inbox-message-<?=$row['_index']?>">
                                            <a class="font-w600" data-toggle="modal"
                                                data-target="#inbox-message-<?=$row['name']?>"
                                                href="#"><?=$row['sender_name']?></a>
                                            <div class="text-muted mt-1"><?=$row['subject']?></div>
                                        </td>
                                        <td class="d-xl-table-cell text-muted" style="width: 80px;">
                                            <i class="fa fa-paperclip mr-1"></i> (3)
                                        </td>
                                        <td class="d-xl-table-cell text-muted" style="width: 120px;">
                                            <em> <?= $row['time_at'] ?></em>
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
            foreach($obj->inbox($designation, $dep_id) as $key => $inbox) {
        ?>

        <div class="modal fade" id="inbox-message-<?=$inbox['_index']?>" tabindex="-1" role="dialog"
            aria-labelledby="one-inbox-message" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-popout" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title"><?=$inbox['subject']?></h3>
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
                            <a href="javascript:void(0)"><?= $inbox['date_at'] ?></a>
                            <span class="text-muted"><em><?= $inbox['time_at'] ?></em></span>
                        </div>
                        <div class="block-content">
                            <?=$inbox['doc_descript']?>
                        </div>
                        <div class="block-content bg-body-light">
                            <div class="grid-auto gutters-tiny items-push font-size-sm">

                                <?php
                                $rows = 1;
                                $tot_attachs = mysqli_num_rows($obj->doc_attachment($inbox['doc_id']));
                                foreach($obj->doc_attachment($inbox['doc_id']) as $key => $row) {
                                if($row['type'] == 'application/pdf') {
                            ?>
                                <div class="col-md-12">
                                    <div class="options-container fx-item-zoom-in mb-2">
                                        <a href="<?=SERVER_URi?>/backend/documents/request/<?=$row['name']?>"><img
                                                class="img-fluid options-item" src="image/pdf2.png" alt="" width=128
                                                height=128></a>
                                    </div>
                                    <div class="text-muted"><a
                                            href="<?=SERVER_URi?>/backend/documents/request/<?=$row['name']?>"><?=$row['name']?></a>
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
                            <form method="POST" action="js_pages/approval.php"
                                class="block-content block-content-full forwad-form">
                                <input type="hidden" name="doc_id" value="<?=$inbox['doc_id']?>">
                                <div class="short-notes">
                                    <label for="shn">Approval/Reject Description (Optional)</label>
                                    <textarea name="short-notes" id="snotes" cols="30" rows="5"
                                        class="form-control"></textarea>
                                </div><br>
                                <input type="hidden" name="tid" value="<?=$inbox['_index']?>">
                                <div class="buttons flex">
                                    <div class="flex-1"></div>
                                    <?php if ($inbox['stat'] == 'Pending') { ?>
                                    <button name="reject" value="reject" class="btn btn-red"><span class="fa fa-times-circle"></span>
                                        Reject</button>&nbsp;&nbsp;
                                    <button name="approve" value="approve" class="btn btn-blue"><span class="fa fa-check-circle"></span>
                                        Approve</button>
                                    <?php } else if ($inbox['stat'] == 'Approved') {?>
                                    <button name="reject" value="reject" class="btn btn-red"><span class="fa fa-times-circle"></span>
                                        Reject</button>
                                    <?php } else { ?>
                                    <button name="approve" value="approve" class="btn btn-blue"><span class="fa fa-check-circle"></span>
                                        Approve</button>
                                    <?php } ?>
                                </div>
                            </form>
                            <form method="POST" action="js_pages/staff-forward.php"
                                class="block-content block-content-full forwad-form">
                                <input type="hidden" name="short-notes" id="snoteshidden">
                                <div class="underline">Forward</div><br>

                                <div class="flex">
                                    <div class="flex-center">To: </div> &nbsp; &nbsp;
                                    <select name="des" class="form-control">
                                        <option disabled selected value>-- Select Recipient --</option>
                                        <?php
                                        // ******************** Print data selected from designation model ***
                                        // ******************** This function implemented at fs.php **********
                                        // ******************** start of Designation Loop ********************
                                        foreach($obj->getDesignation() as $key => $des) { if($designation != $des['type']) {?>
                                        <option value="<?=$des['id']?>"><?= $des['type']?></option>
                                        <?php
                                        } }
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

                                <input type="hidden" name="doc_id" value="<?=$inbox['folio']?>">
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

<?php

