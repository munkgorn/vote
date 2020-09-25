
    <div id="main-wrapper">
        <?php require_once('common/menu.php'); ?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">จัดการวาระการสรรหา</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">จัดการวาระการสรรหา</li>
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
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ลำดับที่</th>
                                                <th>วาระการสรรหา</th>
                                                <th>ตำแหน่ง</th>
                                                <th>ชุดที่</th>
                                                <th>ปีบัญชีที่</th>
                                                <th>ครั้งที่</th>
                                                <th>สถานะ</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>สรรหาคณะกรรมการดำเนินการ</td>
                                                <td>ประธานกรรมการ, กรรมการดำเนินการ</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>Open</td>
                                                <td>
                                                    <button class="btn btn-warning" data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-default" data-toggle="modal" data-target="#view"><i class="fa fa-eye"></i></button>
                                                    <button class="btn btn-info"><i class="fa fa-cogs"></i></button>
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>สรรหาคณะกรรมการดำเนินการ</td>
                                                <td>ประธานกรรมการ</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>Open</td>
                                                <td>
                                                    <button class="btn btn-default" data-toggle="modal" data-target="#view"><i class="fa fa-eye"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td>สรรหาคณะกรรมการดำเนินการ</td>
                                                <td>กรรมการดำเนินการ</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>Open</td>
                                                <td>
                                                    <button class="btn btn-default" data-toggle="modal" data-target="#view"><i class="fa fa-eye"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">4</td>
                                                <td>สรรหาคณะกรรมการดำเนินการ</td>
                                                <td>ผู้ตรวจสอบกิจการ</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>Open</td>
                                                <td>
                                                    <button class="btn btn-default" data-toggle="modal" data-target="#view"><i class="fa fa-eye"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">5</td>
                                                <td>สรรหาคณะกรรมการดำเนินการ</td>
                                                <td>กรรมการดำเนินการ</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>Open</td>
                                                <td>
                                                    <button class="btn btn-default" data-toggle="modal" data-target="#view"><i class="fa fa-eye"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">6</td>
                                                <td>สรรหาคณะกรรมการดำเนินการ</td>
                                                <td>ผู้ตรวจสอบกิจการ</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>Open</td>
                                                <td>
                                                    <button class="btn btn-default" data-toggle="modal" data-target="#view"><i class="fa fa-eye"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">ลำดับที่</th>
                                                <th>วาระการสรรหา</th>
                                                <th>ตำแหน่ง</th>
                                                <th>ชุดที่</th>
                                                <th>ปีบัญชีที่</th>
                                                <th>ครั้งที่</th>
                                                <th>สถานะ</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer> -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document ">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">ลบข้อมูล</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>ยืนยันการลบ</p>
                        </div>
                        <div class="col-12 text-right">
                            <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">ยกเลิก</button>
                            <button class="btn btn-danger">ยืนยัน</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document ">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="exampleModalLabel">จัดการวาระการสรรหา</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>ดึงหน้าสร้างวาระสรรหา</p>
                        </div>
                        <div class="col-12 text-right">
                            <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">ยกเลิก</button>
                            <button class="btn btn-danger">ยืนยัน</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document ">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="exampleModalLabel">จัดการวาระการสรรหา</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>ดึงหน้าสร้างวาระสรรหา</p>
                        </div>
                        <div class="col-12 text-right">
                            <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">ยกเลิก</button>
                            <button class="btn btn-danger">ยืนยัน</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>