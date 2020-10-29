<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title"><?php echo $heading_title; ?></h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <?php foreach ($breadcrumbs as $key => $breadcrumb) { ?>
                            <li class="breadcrumb-item <?php echo $key==count($breadcrumbs)-1 ? 'active' : ''; ?>" aria-current="page">
                                <?php echo $key!=count($breadcrumbs)-1 ? '<a href="'.$breadcrumb['link'].'">' : ''; ?>
                                <?php echo $breadcrumb['name']; ?>
                                <?php echo $key!=count($breadcrumbs)-1 ? '</a>' : ''; ?>
                            </li>
                            <?php } ?>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">


                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a class="btn btn-info" id="exportExcel" href="" target="new"><i class="fas fa-file-excel"></i> EXPORT</a>
                            </div>
                            <div class="col-md-12 text-center">
                                <h3>รายงานแสดงจำนวนผู้มาลงคะแนน สรรหาคณะกรรมการดำเนินการ</h3>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered" id="tableMemberGroup">
                                    <thead>
                                        <tr>
                                            <th width="30%">กลุ่มเขต</th>
                                            <th>จำนวนผู้มีสิทธิทั้งหมด</th>
                                            <th>จำนวนผู้มาลงคะแนน</th>
                                            <th>จำนวนผู้ไม่มาลงคะแนน</th>
                                            <th>จำนวนผู้มาลงคะแนนคิดเป็นร้อยละ</th>
                                            <th>จำนวนผู้ไม่ออกเสียง</th>
                                            <th>จำนวนผู้ไม่ออกเสียง คิดเป็นร้อยละ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-center">รวม</td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">%</td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-md-12 text-right">
                                <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">ปิด</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>