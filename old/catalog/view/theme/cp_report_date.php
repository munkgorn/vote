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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-3 col-form-label">วันที่ลงคะแนน</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" id="datepicker-autoclose">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-right"><button class="btn btn-info">ค้นหา</button></div>
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
                                                <th class="text-center">ลำดับที่</th>
                                                <th>วาระการสรรหา</th>
                                                <th>ตำแหน่ง</th>
                                                <th>ชุดที่</th>
                                                <th>ปีบัญชีที่</th>
                                                <th>ครั้งที่</th>
                                                <th class="text-center">รายงาน</th>
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
                                                <td class="text-center">
                                                    <button class="btn btn-default"><i class="fas fa-table"></i></button>
                                                    <button class="btn btn-default"><i class="fas fa-chart-bar"></i></button>
                                                    <button class="btn btn-default"><i class="fas fa-chart-pie"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>สรรหาคณะกรรมการดำเนินการ</td>
                                                <td>ประธานกรรมการ</td>
                                                <td>48/49</td>
                                                <td>2562</td>
                                                <td>9</td>
                                                <td class="text-center">
                                                    <button class="btn btn-default"><i class="fas fa-table"></i></button>
                                                    <button class="btn btn-default"><i class="fas fa-chart-bar"></i></button>
                                                    <button class="btn btn-default"><i class="fas fa-chart-pie"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td>สรรหาคณะกรรมการดำเนินการ</td>
                                                <td>กรรมการดำเนินการ</td>
                                                <td>48/49</td>
                                                <td>2562</td>
                                                <td>9</td>
                                                <td class="text-center">
                                                    <button class="btn btn-default"><i class="fas fa-table"></i></button>
                                                    <button class="btn btn-default"><i class="fas fa-chart-bar"></i></button>
                                                    <button class="btn btn-default"><i class="fas fa-chart-pie"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">4</td>
                                                <td>สรรหาคณะกรรมการดำเนินการ</td>
                                                <td>ผู้ตรวจสอบกิจการ</td>
                                                <td>48/49</td>
                                                <td>2562</td>
                                                <td>9</td>
                                                <td class="text-center">
                                                    <button class="btn btn-default"><i class="fas fa-table"></i></button>
                                                    <button class="btn btn-default"><i class="fas fa-chart-bar"></i></button>
                                                    <button class="btn btn-default"><i class="fas fa-chart-pie"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">5</td>
                                                <td>สรรหาคณะกรรมการดำเนินการ</td>
                                                <td>กรรมการดำเนินการ</td>
                                                <td>47/48</td>
                                                <td>2561</td>
                                                <td>8</td>
                                                <td class="text-center">
                                                    <button class="btn btn-default"><i class="fas fa-table"></i></button>
                                                    <button class="btn btn-default"><i class="fas fa-chart-bar"></i></button>
                                                    <button class="btn btn-default"><i class="fas fa-chart-pie"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">6</td>
                                                <td>สรรหาคณะกรรมการดำเนินการ</td>
                                                <td>ผู้ตรวจสอบกิจการ</td>
                                                <td>47/48</td>
                                                <td>2561</td>
                                                <td>8</td>
                                                <td class="text-center">
                                                    <button class="btn btn-default"><i class="fas fa-table"></i></button>
                                                    <button class="btn btn-default"><i class="fas fa-chart-bar"></i></button>
                                                    <button class="btn btn-default"><i class="fas fa-chart-pie"></i></button>
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
                                                <th class="text-center">รายงาน</th>
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
    <script src="lib/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
    </script>