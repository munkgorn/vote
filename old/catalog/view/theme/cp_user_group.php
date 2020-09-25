    <link rel="stylesheet" type="text/css" href="lib/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <div id="main-wrapper">
        <?php require_once('common/menu.php'); ?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">ตั้งค่าประเภทผู้ใช้ระบบ</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">ตั้งค่าประเภทผู้ใช้ระบบ</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#Modal1">เพิ่มประเภทผู้ใช้ระบบ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ลำดับที่</th>
                                                <th>ประเภทผู้ใช้ระบบ</th>
                                                <th>ลบ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>admin</td>
                                                <td><button class="btn btn-danger" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i></button></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>สมาชิก</td>
                                                <td><button class="btn btn-danger" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i></button></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ลำดับที่</th>
                                                <th>ประเภทผู้ใช้ระบบ</th>
                                                <th>ลบ</th>
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
    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document ">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalLabel">เพิ่ม ประเภทผู้ใช้ระบบ</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="text-right">ประเภทผู้ใช้ระบบ</td>
                                        <td><input type="text" class="form-control"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-danger">ยกเลิก</button>
                            <button class="btn btn-default">บันทึก</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document ">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">ยืนยัน</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>คุณต้องการลบข้อมูลประเภทผู้ใช้ระบบ</p>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-danger">ยกเลิก</button>
                            <button class="btn btn-default">ตกลง</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="lib/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
    </script>