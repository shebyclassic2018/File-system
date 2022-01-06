<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";

    require_once CST_ROOT_URi . "/custodian.php";

    $obj = new Custodian();

    require_once 'pages/header.php'; 

    require_once 'pages/cust-template.php'; 
    $pending_cert = $obj->std_certificates_folder();
    $approved_cert = $obj->std_certificates_folder('approved');

    $tot_pending_cert_folder = mysqli_num_rows($pending_cert);
    $tot_approved_cert_folder = mysqli_num_rows($approved_cert);
?>
<!-- Main Container -->
<main id="main-container">
    <?php
        if($tot_pending_cert_folder > 0) {
    ?>
    <div class="bg-body-light">
        <div class="content content-full content-heading">
            Pending certificates (<?=$tot_pending_cert_folder?>)
        </div>
    </div>
    <div class="grid-auto">
        <?php foreach ($pending_cert as $key => $row) { ?>
        <div class="pointer">
            <a href="open-certificate.php?uid=<?=$row['uid']?>"><div class="badge badge-danger"><?=$row['total']?></div><img src="image/cert.png" alt="" height="128px"></a>
            <a href="open-certificate.php?uid=<?=$row['uid']?>">
                <div class="flex-center"><?= $row['regno'] ?></div>
            </a>
        </div>
        <?php } ?>
    </div>
    <?php } ?>


    <?php
        if($tot_approved_cert_folder > 0) {
    ?>
    <div class="bg-body-light">
        <div class="content content-full content-heading">
            approved certificates (<?=$tot_approved_cert_folder?>)
        </div>
    </div>
    <div class="grid-auto">
        <?php foreach ($approved_cert as $key => $row) { ?>
        <div class="pointer">
            <a href="open-certificate.php?uid=<?=$row['uid']?>"><img src="image/cert.png" alt="" height="128px"></a>
            <a href="open-certificate.php?uid=<?=$row['uid']?>">
                <div class="flex-center"><?= $row['regno'] ?></div>
            </a>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    </div>
</main>
<!-- END Main Container -->
</div>
<?php require_once 'pages/footer.php'; ?>