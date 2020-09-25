<!-- <link href="assets/theme/lib/assets/libs/jquery-steps/jquery.steps.css" rel="stylesheet">
<link href="assets/theme/lib/assets/libs/jquery-steps/steps.css" rel="stylesheet"> -->
    <div id="main-wrapper">
        <?php require_once('common/menu.php'); ?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">ผู้สมัครรับการสรรหา</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">ผู้สมัครรับการสรรหา</li>
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
                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body wizard-content">
                                <h4 class="card-title">Basic Form Example</h4>
                                <h6 class="card-subtitle"></h6>
                                <form id="example-form" action="#" class="m-t-40">
                                    <div>
                                        <h3>Account</h3>
                                        <section>
                                            <label for="userName">User name *</label>
                                            <input id="userName" name="userName" type="text" class="required form-control">
                                            <label for="password">Password *</label>
                                            <input id="password" name="password" type="text" class="required form-control">
                                            <label for="confirm">Confirm Password *</label>
                                            <input id="confirm" name="confirm" type="text" class="required form-control">
                                            <p>(*) Mandatory</p>
                                        </section>
                                        <h3>Profile</h3>
                                        <section>
                                            <label for="name">First name *</label>
                                            <input id="name" name="name" type="text" class="required form-control">
                                            <label for="surname">Last name *</label>
                                            <input id="surname" name="surname" type="text" class="required form-control">
                                            <label for="email">Email *</label>
                                            <input id="email" name="email" type="text" class="required email form-control">
                                            <label for="address">Address</label>
                                            <input id="address" name="address" type="text" class=" form-control">
                                            <p>(*) Mandatory</p>
                                        </section>
                                        <h3>Hints</h3>
                                        <section>
                                            <ul>
                                                <li>Foo</li>
                                                <li>Bar</li>
                                                <li>Foobar</li>
                                            </ul>
                                        </section>
                                        <h3>Finish</h3>
                                        <section>
                                            <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required">
                                            <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                                        </section>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-danger">สร้างวาระการสรรหา STEP 1 OF 2</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="nav nav-pills mb-3 w-100" id="pills-tab" role="tablist">
                                            <li class="nav-item w-50">
                                                <a class="nav-link active p-3" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><h3 class="mb-0">1 สร้างวาระการสรรหา</h3></a>
                                            </li>
                                            <li class="nav-item w-50">
                                                <a class="nav-link p-3" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><h3 class="mb-0">2 เพิ่มข้อมูลผู้สรรหา</h3></a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p>รายละเอียดวาระ</p>
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <td>ชุดที่</td>
                                                                    <td><input type="text" class="form-control"></td>
                                                                    <td>ปีบัญชีที่</td>
                                                                    <td><input type="text" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ครั้งที่สรรหา</td>
                                                                    <td><input type="text" class="form-control"></td>
                                                                    <td>ประเภทการสรรหา</td>
                                                                    <td>
                                                                        <select name="" id="sl01" class="form-control">
                                                                            <option value="#">กรุณาเลือก...</option>
                                                                            <option value="op01">สรรหาคณะกรรมการดำเนินการ</option>
                                                                            <option value="op02">สรรหาผู้แทนสมาชิก</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-12">
                                                        <div id="op01" class="select-hide" style="display: none;">
                                                            <table class="table table-bordered">
                                                                <thead class="bg-info text-white">
                                                                    <tr>
                                                                        <th></th>
                                                                        <th>ประเภทคณะกรรมการ</th>
                                                                        <th>จำนวนผู้ได้รับตำแหน่ง</th>
                                                                        <th>จำนวนสำรอง</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td><input type="checkbox" class="form-control"></td>
                                                                        <td>ประธานกรรมการ</td>
                                                                        <td><input type="text" class="form-control" value="1"></td>
                                                                        <td><input type="text" class="form-control" value="1"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><input type="checkbox" class="form-control"></td>
                                                                        <td>กรรมการดำเนินการ</td>
                                                                        <td><input type="text" class="form-control" value="7"></td>
                                                                        <td><input type="text" class="form-control" value="4"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><input type="checkbox" class="form-control"></td>
                                                                        <td>ผู้ตรวจสอบกิจการ</td>
                                                                        <td><input type="text" class="form-control" value="1"></td>
                                                                        <td><input type="text" class="form-control" value="1"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div id="op02" class="select-hide" style="display: none;">
                                                            <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" id="tab-two" data-toggle="pill" href="#tabs-01" role="tab" aria-controls="tabs-01" aria-selected="true">ส่วนกลาง</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="tab-two01" data-toggle="pill" href="#tabs-02" role="tab" aria-controls="tabs-02" aria-selected="false">ภาคใต้</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="tab-two02" data-toggle="pill" href="#tabs-03" role="tab" aria-controls="tabs-03" aria-selected="false">ภาคตะวันตก</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="tab-two03" data-toggle="pill" href="#tabs-04" role="tab" aria-controls="tabs-04" aria-selected="false">ภาคตะวันออกเฉียงเหนือ</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="tab-two04" data-toggle="pill" href="#tabs-05" role="tab" aria-controls="tabs-05" aria-selected="false">ภาคตะวันออก</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="tab-two05" data-toggle="pill" href="#tabs-06" role="tab" aria-controls="tabs-06" aria-selected="false">ภาคกลาง</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="tab-two06" data-toggle="pill" href="#tabs-07" role="tab" aria-controls="tabs-07" aria-selected="false">ภาคเหนือ</a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content" id="pills-tabContent">
                                                                <div class="tab-pane fade show active" id="tabs-01" role="tabpanel" aria-labelledby="tab-two">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h3>ส่วนกลาง</h3>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <table class="table table-bordered">
                                                                                <thead class="bg-info text-white">
                                                                                    <tr>
                                                                                        <th></th>
                                                                                        <th>กลุ่ม</th>
                                                                                        <th>จำนวนผู้ได้รับตำแหน่ง</th>
                                                                                        <th>จำนวนสำรอง</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><input type="checkbox" class="form-control"></td>
                                                                                        <td>ส่วนกลางกรมส่งเสริมการเกษตร</td>
                                                                                        <td><input type="text" class="form-control" value="22"></td>
                                                                                        <td><input type="text" class="form-control" value="11"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><input type="checkbox" class="form-control"></td>
                                                                                        <td>กรุงเทพมหานคร</td>
                                                                                        <td><input type="text" class="form-control" value="1"></td>
                                                                                        <td><input type="text" class="form-control" value="4"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><input type="checkbox" class="form-control"></td>
                                                                                        <td>กำแพงเพชร</td>
                                                                                        <td><input type="text" class="form-control" value="3"></td>
                                                                                        <td><input type="text" class="form-control" value="4"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><input type="checkbox" class="form-control"></td>
                                                                                        <td>กรมหม่อนไหม</td>
                                                                                        <td><input type="text" class="form-control" value="5"></td>
                                                                                        <td><input type="text" class="form-control" value="5"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><input type="checkbox" class="form-control"></td>
                                                                                        <td>กรมการข้าว</td>
                                                                                        <td><input type="text" class="form-control" value="21"></td>
                                                                                        <td><input type="text" class="form-control" value="11"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade show" id="tabs-02" role="tabpanel" aria-labelledby="tab-two01">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h3>ภาคใต้</h3>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <table class="table table-bordered">
                                                                                <thead class="bg-info text-white">
                                                                                    <tr>
                                                                                        <th></th>
                                                                                        <th>กลุ่ม</th>
                                                                                        <th>จำนวนผู้ได้รับตำแหน่ง</th>
                                                                                        <th>จำนวนสำรอง</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><input type="checkbox" class="form-control"></td>
                                                                                        <td>Lorem ipsum dolor sit amet</td>
                                                                                        <td><input type="text" class="form-control" value="22"></td>
                                                                                        <td><input type="text" class="form-control" value="11"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade show" id="tabs-03" role="tabpanel" aria-labelledby="tab-two02">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h3>ภาคตะวันตก</h3>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <table class="table table-bordered">
                                                                                <thead class="bg-info text-white">
                                                                                    <tr>
                                                                                        <th></th>
                                                                                        <th>กลุ่ม</th>
                                                                                        <th>จำนวนผู้ได้รับตำแหน่ง</th>
                                                                                        <th>จำนวนสำรอง</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><input type="checkbox" class="form-control"></td>
                                                                                        <td>Lorem ipsum dolor sit amet</td>
                                                                                        <td><input type="text" class="form-control" value="22"></td>
                                                                                        <td><input type="text" class="form-control" value="11"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade show" id="tabs-04" role="tabpanel" aria-labelledby="tab-two03">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h3>ภาคตะวันออกเฉียงเหนือ</h3>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <table class="table table-bordered">
                                                                                <thead class="bg-info text-white">
                                                                                    <tr>
                                                                                        <th></th>
                                                                                        <th>กลุ่ม</th>
                                                                                        <th>จำนวนผู้ได้รับตำแหน่ง</th>
                                                                                        <th>จำนวนสำรอง</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><input type="checkbox" class="form-control"></td>
                                                                                        <td>Lorem ipsum dolor sit amet</td>
                                                                                        <td><input type="text" class="form-control" value="22"></td>
                                                                                        <td><input type="text" class="form-control" value="11"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade show" id="tabs-05" role="tabpanel" aria-labelledby="tab-two04">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h3>ภาคตะวันออก</h3>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <table class="table table-bordered">
                                                                                <thead class="bg-info text-white">
                                                                                    <tr>
                                                                                        <th></th>
                                                                                        <th>กลุ่ม</th>
                                                                                        <th>จำนวนผู้ได้รับตำแหน่ง</th>
                                                                                        <th>จำนวนสำรอง</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><input type="checkbox" class="form-control"></td>
                                                                                        <td>Lorem ipsum dolor sit amet</td>
                                                                                        <td><input type="text" class="form-control" value="22"></td>
                                                                                        <td><input type="text" class="form-control" value="11"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade show" id="tabs-06" role="tabpanel" aria-labelledby="tab-two05">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h3>ภาคกลาง</h3>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <table class="table table-bordered">
                                                                                <thead class="bg-info text-white">
                                                                                    <tr>
                                                                                        <th></th>
                                                                                        <th>กลุ่ม</th>
                                                                                        <th>จำนวนผู้ได้รับตำแหน่ง</th>
                                                                                        <th>จำนวนสำรอง</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><input type="checkbox" class="form-control"></td>
                                                                                        <td>Lorem ipsum dolor sit amet</td>
                                                                                        <td><input type="text" class="form-control" value="22"></td>
                                                                                        <td><input type="text" class="form-control" value="11"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade show" id="tabs-07" role="tabpanel" aria-labelledby="tab-two06">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h3>ภาคเหนือ</h3>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <table class="table table-bordered">
                                                                                <thead class="bg-info text-white">
                                                                                    <tr>
                                                                                        <th></th>
                                                                                        <th>กลุ่ม</th>
                                                                                        <th>จำนวนผู้ได้รับตำแหน่ง</th>
                                                                                        <th>จำนวนสำรอง</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><input type="checkbox" class="form-control"></td>
                                                                                        <td>Lorem ipsum dolor sit amet</td>
                                                                                        <td><input type="text" class="form-control" value="22"></td>
                                                                                        <td><input type="text" class="form-control" value="11"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <td>รายละเอียดเพิ่มเติม</td>
                                                                    <td colspan="3"><textarea name="" id="" cols="30" rows="5" class="form-control"></textarea></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>วันที่เปิดรับสมัคร</td>
                                                                    <td>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>ถึงวันที่</td>
                                                                    <td>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>กำหนดวันลงคะแนน</td>
                                                                    <td>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>ปิดลงคะแนน</td>
                                                                    <td>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6"><h4>เอกสารการสมัคร</h4></div>
                                                    <div class="col-6 text-right"><button class="btn btn-warning" data-toggle="modal" data-target="#add_file">เพิ่มเอกสาร</button></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <table class="table table-bordered">
                                                            <thead class="bg-primary">
                                                                <tr>
                                                                    <th><p class="text-white mb-0">ประเภทเอกสาร</p></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                    <div class="col-12 text-center">
                                                        <button class="btn btn-default">CONTINUE</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table id="zero_config" class="table table-striped table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ตำแหน่งที่สมัคร</th>
                                                                        <th>หมายเลข</th>
                                                                        <th>ชื่อ-นามสกุล</th>
                                                                        <th>หมายเลขสมาชิก</th>
                                                                        <th>การอนุมัติ</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                   
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>ตำแหน่งที่สมัคร</th>
                                                                    <th>หมายเลข</th>
                                                                    <th>ชื่อ-นามสกุล</th>
                                                                    <th>หมายเลขสมาชิก</th>
                                                                    <th>การอนุมัติ</th>
                                                                    <th></th>
                                                                </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 text-right mt-5 mb-2"><button class="btn btn-warning">เพิ่มผู้สมัคร</button></div>
                                                    <div class="col-12">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <td>IMAGE</td>
                                                                    <td><input type="file" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>สร้างในนาม</td>
                                                                    <td>
                                                                        <select name="" id="" class="form-control">
                                                                            <option value=""></option>
                                                                        </select>
                                                                    </td>
                                                                    <td>วันที่สมัคร</td>
                                                                    <td>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ชื่อ-นามสกุล</td>
                                                                    <td colspan="3">
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                                            <div class="input-group-append">
                                                                                <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#Modal1">SEARCH</button>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>สมาชิกเลขที่</td>
                                                                    <td><input type="text" class="form-control"></td>
                                                                    <td>อายุ</td>
                                                                    <td><input type="text" class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ปัจจุบันดำรงค์ตำแหน่ง</td>
                                                                    <td><input type="text" class="form-control"></td>
                                                                    <td>เป็นสมาชิกสหกรณ์</td>
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-md-5">
                                                                                <input type="text" class="form-control">
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                <p>ปี</p>
                                                                            </div>
                                                                            <div class="col-md-5">
                                                                                <input type="text" class="form-control">
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                <p>เดือน</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>สังกัด</td>
                                                                    <td colspan="3">
                                                                        <input type="text" class="form-control">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>โทรศัพท์</td>
                                                                    <td><input type="text" class="form-control"></td>
                                                                    <td>ตำแหน่งที่สมัคร</td>
                                                                    <td>
                                                                        <select name="" id="" class="form-control">
                                                                            <option value=""></option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>โทรศัพท์มือถือ</td>
                                                                    <td><input type="text" class="form-control"></td>
                                                                    <td>เลขที่ผู้สมัคร</td>
                                                                    <td><input type="text" class="form-control"></td>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
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
            <!-- <footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer> -->
            <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Search Member</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true ">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>ชื่อ</td>
                                                <td><input type="text" class="form-control"></td>
                                                <td>นามสกุล</td>
                                                <td><input type="text" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>เลขที่สมาชิก</td>
                                                <td><input type="text" class="form-control"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 text-right mb-4">
                                    <button class="btn btn-info">SEARCH</button>
                                </div>
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>สมาชิกเลขที่</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>เลขประจำตัวประชาชน</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>สมาชิกเลขที่</th>
                                                <th>ชื่อ-นามสกุล</th>
                                                <th>เลขประจำตัวประชาชน</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="add_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document ">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title text-white" id="exampleModalLabel">เอกสาร</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true ">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <p>เอกสารการสมัคร</p>
                                    <table class="table table-bordered">
                                        <thead class="bg-info text-white">
                                            <tr>
                                                <th></th>
                                                <th>ประเภทเอกสาร</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="checkbox" class="form-control"></td>
                                                <td>สำเนาบัตรสมาชิก</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="form-control"></td>
                                                <td>สำเนาการโอนเงิน</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 text-right">
                                    <button class="btn btn-info">OK</button>
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
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- this page js -->
   <!--  <script src="assets/theme/lib/assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="assets/theme/lib/assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
    <script>
        var form = $("#example-form");
        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });
         form.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function(event, currentIndex, newIndex) {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                alert("Submitted!");
            }
        });
    </script> -->
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
        $('#table').DataTable();

        jQuery('.mydatepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
    </script>

    <!-- select -->
    <script>
        $(function() {    
            $('#sl01').change(function(){
                $('.select-hide').hide();
                $('#' + $(this).val()).show();
            });
        });
    </script>
