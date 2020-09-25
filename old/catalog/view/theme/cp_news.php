
    <div id="main-wrapper">
        <?php require_once('common/menu.php'); ?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">จัดการข่าวสาร</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">จัดการข่าวสาร</li>
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
                                <div class="text-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal1"><i class="fa fa-save"></i> เพิ่มข่าวสาร</button></div>
                                <hr>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ลำดับที่</th>
                                                <th>หัวข้อข่าว</th>
                                                <th>ประเภทข่าว</th>
                                                <th>ความสำคัญข่าว</th>
                                                <th>วันที่แสดงผล</th>
                                                <th>วันที่สิ้นสุด</th>
                                                <th>รายละเอียด</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Lorem ipsum dolor sit amet</td>
                                                <td>ข่าวประกาศ</td>
                                                <td>ด่วน</td>
                                                <td>2012-12-08T00:00:00</td>
                                                <td>1982-05-06T23:59:59</td>
                                                <td>
                                                    <button class="btn btn-warning" data-toggle="modal" data-target="#edit" data-id=""><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#view" data-id=""><i class="fa fa-eye"></i></button>
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#delete" data-id=""><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ลำดับที่</th>
                                                <th>หัวข้อข่าว</th>
                                                <th>ประเภทข่าว</th>
                                                <th>ความสำคัญข่าว</th>
                                                <th>วันที่แสดงผล</th>
                                                <th>วันที่สิ้นสุด</th>
                                                <th>รายละเอียด</th>
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
    </div>
    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
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
                                        <td>หัวข้อข่าว</td>
                                        <td><input type="text" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>ข้อมูลข่าว</td>
                                        <td><textarea name="" id="" cols="30" rows="5" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>ประเภทข่าว</td>
                                        <td>
                                            <select name="" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="">ข่าวประกาศ</option>
                                                <option value="">ข่าวรับสมัคร</option>
                                                <option value="">ข่าวลงคะแนน</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ความสำคัญข่าว</td>
                                        <td>
                                            <select name="" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="">ด่วน</option>
                                                <option value="">ด่วนมาก</option>
                                                <option value="">ด่วนที่สุด</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>วันที่แสดงผล</td>
                                        <td>
                                            <div class="input-group input-daterange">
                                                <input type="text" class="form-control" placeholder="mm/dd/yyyy">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">to</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="mm/dd/yyyy">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>เอกสาร</td>
                                        <td><input type="file" class="form-control"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                            <button class="btn btn-default">บันทึก</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document ">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white" id="exampleModalLabel">แก้ไข ข่าวสาร</h5>
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
                                        <td>หัวข้อข่าว</td>
                                        <td><input type="text" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>ข้อมูลข่าว</td>
                                        <td><textarea name="" id="" cols="30" rows="5" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>ประเภทข่าว</td>
                                        <td>
                                            <select name="" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="">ข่าวประกาศ</option>
                                                <option value="">ข่าวรับสมัคร</option>
                                                <option value="">ข่าวลงคะแนน</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ความสำคัญข่าว</td>
                                        <td>
                                            <select name="" id="" class="form-control">
                                                <option value="">Select</option>
                                                <option value="">ด่วน</option>
                                                <option value="">ด่วนมาก</option>
                                                <option value="">ด่วนที่สุด</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>วันที่แสดงผล</td>
                                        <td>
                                            <div class="input-group input-daterange">
                                                <input type="text" class="form-control" placeholder="mm/dd/yyyy">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">to</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="mm/dd/yyyy">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>เอกสาร</td>
                                        <td><input type="file" class="form-control"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                            <button class="btn btn-default">บันทึก</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document ">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">รายละเอียด ข่าวสาร</h5>
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
                                        <td>หัวข้อข่าว</td>
                                        <td colspan="3">Lorem ipsum dolor sit amet</td>
                                    </tr>
                                    <tr>
                                        <td>ข้อมูลข่าว</td>
                                        <td colspan="3">Officia consectetur</td>
                                    </tr>
                                    <tr>
                                        <td>ประเภทข่าว</td>
                                        <td colspan="3">ข่าวประกาศ</td>
                                    </tr>
                                    <tr>
                                        <td>ความสำคัญข่าว</td>
                                        <td colspan="3">ด่วน</td>
                                    </tr>
                                    <tr>
                                        <td>วันที่เปิดรับสมัคร</td>
                                        <td>2012-12-08T00:00:00</td>
                                        <td>ถึงวันที่</td>
                                        <td>1982-05-06T23:59:59</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-default" data-dismiss="modal">ปิด</button>
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
                            <p>คุณต้องการลบข้อมูลข่าว</p>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                            <button class="btn btn-default">ตกลง</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#zero_config').DataTable();


        $('.input-daterange input').each(function() {
            $(this).datepicker('clearDates');
        });
    </script>