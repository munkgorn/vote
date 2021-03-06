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
                                                                <?php echo $candidate['status']==1?'อนุมัติ':'ตัดสิทธิ์';?>
                                                                
                                                            </td>
                                                            <td>
                                                                <a href="<?php echo $base_url;?>Candidate/View/<?php echo $candidate['recruiting_id'];?>/<?php echo $candidate['id'];?>" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
                                                                <!-- <button type="button" data-toggle="modal" data-target="#confirm" class="btn btn-danger btn-sm" data-id="<?php echo $candidate['id'];?>"><i class="fas fa-trash-alt text-white"></i></button> -->
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
                                        <div class="row">
                                            <!-- <div class="col-12 text-right mt-5 mb-2"><button type="button" class="btn btn-warning">เพิ่มผู้สมัคร</button></div> -->
                                            <div class="col-12">
                                                
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <td>IMAGE</td>
                                                            <td>
                                                                <?php if(!empty($image)) { ?>
                                                                <img src="<?php echo $image;?>" alt="" id="preview_image" class="img-fluid">
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>สร้างในนาม</td>
                                                            <td>
                                                                <?php echo $author; ?>
                                                            </td>
                                                            <td>วันที่สมัคร</td>
                                                            <td>
                                                                <?php echo $date_register; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>ชื่อ-นามสกุล</td>
                                                            <td colspan="3">
                                                                <?php echo $member_name; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>สมาชิกเลขที่</td>
                                                            <td><?php echo $member_no; ?></td>
                                                            <td>อายุ</td>
                                                            <td><?php echo $age; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>ปัจจุบันดำรงค์ตำแหน่ง</td>
                                                            <td><?php echo $position; ?></td>
                                                            <td>เป็นสมาชิกสหกรณ์</td>
                                                            <td>
                                                                <p><?php echo $member_year; ?> ปี <?php echo $member_month; ?> เดือน</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>สังกัด</td>
                                                            <td colspan="3">
                                                            <?php echo $member_group_name; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>โทรศัพท์</td>
                                                            <td><?php echo $phone_office; ?></td>
                                                            <td>ตำแหน่งที่สมัคร</td>
                                                            <td>
                                                                <?php foreach ($recruiting_types as $recruiting_type) { ?>
                                                                <?php echo $type_id== $recruiting_type->recruiting_committee_id ? $recruiting_type->committee_name : '';?>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>โทรศัพท์มือถือ</td>
                                                            <td><?php echo $phone; ?></td>
                                                            <td>เลขที่ผู้สมัคร</td>
                                                            <td><?php echo $candidate_no; ?></td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <!-- <button class="btn btn-default" type="submit" id="btnsubmit"><?php echo $button_title; ?></button> -->
                                                <a href="<?php echo $base_url;?>Recruiting" class="btn btn-secondary">กลับไป</a>
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
        startDate: 'today'
    });

    <?php if ($date_register) { ?>
        console.log('<?php echo $date_register;?>');
        $('[name="date_register"]').datepicker('destroy');
        $('[name="date_register"]').datepicker({
            language: 'th',
            format: 'dd-mm-yyyy',
            autoclose: true,
            startDate: 'today'
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