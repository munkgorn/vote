    <div id="main-wrapper">
        <?php require_once('common/menu.php'); ?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">ตั้งค่าระบบ</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">ตั้งค่าระบบ</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-3 col-form-label">ประเภทข้อมูล</label>
                                            <div class="col-sm-9">
                                                <select name="" id="" class="form-control">
                                                    <option value="">ประเภทข่าว</option>
                                                    <option value="">ประเภทเอกสาร</option>
                                                    <option value="">คำนำหน้าชื่อ</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-right"><button class="btn btn-info">ค้นหา</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ประเภทข่าว</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">ประเภทเอกสาร</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">คำนำหน้าชื่อ</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-5">
                                            <div class="col-md-12 text-right">
                                                <button class="btn btn-success" data-toggle="modal" data-target="#add"><i class="fas fa-save"></i> เพิ่มค่าระบบ</button>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="zero_config" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No</th>
                                                        <th>Key</th>
                                                        <th>Value</th>
                                                        <th>Status</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td>nt1</td>
                                                        <td>ข่าวประกาศ</td>
                                                        <td>Active</td>
                                                        <td>
                                                            <button class="btn btn-warning" data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></button>
                                                            <button class="btn btn-default" data-toggle="modal" data-target="#view"><i class="fas fa-eye"></i></button>
                                                            <button class="btn btn-danger" data-toggle="modal" data-target="#delete"><i class="fas fa-trash-alt"></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">2</td>
                                                        <td>nt2</td>
                                                        <td>ข่าวรับสมัคร</td>
                                                        <td>Active</td>
                                                        <td>
                                                            <button class="btn btn-warning" data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></button>
                                                            <button class="btn btn-default" data-toggle="modal" data-target="#view"><i class="fas fa-eye"></i></button>
                                                            <button class="btn btn-danger" data-toggle="modal" data-target="#delete"><i class="fas fa-trash-alt"></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">3</td>
                                                        <td>nt3</td>
                                                        <td>ข่าวลงคะแนน</td>
                                                        <td>Active</td>
                                                        <td>
                                                            <button class="btn btn-warning" data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></button>
                                                            <button class="btn btn-default" data-toggle="modal" data-target="#view"><i class="fas fa-eye"></i></button>
                                                            <button class="btn btn-danger" data-toggle="modal" data-target="#delete"><i class="fas fa-trash-alt"></i></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th>Key</th>
                                                    <th>Value</th>
                                                    <th>Status</th>
                                                    <th>Edit</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-5">
                                            <div class="col-md-12 text-right">
                                                <button class="btn btn-success" data-toggle="modal" data-target="#add"><i class="fas fa-save"></i> เพิ่มค่าระบบ</button>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="zero_config2" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No</th>
                                                        <th>Key</th>
                                                        <th>Value</th>
                                                        <th>Status</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td>doc1</td>
                                                        <td>สำเนาบัตรสมาชิก</td>
                                                        <td>Active</td>
                                                        <td>
                                                            <button class="btn btn-warning" data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></button>
                                                            <button class="btn btn-default" data-toggle="modal" data-target="#view"><i class="fas fa-eye"></i></button>
                                                            <button class="btn btn-danger" data-toggle="modal" data-target="#delete"><i class="fas fa-trash-alt"></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">2</td>
                                                        <td>doc2</td>
                                                        <td>สำเนาการโอนเงิน</td>
                                                        <td>Active</td>
                                                        <td>
                                                            <button class="btn btn-warning" data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></button>
                                                            <button class="btn btn-default" data-toggle="modal" data-target="#view"><i class="fas fa-eye"></i></button>
                                                            <button class="btn btn-danger" data-toggle="modal" data-target="#delete"><i class="fas fa-trash-alt"></i></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th>Key</th>
                                                    <th>Value</th>
                                                    <th>Status</th>
                                                    <th>Edit</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-5">
                                            <div class="col-md-12 text-right">
                                                <button class="btn btn-success" data-toggle="modal" data-target="#add"><i class="fas fa-save"></i> เพิ่มค่าระบบ</button>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="zero_config3" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No</th>
                                                        <th>Key</th>
                                                        <th>Value</th>
                                                        <th>Status</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td>tt1</td>
                                                        <td>จ.ท.</td>
                                                        <td>Active</td>
                                                        <td>
                                                            <button class="btn btn-warning" data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></button>
                                                            <button class="btn btn-default" data-toggle="modal" data-target="#view"><i class="fas fa-eye"></i></button>
                                                            <button class="btn btn-danger" data-toggle="modal" data-target="#delete"><i class="fas fa-trash-alt"></i></button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td>tt10</td>
                                                        <td>ว่าที่ ร.ต.</td>
                                                        <td>Active</td>
                                                        <td>
                                                            <button class="btn btn-warning" data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></button>
                                                            <button class="btn btn-default" data-toggle="modal" data-target="#view"><i class="fas fa-eye"></i></button>
                                                            <button class="btn btn-danger" data-toggle="modal" data-target="#delete"><i class="fas fa-trash-alt"></i></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th>Key</th>
                                                    <th>Value</th>
                                                    <th>Status</th>
                                                    <th>Edit</th>
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
            </div>
            <!-- <footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer> -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
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
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Key</td>
                                        <td><input type="text" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Value</td>
                                        <td><input type="text" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="edit" id="inlineRadio1" value="active" checked>
                                                <label class="form-check-label" for="inlineRadio1">ใช้งาน</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="edit" id="inlineRadio2" value="inactive">
                                                <label class="form-check-label" for="inlineRadio2">ไม่ใช้งาน</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">ยกเลิก</button>
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
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">ยืนยัน</h5>
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
                                        <td>Key</td>
                                        <td><input type="text" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Value</td>
                                        <td><input type="text" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="edit" id="inlineRadio1" value="active">
                                                <label class="form-check-label" for="inlineRadio1">ใช้งาน</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="edit" id="inlineRadio2" value="inactive">
                                                <label class="form-check-label" for="inlineRadio2">ไม่ใช้งาน</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">ยกเลิก</button>
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
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">ยืนยัน</h5>
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
                                        <td>Key</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Value</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-default" data-dismiss="modal" aria-label="Close">ปิด</button>
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
                            <p>คุณต้องการลบข้อมูลค่าระบบ</p>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-default">ยกเลิก</button>
                            <button class="btn btn-danger">ตกลง</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#zero_config').DataTable();
        $('#zero_config2').DataTable();
        $('#zero_config3').DataTable();
    </script>