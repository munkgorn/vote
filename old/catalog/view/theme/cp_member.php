
    <div id="main-wrapper">
        <?php require_once('common/menu.php'); ?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">จัดการสมาชิก</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
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
                                    <div class="col-9">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Upload file</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-right">
                                        <button class="btn btn-info"><i class="fas fa-paper-plane"></i> IMPORT ข้อมูล</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">ชื่อ</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">นามสกุล</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">เลขที่สมาชิก</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 text-right"><button class="btn btn-info">ค้นหา</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-right mb-5">
                        <button class="btn btn-success" data-toggle="modal" data-target="#Modal1"><i class="far fa-save"></i> เพิ่มสมาชิก</button>
                        <button class="btn btn-default"><i class="fas fa-file-excel"></i> EXPORT</button>
                        <button class="btn btn-default"><i class="fas fa-file-excel"></i> EXPORT ALL</button>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Basic Datatable</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ลำดับที่</th>
                                                <th>ชื่อ-นามสกุล</th>
                                                <th>หมายเลขสมาชิก</th>
                                                <th>จังหวัด</th>
                                                <th>สถานะ</th>
                                                <th>รายละเอียด</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>นาย คณิต เครือสถิตย์</td>
                                                <td>011401</td>
                                                <td>กรมการข้าว</td>
                                                <td>Active</td>
                                                <td>
                                                    <button class="btn btn-warning" data-toggle="modal" data-target="#Modal1"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-default" data-toggle="modal" data-target="#Modal2"><i class="fa fa-eye"></i></button>
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#Modal3"><i class="fa fa-key"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ลำดับที่</th>
                                                <th>ชื่อ-นามสกุล</th>
                                                <th>หมายเลขสมาชิก</th>
                                                <th>จังหวัด</th>
                                                <th>สถานะ</th>
                                                <th>รายละเอียด</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">แก้ไข</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true ">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>คำนำหน้าชื่อ</td>
                                                <td colspan="3">
                                                    <select name="" id="" class="form-control">
                                                        <option value="">จ.ท.</option>
                                                        <option value="">ว่าที่ ร.ต.</option>
                                                        <option value="">ว่าที่ ร.ท.</option>
                                                        <option value="">ว่าที่ ร.ต. หญิง</option>
                                                        <option value="">ว่าที่ ร.อ.</option>
                                                        <option value="">จ.ส.ต.</option>
                                                        <option value="">นาง</option>
                                                        <option value="">นางสาว</option>
                                                        <option value="">นาย</option>
                                                        <option value="">พ.จ.ต.</option>
                                                        <option value="">มรว.</option>
                                                        <option value="">รต.</option>
                                                        <option value="">ว่าที่ พ.ต.</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ชื่อ</td>
                                                <td><input type="text" class="form-control"></td>
                                                <td>นามสกุล</td>
                                                <td><input type="text" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>รหัสบัตรประชาชน</td>
                                                <td><input type="text" class="form-control" disabled></td>
                                                <td>สมาชิกเลขที่</td>
                                                <td><input type="text" class="form-control" disabled></td>
                                            </tr>
                                            <tr>
                                                <td>กลุ่มสมาชิก</td>
                                                <td>
                                                    <select name="" id="" class="form-control">
                                                        <option value="">กลุ่มสมาชิก</option>
                                                    </select>
                                                </td>
                                                <td>Email</td>
                                                <td><input type="text" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>วันเกิด</td>
                                                <td><input type="text" class="form-control"></td>
                                                <td>วันที่เป็นสมาชิกสหกรณ์</td>
                                                <td><input type="text" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>ประเภทสมาชิก</td>
                                                <td>
                                                    <select name="" id="" class="form-control">
                                                        <option value="">สมาชิก</option>
                                                    </select>
                                                </td>
                                                <td>เบอร์โทรศัพท์</td>
                                                <td><input type="text" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>สถานะ</td>
                                                <td colspan="3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            ใช้งาน
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            ไม่ใช้งาน
                                                        </label>
                                                    </div>
                                                </td>
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
            <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">เพิ่ม ข่าวสาร</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true ">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>คำนำหน้าชื่อ</td>
                                                <td colspan="3">นาย</td>
                                            </tr>
                                            <tr>
                                                <td>ชื่อ</td>
                                                <td>คณิต</td>
                                                <td>นามสกุล</td>
                                                <td>เครือสถิตย์</td>
                                            </tr>
                                            <tr>
                                                <td>รหัสบัตรประชาชน</td>
                                                <td>3100600067151</td>
                                                <td>สมาชิกเลขที่</td>
                                                <td>011401</td>
                                            </tr>
                                            <tr>
                                                <td>กลุ่มสมาชิก</td>
                                                <td>กรมการข้าว</td>
                                                <td>Email</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>วันเกิด</td>
                                                <td></td>
                                                <td>วันที่เป็นสมาชิกสหกรณ์</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>เบอร์โทรศัพท์</td>
                                                <td></td>
                                                <td>รหัสผ่าน</td>
                                                <td>8635</td>
                                            </tr>
                                            <tr>
                                                <td>สถานะ</td>
                                                <td colspan="3">Active</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-danger">ปิด</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" role="document ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true ">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button class="btn btn-default">ยกเลิก</button>
                                    <button class="btn btn-danger">บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>

