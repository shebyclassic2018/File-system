<?php require_once 'pages/header.php'; ?>
<?php require_once 'pages/std-template.php'; ?>
<!-- Main Container -->
<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Send request
                </h1>
            </div>
        </div>
    </div>
    <?php if(isset($_SESSION['success'])) { ?>
    <div class="alert alert-success"><?=$_SESSION['success']?></div>
    <?php $_SESSION['success'] = null; } else if (isset($_SESSION['danger'])) {?>
        <div class="alert alert-danger"><?=$_SESSION['danger']?></div>
    <?php $_SESSION['danger'] = null; } ?>
    <!-- END Hero -->
    <div class="block">
        <form method="post" action="backend/student/compose.php" enctype="multipart/form-data" class="block-content upload-content">
            <div>Subject</div>
            <div><input type="text" name="subject" class="form-control"></div><br>
            <div>Descriptions</div>
            <textarea name="description" id="js-ckeditor" cols="50" rows="5" class="form-control"></textarea><br>
            

            <input type="file" name="attachment" id="upload">
            <label for="upload" id="attach" class="btn"><span class="fa fa-paperclip"></span></label>
            <button type="submit" id="submit-btn"></button>
            <label for="submit-btn" class="btn btn-primary"><span class="fa fa-send"></span> Send</label>
            
        </div>
    </div>
</main>
<!-- END Main Container -->
</div>
<?php require_once 'pages/footer.php'; ?>