<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<div class="main-wrapper">
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <div class="auth-box bg-dark border-top border-secondary">
            <div id="loginform">
                <!-- <div class="text-center p-t-20 p-b-20">
                    <span class="db"><img src="lib/assets/images/logo.png" alt="logo" /></span>
                </div>
                <!-- Form -->
                <form class="form-horizontal m-t-20" id="loginform" action="<?php echo $action;?>" method="post">
                    <div class="row p-b-30">
                        <div class="col-12">

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white" id="basic-addon1"><i class="ti-key"></i></span>
                                </div>
                                <input type="number" maxlength="13" name="taxid" class="form-control form-control-lg" placeholder="รหัสประจำตัวประชาชน 13 หลัก" aria-label="Username" aria-describedby="basic-addon1" required autofocus="on">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                </div>
                                <input type="text" name="username" class="form-control form-control-lg" placeholder="เลขที่สามาชิก" aria-label="Username" aria-describedby="basic-addon1" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-lock"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control form-control-lg" placeholder="รหัสผ่าน" aria-label="Password" aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                    </div>
                    <div class="row border-top border-secondary">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="p-t-20">
                                    <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> ลืมรหัสผ่าน?</button>
                                    <button class="btn btn-success float-right" type="submit" id="btn_submit">เข้าสู่ระบบ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
<?php echo $error; ?>

<script type="text/javascript">
jQuery(document).ready(function($) {
    <?php if (isset($error)&&!empty($error)) { ?>
    toastr.warning('<?php echo $error;?>', 'WRONG!');
    <?php } ?>
});
</script>