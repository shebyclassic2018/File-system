<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "file_system/config.php";
    require_once STD_ROOT_URi . "/student.php";
    

    $obj = new Student();

    // $obj->dd($obj->std_documents());exit;

    require_once 'pages/header.php';

    require_once 'pages/std-template.php'; 
?>

<!-- Main Container -->
<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                   <i class="si si-folder"></i> My file
                </h1>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <div class="page-content">
        <!-- Dynamic Table with Export Buttons -->
        <div class="block">
            <div class="block-header">
                <h3 class="block-title"><small>File content(s).</small></h3>
            </div>
            
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
               <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter js-dataTable">
                    <thead>
                        <tr>
                            <th class="text-center"  style="width: 80px;">#</th>
                            <th align=center style="width: 10%;">Date</th>
                            <th style="width: 10%;">Subject</th>
                            <th style="width: 30%;">Description</th>
                            <th style="width: 10%;">Attachment</th>
                            <th class="d-sm-table-cell" style="width: 80px;">Folio</th>
                            <th class="d-sm-table-cell" style="width: 10%;">Status</th>
                            <th class="d-sm-table-cell" style="width: 80px;">Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($obj->std_documents() as $key => $row) { ?>

                        <tr>
                            <td class="text-center font-size-sm"><?=$i?></td>
                            <td class="font-w600 font-size-sm" align=center>
                                <a href="be_pages_generic_blank.html"><?= $obj->date_format($row['day'],$row['month'], $row['year']) ?></a>
                            </td>
                            <td class="d-sm-table-cell font-size-sm"><?=$row['subject']?></td>
                            <td class="d-sm-table-cell font-size-sm"><?=$row['descript']?></td>
                            <td class="d-sm-table-cell font-size-sm text-center"><a href="attachment.php?doc=<?=$row['folio']?>"><span class="fa fa-paperclip"></span></a></td>
                            <td class="d-sm-table-cell" align=center><?=$row['folio']?></td>
                            <td align=right><em class="text-muted font-size-sm"><?=$row['status']?></em></td>
                            <td align=center><a href="progress.php?doc=<?=$row['folio']?>"><span class="fa fa-eye"></span></a></td>
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