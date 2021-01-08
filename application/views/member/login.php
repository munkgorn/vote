<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php  
// echo md5(3507);
?>

<div class="main-wrapper bg-dark auth-wrapper">
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php /* foreach ($lists as $key => $value) { ?>
                        <?php if ($value['showtime']==true) { ?>
                        <div class="carousel-item <?php if($key == '0'){ echo "active"; } ?>">
                            <img class="d-block w-100" src="<?php echo $value['file']; ?>" alt="First slide">
                            <div class="text-white pt-5 text-justify">
                                <small><?php echo $value['type_name']; ?></small>
                                <h4><?php echo $value['name']; ?></h4>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } */ ?>
                    </div>
                </div>
            </div>
            <div class="col-md-5 offset-1">
                <div class="">
                    <div class="row">
                        <div class="col-3 text-center">
                            <img src="<?php echo $base_url; ?>images/logo/logo.png" class="w-100" alt="Logo" />
                        </div>
                        <div class="col-9 pt-3">
                            <h4 class="text-white mb-0">การลงคะแนนสรรหาระบบออนไลน์</h4>
                            <hr class="border-success my-1">
                            <p class="text-white">สหกรณ์ออมทรัพย์กรมส่งเสริมการเกษตร จำกัด</p>
                        </div>
                    </div>

                    <?php if (isset($success)&&!empty($success)) : ?>
                    <div class="alert alert-success" role="alert"><?php echo $success;?></div>
                    <?php endif; ?>
                    <?php if (isset($error)&&!empty($error)) : ?>
                    <div class="alert alert-danger" role="alert"><?php echo $error;?></div>
                    <?php endif; ?>
                    <div id="loginform">
                        <form class="form-horizontal m-t-20" id="loginformform" action="<?php echo $action;?>" method="post">
                            <div class="row p-b-30 mb-2">
                                <div class="col-12 border-top border-bottom border-secondary py-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white" id="basic-addon1"><i class="ti-key"></i></span>
                                        </div>
                                        <input type="number" maxlength="13" name="id_card" class="form-control form-control-lg" placeholder="เลขบัตรประจำตัวประชาชน 13 หลัก" aria-label="Username" aria-describedby="basic-addon1" required autofocus="on" value="" autocomplete="off">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                        </div>
                                        <input type="text" name="member_no" class="form-control form-control-lg" placeholder="เลขทะเบียนสมาชิก 6 หลัก" aria-label="Username" aria-describedby="basic-addon1" required value="" autocomplete="off">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-lock"></i></span>
                                        </div>
                                        <input type="password" name="password" class="form-control form-control-lg" placeholder="รหัสผ่าน 4 หลัก" aria-label="Password" aria-describedby="basic-addon1" required value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="p-t-20">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <button class="btn btn-success float-right w-100" type="submit" id="btn_submit">เข้าสู่ระบบ</button> 
                                                </div>
                                                <div class="col-6">
                                                    <a href="http://www.fsoftpro.com/projects/sunha/index.php?route=form-password" target="new" class="btn btn-warning w-100">ขอรหัสผ่านสำหรับการสรรหา</a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="http://www.fsoftpro.com/projects/sunha/" target="new" class="btn btn-primary w-100">ตรวจสอบเลขทะเบียนสมาชิก</a>
                                                </div>
                                            </div>
                                            <!-- <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> ลืมรหัสผ่าน?</button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-white">หมายเหตุ :</p>
                                    <p class="mb-0 text-white">1. รหัสผ่านที่ใช้ในการลงทะเบียนนั้นเป็นข้อมูลส่วนบุคคลห้ามให้บุคคลอื่น</p>
                                    <p class="mb-0 text-white">2. การลงคะแนนควรลงด้วยตนเองหากไม่สามารถดำเนินการได้ให้ฝากบุคคลอื่นดำเนินการโดยเจ้าตัวต้องเป็นผู้กำชับการลงคะแนนด้วย</p>
                                    <p class="mb-0 text-white">3. รหัสผ่านสามารถตรวจสอบได้ที่ข้อมูลส่วนบุคคลผ่านช่องทางแอพพลิเคชั่นฯและเวปไซค์สหกรณ์</p>
                                    <p class="mb-0 text-white">4. รหัสผ่านที่ใช้ในการลงคะแนนสรรหา กับ รหัสผ่านที่ใช้ในการตรวจสอบข้อมูลส่วนบุคคลนั้น เป็นคนละชุดกันโปรดตรวจสอบให้ถุกต้อง</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $error; ?>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#btn_submit').click(function (e) { 
        e.preventDefault();
        let card = $('[name="id_card"]').val();
        let member_no = $('[name="member_no"]').val();
        let password = $('[name="password"]').val();
        let messagefail = false;
        if (card.length == 0) {
            messagefail=true;
        }
        if (member_no.length == 0) {
            messagefail=true;
        }
        if (password.length == 0) {
            messagefail=true;
        }

        if (messagefail==true) {
            toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน');
        }

        if (card.length > 0 && member_no.length > 0 && password.length > 0) {
            $('#loginformform').submit();
            // console.log('click');
            $('#btn_submit').attr('disabled','disabled');
        } else {
            $('#btn_submit').attr('disabled','disabled');
            countdownlogin();
        }
        
    });
    <?php if (isset($error) && !empty($error)) { ?>
    toastr.warning('<?php echo $error;?>', 'WRONG!'); 
    <?php } ?>
    
    let countdownlogin = () => {
        let time = 5;
        let timeid = setInterval(() => {
            
            if (time==0) {
                clearInterval(timeid);
                $('#btn_submit').removeAttr('disabled');
                toastr.success('กรุณาเข้าระบบใหม่อีกครั้ง');
            } else {
                toastr.info('กรุณารอจะสามารถเข้าระบบได้อีก ภายใน '+time+' วินาที');
            }
            
            time--;
        }, 1000);
    };
});
</script>
<script type="text/javascript">
$('.carousel').carousel({
    interval: 3000
})
</script>