<?php require_once 'pages/header.php'; ?>
<?php require_once 'pages/staff-template.php'; ?>
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
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                    <thead>
                        <tr>
                            <th class="text-center"  style="width: 80px;">#</th>
                            <th align=center style="width: 15%;">Date</th>
                            <th style="width: 15%;">Request Type</th>
                            <th>Description</th>
                            <th class="d-none d-sm-table-cell" style="width: 80px;">Folio</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th>
                            <th class="d-none d-sm-table-cell" style="width: 80px;">Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for($i = 1; $i < 9; $i++){
                       ?>

                        <tr>
                            <td class="text-center font-size-sm"><?=$i?></td>
                            <td class="font-w600 font-size-sm" align=center>
                                <a href="be_pages_generic_blank.html">20-09-2021</a>
                            </td>
                            <td class="d-none d-sm-table-cell font-size-sm">
                            Safari
                            </td>
                            <td class="d-none d-sm-table-cell font-size-sm">
                            Hello boss! ... i'm requesting for ....
                            </td>
                            <td class="d-none d-sm-table-cell" align=center>
                            <?=$i+10?>
                            </td>
                            <td align=right>
                                <em class="text-muted font-size-sm">Read - 7 days ago</em>
                            </td>
                            <td align=center>
                                <a href="">More</a>
                            </td>
                        </tr>

                        <?php
                            }
                       ?>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
</main>
<!-- END Main Container -->
</div>
<?php require_once 'pages/footer.php'; ?>