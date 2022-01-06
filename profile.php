<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";

    require_once CST_ROOT_URi . "/custodian.php";

    $obj = new Custodian();

    require_once 'pages/header.php'; 

    require_once 'pages/cust-template.php';
?>
<!-- Main Container -->
<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">Profile</h1>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    
    <div class="row">
        
    </div>
    
</main>
<!-- END Main Container -->
</div>
<?php require_once 'pages/footer.php'; ?>