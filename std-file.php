<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";

    require_once CST_ROOT_URi . "/custodian.php";

    $obj = new Custodian();
    $number_of_files = mysqli_num_rows($obj->student_files());

    require_once 'pages/header.php'; 

    require_once 'pages/cust-template.php';
?>
<!-- Main Container -->
<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Student files <small>(<em><?=$number_of_files?></em>)</small>
                </h1>
                <div><input type="search" name="search" id="search-file" class="form-control" placeholder="Search ...">
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->


    <div class="direct-fetch">
        <div class="grid-auto">
            <?php foreach ($obj->student_files() as $key => $row) { ?>
            <div class="pointer">
                <?php if ($obj->countPending($row['fid']) > 0) { ?>
                <div class="badge badge-danger folder-badge"><?=$obj->countPending($row['fid'])?></div>
                <?php } ?>
                <a href="open-file.php?uid=<?=$row['uid']?>"><img src="image/folder4.png" alt="" height="128px"></a>
                <a href="open-file.php?uid=<?=$row['uid']?>">
                    <div class="flex-center"><?= $row['regno'] ?></div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="searched-content">
        <input type="hidden" id="regno">
        <input type="hidden" id="uid">
        <input type="hidden" id="count">
        <div class="grid-auto searched-item">

        </div>
    </div>
</main>
<!-- END Main Container -->
</div>
<?php require_once 'pages/footer.php'; ?>