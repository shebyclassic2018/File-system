<?php 
 require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";

 require_once STD_ROOT_URi . "/student.php";
require_once 'pages/header.php'; 

$obj = new Student();
$doc_id = $_GET['doc'];

?>
<?php require_once 'pages/std-template.php'; ?>
<!-- Main Container -->
<main id="main-container" style="">
    <!-- Hero -->
    
    <div class="bg-body-black">
        <div class="content content-full">
            <div class="content-heading"><span class="fa fa-spinner"></span> DOCUMENT PROGRESS</div>
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
            <div class="table-responsive">
            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th class="d-none d-sm-table-cell">Transferred at</th>
                        <th class="d-none d-sm-table-cell">Sender ID</th>
                        <th class="d-none d-sm-table-cell">Sender</th>
                        <th class="d-none d-sm-table-cell">Recipient</th>
                        <th class="d-none d-sm-table-cell" >Faculty</th>
                        <th>Department</th>
                        <th>Short notes</th>
                        <th style="width: 7%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($obj->progress($doc_id) as $key => $row) { ?>
                    <tr>
                        <td class="text-center font-size-sm"><?=$i?></td>
                        <td class="font-w600 font-size-sm">
                            <a href="be_pages_generic_blank.html"><?=$row['date_at']?></a>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm " style="display: flex">
                            <b><?=$row['regno']?></b>
                        </td>
                        <td class="d-none d-sm-table-cell"><em class="text-muted font-size-sm"><?=$obj->srroleodes($row['sender_id'])?></em></td>
                        <td><em class="text-muted font-size-sm"><?=$obj->designation($row['recipient_id'])?></em></td>
                        <td><em class="text-muted font-size-sm"><?=$obj->getFacultyByDepId($row['dep_id'])?></em></td>
                        <td><em class="text-muted font-size-sm"><?=$row['dp_name']?> (<?=$row['dp_abbr']?>)</em></td>
                        <td><?=$row['short_note']?></td>
                        <td><em class="text-muted font-size-sm"><?=$row['tstatus']?></em></td>
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