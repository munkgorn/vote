
    <div id="main-wrapper">
        <?php require_once('common/menu.php'); ?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">เปลี่ยนรหัสผ่าน</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">เปลี่ยนรหัสผ่าน</li>
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
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-2 col-form-label">ชื่อผู้ใช้งาน</label>
									<div class="col-sm-4">
										<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="9999999999999@999999999">
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPassword" class="col-sm-2 col-form-label">รหัสผ่านเดิม</label>
									<div class="col-sm-4">
										<input type="password" class="form-control" id="inputPassword" placeholder="Password">
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPassword" class="col-sm-2 col-form-label">รหัสผ่านใหม่</label>
									<div class="col-sm-4">
										<input type="password" class="form-control" id="inputPassword" placeholder="Password">
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPassword" class="col-sm-2 col-form-label">ยืนยันรหัสผ่านใหม่</label>
									<div class="col-sm-4">
										<input type="password" class="form-control" id="inputPassword" placeholder="Confirm Password">
									</div>
								</div>
								<div class="row">
									<div class="col-12 text-right"><button class="btn btn-default">บันทึก</button></div>
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