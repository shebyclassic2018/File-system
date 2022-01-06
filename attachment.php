<?php 
 require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";

 require_once STD_ROOT_URi . "/student.php";
require_once 'pages/header.php'; 

$obj = new Student();
$doc_id = $_GET['doc'];

$stmt = "SELECT name,subject,status,a.id as id, type, created_at FROM attachment a, docs d WHERE a.doc_id = d.id AND d.id = '$doc_id'";
$data = $conn->query($stmt);

?>
<?php require_once 'pages/std-template.php'; ?>
<!-- Main Container -->
<main id="main-container">
    <!-- Hero -->

    <div class="bg-body-black">
        <div class="content content-full">
            <div class="content-heading"><span class="fa fa-paperclip"></span> ATTACHMENTS</div>
        </div>
    </div>
    <div class="" style="background: white;">
        <div class="content content-full">
            <div class="flex-center"><img src="image/logo/logo.jpg" height=100 width=100 alt=""></div>
            <h2 class="text-center">Folio : <?=$_GET['doc']?></h2>
            <h5 class="text-center text-muted"><?=$obj->getDocSubject($doc_id)?></h5>
        </div>
    </div>
    <!-- Dynamic Table with Export Buttons -->
    <div class="block">

        <div class="block-content block-content-full">
            <div class="grid-auto">
                <?php foreach($data as $key => $row) { ?>
                <div class="col-md-6 col-lg-4 col-xl-3 ">
                    <div class="options-container ">
                        <?php if (explode("/", $row['type'])[0] == 'image') {?>
                        <img class="options-item" src="backend/documents/request/<?=$row['name']?>" alt="" height=200px
                            width="100%">
                        <div class="p-2 bg-black-75">
                            <div class="o">
                                <h3 class="h4 font-w400 text-white mb-1"><?=$row['name']?></h3>
                                <h4 class="h6 font-w400 text-white-75 mb-3"><?=$row['status']?></h4>
                                <a class="btn btn-sm btn-primary img-lightbox" data-toggle="modal"
                                    data-target="#cert-<?=$row['id']?>">
                                    <i class="fa fa-search-plus mr-1"></i> View
                                </a>
                            </div>
                        </div>
                        <?php } else { ?>
                            <img class="options-item" src="image/other.svg" alt="" height=200px
                            width="100%">
                        <div class="p-2 bg-black-75">
                            <div class="o">
                                <h3 class="h4 font-w400 text-white mb-1"><?=$row['name']?></h3>
                                <h4 class="h6 font-w400 text-white-75 mb-3"><?=$row['status']?></h4>
                                <a class="btn btn-sm btn-primary" href="backend/documents/request/<?=$row['name']?>">
                                    <i class="fa fa-search-plus mr-1"></i> View
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Message Modal -->
    <?php foreach($data as $key => $row) { ?>

    <div class="modal fade" id="cert-<?=$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="one-inbox-message"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title"><?=$row['subject']?></h3>
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
                        <span class="text-muted"><em><b><?=$row['status']?></b></em></span>
                    </div>
                    <div class="block-content">
                        <div class="row gutters-tiny items-push js-gallery push">
                            <div class="col-md-12 col-lg-12 col-xl-12 animated fadeIn">
                                <div class="options-container flex-center">
                                    <img class="img-fluid options-item" src="backend/documents/request/<?=$row['name']?>">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php } ?>
    <!-- END Message Modal -->
    <!-- END Dynamic Table with Export Buttons -->
    </div>
</main>
<!-- END Main Container -->
</div>
<?php require_once 'pages/footer.php'; ?>