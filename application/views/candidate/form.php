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
                        <h4 class="card-title text-danger">สร้างวาระการสรรหา STEP 1 OF 2</h4>
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-pills mb-3 w-100" id="pills-tab" role="tablist">
                                    <li class="nav-item w-50">
                                        <a class="nav-link p-3" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false"><h3 class="mb-0">1 สร้างวาระการสรรหา</h3></a>
                                    </li>
                                    <li class="nav-item w-50">
                                        <a class="nav-link p-3 active" id="pills-profile-tab-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true"><h3 class="mb-0">2 เพิ่มข้อมูลผู้สรรหา</h3></a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                
                                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
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
                                        
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table id="zero_config" class="datatable table table-striped table-bordered">
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
                                                        <?php foreach ($candidates as $candidate) { ?>
                                                        <tr>
                                                            <td><?php echo $candidate['type_name'];?></td>
                                                            <td><?php echo $candidate['candidate_no']; ?></td>
                                                            <td><?php echo $candidate['name']; ?></td>
                                                            <td><?php echo $candidate['member_no'];?></td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                  <input class="form-check-input change_status" data-id="<?php echo $candidate['id'];?>" type="radio" name="status<?php echo $candidate['id'];?>" id="status_approve<?php echo $candidate['id'];?>" value="1" <?php echo $candidate['status']==1?'checked':'';?>>
                                                                  <label class="form-check-label" for="status_approve<?php echo $candidate['id'];?>">อนุมัติ</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                  <input class="form-check-input change_status" data-id="<?php echo $candidate['id'];?>" type="radio" name="status<?php echo $candidate['id'];?>" id="status_unapprove<?php echo $candidate['id'];?>" value="0" <?php echo $candidate['status']!=null&&$candidate['status']==0?'checked':'';?>>
                                                                  <label class="form-check-label" for="status_unapprove<?php echo $candidate['id'];?>">ตัดสิทธิ์</label>
                                                                </div>
                                                                
                                                            </td>
                                                            <td>
                                                                <a href="<?php echo $candidate['edit']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                                <button type="button" data-toggle="modal" data-target="#confirm" class="btn btn-danger btn-sm" data-id="<?php echo $candidate['id'];?>"><i class="fas fa-trash-alt text-white"></i></button>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
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
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="formcandidate">
                                        <div class="row">
                                            <!-- <div class="col-12 text-right mt-5 mb-2"><button type="button" class="btn btn-warning">เพิ่มผู้สมัคร</button></div> -->
                                            <div class="col-12 text-right">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_export">Export</button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_import">Import</button>
                                            </div>
                                            <div class="col-12">
                                                
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <td>IMAGE</td>
                                                            <td>
                                                                <input type="file" name="image" class="form-control">
                                                                <button type="button" class="btn btn-primary btn-sm" id="add_image">เลือกรูปภาพ</button>
                                                                <img src="<?php echo $image;?>" alt="" id="preview_image" class="img-fluid">
                                                                <br>
                                                                <button type="button" class="btn btn-info btn-sm" id="edit_image">แก้ไขรูปภาพ</button>
                                                                <button type="button" class="btn btn-danger btn-sm" id="delete_image">ลบรูปภาพ</button>
                                                                <br><small>ขนาดรูปภาพ 1280x800 (ไม่เกิน 10mb)</small>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>สร้างในนาม</td>
                                                            <td>
                                                                <input type="text" name="author" class="form-control" value="<?php echo $author; ?>">
                                                            </td>
                                                            <td>วันที่สมัคร</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" name="date_register" class="form-control datepicker" placeholder="วว-ดด-ปปปป">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>ชื่อ-นามสกุล</td>
                                                            <td colspan="3">
                                                                <button class="btn" type="button" style="width:100%; border:1px solid #eee;height: 35px;text-align:left;color:#4F5467;" data-toggle="modal" data-target="#select_members"><?php echo isset($member_name)&&!empty($member_name) ? $member_name : 'คลิกเพื่อเลือก'; ?></button>
                                                                <input type="hidden" name="member_id" value="">
                                                                <!-- <select name="member_id" id="" class="form-control select2" data-placeholder="กรุณาเลือก">
                                                                    <option></option>
                                                                    <?php /* foreach ($members as $member) { ?>
                                                                    <option value="<?php echo $member->id; ?>" <?php echo $member_id==$member->id?'selected':''; ?>><?php echo $member->firstname.' '.$member->lastname; ?></option>
                                                                    <?php } */ ?>
                                                                </select> -->
                                                                <small>เลือกชื่อเพื่อดึงข้อมูลเบื้องต้น</small>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>สมาชิกเลขที่</td>
                                                            <td><input type="text" name="member_no" class="form-control" value="<?php echo $member_no; ?>" readonly></td>
                                                            <td>อายุ</td>
                                                            <td><input type="text" name="age" class="form-control" value="<?php echo $age; ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>ปัจจุบันดำรงค์ตำแหน่ง</td>
                                                            <td><input type="text" name="position" class="form-control" value="<?php echo $position; ?>"></td>
                                                            <td>เป็นสมาชิกสหกรณ์</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <input type="number" name="member_year" pattern="[0-9]{2}" title="กรุณากรอกตัวเลข 2 หลัก" class="form-control" value="<?php echo $member_year ?>">
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <p>ปี</p>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <input type="number" name="member_month"  pattern="[0-9]{2}" title="กรุณากรอกตัวเลข 2 หลัก" class="form-control" value="<?php echo $member_month ?>">
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
                                                                <input type="text" name="member_group_name" class="form-control" value="<?php echo $member_group_name; ?>" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>โทรศัพท์</td>
                                                            <td><input type="text" name="phone_office" class="form-control" value="<?php echo $phone_office; ?>"></td>
                                                            <td>ตำแหน่งที่สมัคร</td>
                                                            <td>
                                                                <select name="type_id" id="register_type" class="form-control">
                                                                <?php foreach ($recruiting_types as $recruiting_type) { ?>
                                                                    <option value="<?php echo $recruiting_type['id']; ?>" <?php echo $type_id== $recruiting_type['id'] ? 'selected' : '';?>><?php echo $recruiting_type['name']; ?></option>
                                                                <?php } ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>โทรศัพท์มือถือ</td>
                                                            <td><input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>"></td>
                                                            <td>เลขที่ผู้สมัคร</td>
                                                            <td><input type="text" name="candidate_no" class="form-control" value="<?php echo $candidate_no; ?>"></td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <a href="<?php echo $base_url;?>Recruiting/edit/<?php echo $recruiting_id;?>" class="btn btn-secondary">กลับไป</a>
                                                <button class="btn btn-default" type="submit" id="btnsubmit"><?php echo $button_title; ?></button>
                                            </div>
                                        </div>
                                        </form>
                                        
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
    <div class="modal fade" tabindex="-1" role="dialog" id="confirm">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">ยืนยันการลบผู้สมัคร</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>คุณต้องการลบผู้สมัคร?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            <form action="<?php echo $action_del; ?>">
            <button type="submit" class="btn btn-danger">ลบ</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modal_export">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Export ตัวอย่างการ Import ผู้สรรหา</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url(); ?>Candidate/exportCandidateCSV" method="post">
                <div class="row">
                    <div class="col-12 mb-2">
                        <input type="hidden" name="recruiting_id" value="<?php echo $recruiting_id;?>">
                        <select name="type_id" id="" class="form-control">
                            <?php foreach ($recruiting_types as $recruiting_type) { ?>
                            <option value="<?php echo $recruiting_type['id']; ?>" <?php echo $type_id == $recruiting_type['id'] ? 'selected' : '';?>><?php echo $recruiting_type['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-danger">Export</button>
                    </div>
                </div>  
                
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_import">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Import ผู้สรรหา</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url(); ?>Candidate/importCandidateCSV" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12 mb-2">
                        <input type="hidden" name="recruiting_id" value="<?php echo $recruiting_id;?>">
                        <input type="hidden" name="type_id" value="<?php echo $recruiting_types[0]['id'];?>">
                        <input type="file" name="importfile" class="form-control">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-danger">Export</button>
                    </div>
                </div>  
                
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>

<div class="modal fade" id="select_members" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="exampleModalLabel">ค้นหาสมาชิก</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <form id="form_search_member">
                                <div class="form-group row">
                                    <label for="inputmembername" class="col-sm-2 col-form-label">ชื่อ</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="filter_firstname" id="inputmembername" placeholder="ชื่อสมาชิก">
                                    </div>
                                    <label for="inputmemberlastname" class="col-sm-2 col-form-label">นามสกุล</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="filter_lastname" id="inputmemberlastname" placeholder="ชื่อสมาชิก">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputmemberno" class="col-sm-2 col-form-label">เลขที่สมาชิก</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="filter_member_no" id="inputmemberno" placeholder="เลขที่สมาชิก">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button class="btn btn-primary" id="btn_search_member" type="button">ค้นหา</button>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-bordered" id="tableListSearchMember">
                                <thead>
                                    <tr>
                                        <th>สมาชิกเลขที่</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>เลขประจำตัวประชาชน</th>
                                        <th>เลือกสมาชิก</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center">กรุณาค้นหาสมาชิกก่อน</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
#preview_image { width:300px; }
span.select2.select2-container { width: 100% !important; height: 35px !important; }
.select2-container--default .select2-selection--single { border: 1px solid #eef1f3 !important; height: 35px; padding: 5px; }
[class^='select2'] { border-radius: 2px !important; }
</style>
<script>
jQuery(document).ready(function($) {
    $('.datatable').DataTable();
});
</script>
<script>
jQuery(document).ready(function($) {

    var rangedate_register       = 1;
    var rangedate_regis_to_score = 1;
    var rangedate_scrore         = 1;

    $.fn.datepicker.dates['th'] = {
        days: ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤ", "ศุกร์", "เสาร์"],
        daysShort: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
        daysMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
        months: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
        monthsShort: ["ม.ค.", "ก.พ.", "มี.ค.", "ม.ย.", "พ.ค.", "ม.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ต.ค."],
        today: "วันนี้",
        clear: "ล้าง",
        format: "dd-mm-yyyy",
        titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
        weekStart: 0
    };

    $('.datepicker').datepicker({
        language: 'th',
        format: 'dd-mm-yyyy',
        autoclose: true,
        // startDate: 'today'
    });

    <?php if ($date_register) { ?>
        console.log('<?php echo $date_register;?>');
        $('[name="date_register"]').datepicker('destroy');
        $('[name="date_register"]').datepicker({
            language: 'th',
            format: 'dd-mm-yyyy',
            autoclose: true,
            // startDate: 'today'
        });
        $('[name="date_register"]').datepicker('setDate', '<?php echo $date_register;?>');
    <?php } ?>
    // date function
});
</script>
<script>
jQuery(document).ready(function($) {


    $('[name="recruiting_type_id"]').change(function(event) {
        if ($(this).val()=='committee') {
            $('#option_members').slideUp(100);
            $('#option_committee').slideDown('fast');
        } else if ($(this).val()=='members') {
            $('#option_committee').slideUp(100);
            $('#option_members').slideDown('fast');
        }
    });
});
</script>
<script>
jQuery(document).ready(function($) {
    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
        $('#pills-home-tab').removeClass('active');
        $('#pills-home-tab').removeClass('show');
        $('#pills-home-tab').attr('aria-selected', false);
        $('#pills-profile-tab-tab').addClass('active');
        $('#pills-profile-tab-tab').addClass('show');
        $('#pills-profile-tab-tab').attr('aria-selected', true);
    });
});
</script>
<script>
jQuery(document).ready(function($) {
    $('.select2').select2({
        placeholder: 'กรุณาเลือก',
        allowClear: true
    });

    <?php if ($type_id) { ?>
        $('[name="type_id"]').val('<?php echo $type_id;?>').trigger('change');
    <?php } ?>

    <?php if($member_id) { ?>
        $('[name="member_id"]').val('<?php echo $member_id;?>').trigger('change');
    <?php } ?>

    $('[name="member_id"]').on('select2:select', function (e) {
        $.post('<?php echo base_url();?>candidate/getMember', {id: $(this).val()}, function(data, textStatus, xhr) {
            $.each(data, function(index, val) {
                if (index=='birthday') {
                    console.log(val);
                    $('[name="'+index+'"]').datepicker('setDate', val);
                } else {
                    $('#pills-profile [name="'+index+'"]').val(val); 
                }
            });
        },'json');
    });
});
</script>
<script>
jQuery(document).ready(function($) {
    $('.edit_candidate').click(function(event) {
        var candidateid = $(this).data('id');
        $.ajax({
            url: '<?php echo $action_getcandidate;?>',
            type: 'POST',
            dataType: 'json',
            data: {id: candidateid},
            success: function(data) {
                console.log(data);
                $.each(data, function(index, val) {
                     $('[name="'+index+'"]').val(val);
                });
            }
        });
                    
    });
});
</script>
<script>
jQuery(document).ready(function($) {
    $('.change_status').click(function(event) {
        if ($(this).is(':checked')) {
            var value = $(this).val();
            var id = $(this).data('id');
            window.location.href = '<?php echo $action_status;?>/' + id + '/' + value;
        }
    });
});
</script>
<script>
jQuery(document).ready(function($) {
    $('#confirm').on('show.bs.modal', function (e) {
        var id = $(e.relatedTarget).data('id');
        var action = '<?php echo $action_del;?>' + '/' + id;
        $('#confirm form').attr('action', action);
    });
    $('#confirm').on('hide.bs.modal', function (e) {
        $('#confirm form').attr('action', '');
    });
});
</script>
<script>
jQuery(document).ready(function($) {
    <?php if(empty($image)) { ?>
    $('#delete_image').hide();
    $('#edit_image').hide();
    $('[name="image"]').hide();
    <?php } else { ?>
    $('#delete_image').show();
    $('#edit_image').show();
    $('[name="image"]').hide();
    $('#add_image').hide();
    <?php } ?>
   function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview_image').show();
            $('#preview_image').attr('src', e.target.result);
            $('#add_image').hide();
            $('#edit_image').show();
            $('#delete_image').show();
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    $('[name="image"]').change(function() {
      readURL(this);
    });

    $('#add_image,#edit_image').click(function(event) {
        $('[name="image"]').trigger('click');
    });

    $('#delete_image').click(function(event) {
        $('[name="image"]').val('');
        $('#preview_image').attr('src','');
        $('#preview_image').hide();
        $('#delete_image').hide();
        $('#edit_image').hide();
        $('#add_image').show();
    });


    $('#btn_search_member').click(function(event) {
        $('#btn_search_member').html('กำลังค้นหา...').attr('disabled','disabled');
        var arr = $('#form_search_member').serializeArray();
        var obj = new Object();
        $.each(arr, function(index, val) {
             obj[val.name] = val.value;
        });
        
        $.ajax({
            url: '<?php echo $base_url;?>Member/getLists',
            type: 'POST',
            dataType: 'json',
            data: obj,
            success: function(data) {
                $('#btn_search_member').html('ค้นหา').removeAttr('disabled');
                console.log(data);
                if (data.data.length>0) {
                    var html = '';
                    $.each(data.data, function(index, val) {
                        console.log(val);
                        html += '<tr>';
                        html += '<td>'+val.member_no+'</td>';
                        html += '<td>'+val.name+'</td>';
                        html += '<td>'+val.id_card+'</td>';
                        html += '<td><button type="button" class="btn btn-default selected_member" data-id="'+val.id+'">เลือกสมาชิก</button></td>';
                        html += '</tr>';
                    });
                    $('#tableListSearchMember tbody').html(html);
                }
            }
        })
        .fail(function(){
            $('#btn_search_member').html('ค้นหา').removeAttr('disabled');
        });
    });

    $('#tableListSearchMember').on('click', '.selected_member', function(event) {
        var memberid = $(this).data('id');
        // console.log('click search');
        $.ajax({
            url: '<?php echo $base_url;?>Member/getList',
            type: 'POST',
            dataType: 'json',
            data: {id: memberid},
            success: function(data) {
                console.log(data);
                $('#select_members').modal('hide');
                $.each(data, function(index, val) {
                    $('#pills-profile input[name="'+index+'"]').val(val);
                });
                var tempname = data.prefix_name+' '+data.firstname+' '+data.lastname;
                $('[data-target="#select_members"]').html(tempname);
                $('#pills-profile [name="member_id"]').val(data.id);
                
            }
        });
        
    });

    $('#btnsubmit').click(function(event) {
        $('#btnsubmit').addClass('disabled').attr('disabled','disabled');
        $("#formcandidate").submit();
    });
});
</script>