<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";

    require_once CST_ROOT_URi . "/custodian.php";

    $obj = new Custodian();

    $user_id = $_GET['uid'];
    foreach($obj->std_info($user_id) as $key => $row){}

    $certificates = $obj->getCertificate($user_id);
    
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

    <div class="content">

        <!-- Advanced Gallery -->
        <h2 class="content-heading">certificates</h2>
        <?php if(isset($_COOKIE['alert']) != null) { ?>
        <h3 class="content-heading"><?=$_COOKIE['alert']?></h3>
        <?php } ?>
        <div class="row gutters-tiny items-push js-gallery push">
            <?php foreach($certificates as $key => $row) { ?>
            <div class="col-md-6 col-lg-4 col-xl-3 ">
                <div class="options-container ">
                    <img class="options-item" src="image/certificate/<?=$row['cert_name']?>" alt="" height=200px
                        width="100%">
                    <div class="p-2 bg-black-75">
                        <div class="o">
                            <h3 class="h4 font-w400 text-white mb-1"><?=$row['cert_type']?> Certificate</h3>
                            <h4 class="h6 font-w400 text-white-75 mb-3"><?=$row['status']?></h4>
                            <a class="btn btn-sm btn-primary img-lightbox" href="assets/media/photos/photo17@2x.jpg"
                                data-toggle="modal" data-target="#cert-<?=$row['cid']?>">
                                <i class="fa fa-search-plus mr-1"></i> View
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- END Advanced Gallery -->

        <!-- Message Modal -->
        <?php foreach($certificates as $key => $row) { ?>

        <div class="modal fade" id="cert-<?=$row['cid']?>" tabindex="-1" role="dialog"
            aria-labelledby="one-inbox-message" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-popout" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title"><?=$row['cert_type']?> Certificate</h3>
                            <div class="block-options">

                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="block-content block-content-full text-center bg-image">
                            <img class="img-avaar img-avatar96 img-avatar-thum" height="128" width=128
                                src="image/logo/logo.jpg" alt="">
                        </div>
                        <div
                            class="block-content block-content-full font-size-sm d-flex justify-content-between bg-body-light">
                            <a href="javascript:void(0)"><?= $row['created_at'] ?></a>
                            <span class="text-muted"><em><b><?=$row['status']?></b> - 2 min ago</em></span>
                        </div>
                        <div class="block-content">
                            <div class="row gutters-tiny items-push js-gallery push">
                                <div class="col-md-12 col-lg-12 col-xl-12 animated fadeIn">
                                    <div class="options-container flex-center">
                                        <img class="img-fluid options-item"
                                            src="image/certificate/<?=$row['cert_name']?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content bg-body-light">
                            <div class="foward-button flex" style="padding-bottom: 10px">
                                <div class="flex-1"></div>
                                <?php if($row['status'] != 'Rejected') { ?>
                                <button class="btn btn-red reject-btn" value="<?=$row['cid']?>"><span
                                        class="fa fa-times"></span>
                                    Reject</button>&nbsp;&nbsp;
                                <?php } ?>
                                <?php if($row['status'] != 'Approved') { ?>
                                <button class="btn btn-blue approve-btn" value="<?=$row['cid']?>"><span
                                        class="fa fa-check"></span> Approve</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>
        <!-- END Message Modal -->
    </div>
    <!-- END Page Content -->

</main>
<!-- END Main Container -->
</div>
<?php require_once 'pages/footer.php'; ?>