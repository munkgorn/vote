
    <div id="main-wrapper">
        <?php require_once('common/menu.php'); ?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">ข้อมูลผู้สมัคร</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">ข้อมูลผู้สมัคร</li>
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
                                <div class="row">
                                    <div class="col-5">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">ปีบัญชี</label>
                                            <div class="col-sm-8">
                                                <select class="form-control"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-4 col-form-label">วาระการสรรหาชุดที่</label>
                                            <div class="col-sm-8">
                                                <select class="form-control"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-right"><button class="btn btn-info" data-toggle="modal" data-target="#Modal1">ค้นหา</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row hide" id="data">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ลำดับที่</th>
                                                <th>ชื่อ-นามสกุล</th>
                                                <th>หมายเลขสมาชิก</th>
                                                <th>จังหวัด</th>
                                                <th>ตำแหน่งที่สมัคร</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>บัณฑูร ชุนสิทธิ์</td>
                                                <td>999999</td>
                                                <td>กรุงเทพมหานคร</td>
                                                <td>ผู้ตรวจสอบกิจการ</td>
                                                <td><button class="btn btn-default" data-toggle="modal" data-target="#detail"><i class="fa fa-eye"></i></button></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">ลำดับที่</th>
                                                <th>ชื่อ-นามสกุล</th>
                                                <th>หมายเลขสมาชิก</th>
                                                <th>จังหวัด</th>
                                                <th>ตำแหน่งที่สมัคร</th>
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
    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document " style="max-width: 80%;">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white" id="exampleModalLabel">เลือกวาระการลรรหา</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="popup_table" class="table table-striped table-bordered">
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
                                            <td>ผู้ตรวจสอบกิจการ</td>
                                            <td>47/48</td>
                                            <td>2561</td>
                                            <td>8</td>
                                            <td>Complete</td>
                                            <td><button class="btn btn-success" id="show_data" data-dismiss="modal" aria-label="Close">เลือก</button></td>
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
                <div class="modal-footer">
                    <div class="row">
                         <div class="col-md-12 text-right">
                            <button class="btn btn-default" data-dismiss="modal" aria-label="Close">ยกเลิก</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document " style="max-width: 80%;">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalLabel">รายละเอียดผู้สมัคร</h5>
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
                                        <td>สร้างในนาม</td>
                                        <td>อิสระ</td>
                                        <td>วันที่สมัคร</td>
                                        <td>2018-12-25T00:00:00</td>
                                        <td class="w-25" rowspan="6"><img src="http://placehold.it/1200x1080/" alt="" class="w-100"></td>
                                    </tr>
                                    <tr>
                                        <td>ชื่อ-นามสกุล</td>
                                        <td colspan="3">บัณฑูร ชุนสิทธิ์</td>
                                    </tr>
                                    <tr>
                                        <td>สมาชิกเลขที่</td>
                                        <td>999999</td>
                                        <td>อายุ</td>
                                        <td>56 ปี</td>
                                    </tr>
                                    <tr>
                                        <td>ปัจจุบันดำรงค์ตำแหน่ง</td>
                                        <td>ผู้ตรวจสอบกิจการ</td>
                                        <td>เป็นสมาชิกสหกรณ์</td>
                                        <td>10 ปี 10 เดือน</td>
                                    </tr>
                                    <tr>
                                        <td>สังกัด</td>
                                        <td>กรุงเทพมหานคร</td>
                                        <td>โทรศัพท์มือถือ</td>
                                        <td>0951639926</td>
                                    </tr>
                                    <tr>
                                        <td>ตำแหน่งที่สมัคร</td>
                                        <td>ผู้ตรวจสอบกิจการ</td>
                                        <td>หมายเลขผู้สมัคร</td>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
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
        $('#popup_table').DataTable();
    </script>

    <script>
        $(document).ready(function() {
            $('#show_data').click(function(event) {
                $('#data').removeClass('hide');
                $('#data').addClass('show');
            });
        });
    </script>



