<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
                        <?php if($success) { ?>
                        <div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                        <?php } ?>
                        <?php if($error) { ?>
                        <div class="alert alert-danger alert-dismissible"><i class="fa fa-check-circle"></i> <?php echo $error; ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                        <?php } ?>
                        <form action="<?php echo $action; ?>" method="post">
						<div class="form-group row">
							<label for="staticEmail" class="col-sm-2 col-form-label">ชื่อผู้ใช้งาน</label>
							<div class="col-sm-4">
								<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $user; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword" class="col-sm-2 col-form-label">รหัสผ่านเดิม</label>
							<div class="col-sm-4">
								<input type="password" name="oldpassword" class="form-control" id="inputPassword" placeholder="Password" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword" class="col-sm-2 col-form-label">รหัสผ่านใหม่</label>
							<div class="col-sm-4">
								<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword" class="col-sm-2 col-form-label">ยืนยันรหัสผ่านใหม่</label>
							<div class="col-sm-4">
								<input type="password" name="confirmpassword" class="form-control" id="inputPassword" placeholder="Confirm Password" required>
							</div>
						</div>
						<div class="row">
							<div class="col-12 text-right"><button type="submit" class="btn btn-default">บันทึก</button></div>
						</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <footer class="footer text-center">
        All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
    </footer> -->
</div>