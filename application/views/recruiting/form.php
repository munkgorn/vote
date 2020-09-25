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
                        <h4 class="card-title text-danger">สร้างวาระการสรรหา STEP 1 OF 2</h4>
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-pills mb-3 w-100" id="pills-tab" role="tablist">
                                    <li class="nav-item w-50">
                                        <a class="nav-link active p-3" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><h3 class="mb-0">1 สร้างวาระการสรรหา</h3></a>
                                    </li>
                                    <li class="nav-item w-50">
                                        <a class="nav-link p-3" id="pills-profile-tab-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><h3 class="mb-0">2 เพิ่มข้อมูลผู้สรรหา</h3></a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">


                                        <form action="<?php echo $action; ?>" method="POST">
                                        <div class="row">
                                            <div class="col-12">
                                                <p>รายละเอียดวาระ</p>
                                                <table class="table table-bordered">
                                                    <tbody>
                                                    	<tr>
                                                    		<td>ลำดับที่</td>
                                                    		<td colspan="3">
                                                    			<input type="number" name="sort" class="form-control" value="<?php echo $sort;?>" required>
                                                    		</td>
                                                    	</tr>
                                                        <tr>
                                                            <td>ชุดที่</td>
                                                            <td><input type="text" name="set" class="form-control" value="<?php echo $set; ?>"></td>
                                                            <td>ปีบัญชีที่</td>
                                                            <td><input type="text" name="year" class="form-control" value="<?php echo $year; ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>ครั้งที่สรรหา</td>
                                                            <td><input type="text" name="no" class="form-control" value="<?php echo $no; ?>"></td>
                                                            <td>ประเภทการสรรหา</td>
                                                            <td>
                                                                <select name="recruiting_type" id="" class="form-control">
                                                                    <option value="">กรุณาเลือก...</option>
                                                                    <option value="committee" <?php echo ($recruiting_type=='committee'?'selected':''); ?>>สรรหาคณะกรรมการดำเนินการ</option>
                                                                    <option value="members" <?php echo ($recruiting_type=='members'?'selected':''); ?>>สรรหาผู้แทนสมาชิก</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-12">
                                                <div id="option_committee" class="select-hide" style="display: none;">
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
                                                            <?php foreach ($committees as $value) { ?>
                                                            <tr>
                                                                <td><input type="checkbox" name="committee[<?php echo $value->id;?>]" class="form-control" value="1" <?php echo isset($committee[$value->id])&&$committee[$value->id]==1 ? 'checked' : '' ?>></td>
                                                                <td><?php echo $value->name; ?></td>
                                                                <td><input type="text" name="committee_receiving[<?php echo $value->id;?>]" class="form-control" value="<?php echo isset($committee_receiving[$value->id])&&$committee_receiving[$value->id]>0 ? $committee_receiving[$value->id] : '' ?>"></td>
                                                                <td><input type="text" name="committee_reserve[<?php echo $value->id;?>]" class="form-control" value="<?php echo isset($committee_reserve[$value->id])&&$committee_reserve[$value->id]>0 ? $committee_reserve[$value->id] : '' ?>"></td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div id="option_members" class="select-hide" style="display: none;">
                                                    <div class="row">
                                                        <div class="col-sm-12 text-right">
                                                            <?php if (!empty($export_member)) { ?>
                                                            <a href="<?php echo $export_member;?>" target="new" class="btn btn-primary">Export กลุ่ม</a>
                                                            <?php } ?>
                                                            <?php if (!empty($import_group)): ?>
                                                            <button type="button" class="btn btn-primary" data-target="#modalimportgroup" data-toggle="modal">Import กลุ่ม</button>
                                                            <?php endif ?>
                                                            
                                                        </div>
                                                    </div>
                                                    <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                                                        <?php foreach ($regions as $key => $region) { ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link <?php echo $key==0?'active':'';?>" id="tab-<?php echo $region->id;?>" data-toggle="pill" href="#region-<?php echo $region->id;?>" role="tab" aria-controls="region-<?php echo $region->id;?>" aria-selected="<?php echo $key==0?'true':'';?>"><?php echo $region->name; ?></a>
                                                        </li>
                                                        <?php } ?>
                                                    </ul>
                                                    <div class="tab-content" id="pills-tabContent">
                                                        <?php foreach($regions as $key => $region) { ?>
                                                        <div class="tab-pane fade show <?php echo $key==0?'active':''; ?>" id="region-<?php echo $region->id;?>" role="tabpanel" aria-labelledby="tab-<?php echo $region->id;?>">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h3><?php echo $region->name; ?></h3>
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
                                                                            <?php foreach ($region->member_groups as $value) { ?>
                                                                            <tr>
                                                                                <td><input type="checkbox" name="member_group[<?php echo $value->id;?>]" data-id="<?php echo $value->id;?>" class="form-control cb_member" value="1" <?php echo isset($member_group[$value->id])&&$member_group[$value->id]==1 ? 'checked' : '' ?>></td>
                                                                                <td><?php echo $value->name; ?></td>
                                                                                <td><input type="text" name="member_receiving[<?php echo $value->id;?>]" class="cb_input input<?php echo $value->id;?> form-control" value="<?php echo isset($member_group_receiving[$value->id])&&$member_group_receiving[$value->id]>0 ? $member_group_receiving[$value->id] : '' ?>"></td>
                                                                                <td><input type="text" name="member_reserve[<?php echo $value->id;?>]" class="cb_input input<?php echo $value->id;?> form-control" value="<?php echo isset($member_group_reserve   [$value->id])&&$member_group_reserve   [$value->id]>0 ? $member_group_reserve [$value->id] : '' ?>"></td>
                                                                            </tr>
                                                                            <?php } ?>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td>รายละเอียดเพิ่มเติม</td>
                                                            <td colspan="3"><textarea name="detail" id="" cols="30" rows="5" class="form-control"><?php echo $detail; ?></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td>วันที่เปิดรับสมัคร</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <div class="input-group">
                                                                            <input type="text" name="date_register_start" class="form-control datepicker" placeholder="วว-ดด-ปปปป">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="time" class="form-control" name="time_register_start" value="<?php echo $time_register_start;?>">
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                            </td>
                                                            <td>ถึงวันที่</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <div class="input-group">
                                                                            <input type="text" name="date_register_end" class="form-control datepicker" placeholder="วว-ดด-ปปปป">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="time" class="form-control" name="time_register_end" value="<?php echo $time_register_end;?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>กำหนดวันลงคะแนน</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <div class="input-group">
                                                                            <input type="text" name="date_score_start" class="form-control datepicker" placeholder="วว-ดด-ปปปป">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="time" class="form-control" name="time_score_start" value="<?php echo $time_score_start;?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            </td>
                                                            <td>ปิดลงคะแนน</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <div class="input-group">
                                                                            <input type="text" name="date_score_end" class="form-control datepicker" placeholder="วว-ดด-ปปปป">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="time" class="form-control" name="time_score_end" value="<?php echo $time_score_end;?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6"><h4>เอกสารการสมัคร</h4></div>
                                            <div class="col-6 text-right"><button class="btn btn-warning" type="button" data-toggle="modal" data-target="#add_file">เพิ่มเอกสาร</button></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="hidden" name="file" value="">
                                                <table class="table table-bordered" id="table_document">
                                                    <thead class="bg-primary">
                                                        <tr>
                                                            <th><p class="text-white mb-0">ประเภทเอกสาร</p></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-12 text-center">
                                                <a href="<?php echo $action_back;?>" class="btn btn-secondary" >ย้อนกลับ</a>
                                                <?php if ($has_candidate==true) { ?>
                                                <a href="<?php echo $action_next;?>" class="btn btn-primary">ดำเนินการต่อ</a>
                                                <?php } else { ?>
                                                <button class="btn btn-primary" type="submit">ดำเนินการต่อ</button>
	                                            <?php } ?>
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
                                    <?php foreach ($documents as $document) { ?>
                                    <tr>
                                        <td><input type="checkbox" name="document" class="form-control" data-title="<?php echo $document->name;?>" value="<?php echo $document->id;?>"></td>
                                        <td><?php echo $document->name;?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 text-right">
                            <button class="btn btn-info" id="confirm_file">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalimportgroup">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?php echo $import_group;?>" method="post" enctype="multipart/form-data">
                <div class="modal-header text-left">
                    <h4 class="modal-title">Import จำนวนวาระสรรหาผู้แทนสมาชิก</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="control-label float-left">ไฟล์</label>
                        <input type="file" name="importfile" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Import">
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
        
    <style>
    #preview_image { width:300px; }
    span.select2.select2-container { width: 100% !important; height: 35px !important; }
    .select2-container--default .select2-selection--single { border: 1px solid #eef1f3 !important; height: 35px; padding: 5px; }
    [class^='select2'] { border-radius: 2px !important; }
    </style>

    <!-- Date Event -->
    <script>
    jQuery(document).ready(function($) {
        var rangedate_register       = 0;
        var rangedate_regis_to_score = 0;
        var rangedate_scrore         = 0;

        $.fn.datepicker.dates['th'] = {
            days: ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤ", "ศุกร์", "เสาร์"],
            daysShort: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
            daysMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
            months: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
            monthsShort: ["ม.ค.", "ก.พ.", "มี.ค.", "ม.ย.", "พ.ค.", "ม.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
            today: "วันนี้",
            clear: "ล้าง",
            format: "dd-mm-yyyy",
            titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0
        };

        $('.datepicker').datepicker({
            language: 'th',
            todayBtn: true,
            format: 'dd-mm-yyyy',
            autoclose: true,
            // startDate: 'today',
            todayHighlight: true
        });

        // Set POST Value
        <?php if ($date_register_start) { ?>
            console.log('<?php echo $date_register_start;?>');
        $('[name="date_register_start"]').removeAttr('disabled');    
        //$('[name="date_register_start"]').datepicker('startDate', '<?php echo $date_register_start;?>' );
        $('[name="date_register_start"]').datepicker('setDate', '<?php echo $date_register_start;?>');

        <?php } ?>
        <?php if ($date_register_end) { ?>
            console.log('<?php echo $date_register_end;?>');
        $('[name="date_register_end"]').removeAttr('disabled');  
        //$('[name="date_register_end"]').datepicker('startDate', '<?php echo $date_register_end;?>' );
        $('[name="date_register_end"]').datepicker('setDate', '<?php echo $date_register_end;?>');

        <?php } ?>
        <?php if ($date_score_start) { ?>
            console.log('<?php echo $date_score_start;?>');
        $('[name="date_score_start"]').removeAttr('disabled');  
        //$('[name="date_score_start"]').datepicker('startDate', '<?php echo $date_score_start;?>' );
        $('[name="date_score_start"]').datepicker('setDate', '<?php echo $date_score_start;?>');

        <?php } ?>
        <?php if ($date_score_end) { ?>
            console.log('<?php echo $date_score_end;?>');
        $('[name="date_score_end"]').removeAttr('disabled');    
        //$('[name="date_score_end"]').datepicker('startDate', '<?php echo $date_score_end;?>' );
        $('[name="date_score_end"]').datepicker('setDate', '<?php echo $date_score_end;?>');

        <?php } ?>

        // $('[name="date_register_start"]').on('changeDate', function(e) {
        //     var newdate = getDateEnd($(this).val(), rangedate_register);
        //     $('[name="date_register_end"]').datepicker('setStartDate', newdate);
        //     $('[name="date_register_end"]').datepicker('setDate', newdate);
        // });

        // $('[name="date_register_end"]').on('changeDate', function(e) {
        //     var newdate = getDateEnd($(this).val(), rangedate_regis_to_score);
        //     $('[name="date_score_start"]').datepicker('setStartDate', newdate);
        //     $('[name="date_score_start"]').datepicker('setDate', newdate);
        // });

        // $('[name="date_score_start"]').on('changeDate', function(e) {
        //     var newdate = getDateEnd($(this).val(), rangedate_scrore);
        //     $('[name="date_score_end"]').datepicker('setStartDate', newdate);
        //     $('[name="date_score_end"]').datepicker('setDate', newdate);
        // });

        function getDateEnd(startdate, enddate=1) {
            var str_date = startdate.split('-');
            var date     = new Date(str_date[2], str_date[1], str_date[0]);
            var year     = date.getFullYear().toString();
            var month    = (date.getMonth()).toString();
            var day      = (date.getDate()+enddate).toString();
            var new_date = day+'-'+month+'-'+year;
            return new_date;
        }
        // date function
    });
    </script>
    <!-- Date Event -->

    <!-- Type Event -->
    <script>
    jQuery(document).ready(function($) {


    <?php if ($has_candidate==true) { ?>
    // $('#pills-home input,#pills-home select,#pills-home textarea').attr('disabled', 'disabled');
    $('[data-target="#add_file"]').hide();
    <?php } ?>

        // Set POST Value
        <?php if ($recruiting_type=='committee') { ?>
            $('#option_members').slideUp(100);
            $('#option_committee').slideDown('fast');
        <?php } ?>
        <?php if ($recruiting_type=='members') { ?>
            $('#option_committee').slideUp(100);
            $('#option_members').slideDown('fast');
        <?php } ?>

        $('[name="recruiting_type"]').change(function(event) {
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
    <!-- Type Event -->

    <!-- None Next Tab Event -->
    <script>
    jQuery(document).ready(function($) {
        $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
            $('#pills-profile-tab-tab').removeClass('active');
            $('#pills-profile-tab-tab').removeClass('show');
            $('#pills-profile-tab-tab').attr('aria-selected', false);
            $('#pills-home-tab').addClass('active');
            $('#pills-home-tab').addClass('show');
            $('#pills-home-tab').attr('aria-selected', true);
        });
    });
    </script>
    <!-- None Next Tab Event -->

    <!-- File Checkbox Event -->
    <script>
    jQuery(document).ready(function($) {

        <?php if (!empty($filelist)) { ?>
        $('[name="file"]').val('<?php echo $filelist;?>');
        <?php } ?>

        var html = '';
        <?php if (!empty($file)) { ?>
            <?php foreach ($file as $key => $value) { ?>
            html += '<tr>';
            html += '<td><input type="hidden" name="file[<?php echo $key;?>]" value="1"><?php echo $value;?></td>';
            html += '</tr>';
            $('#add_file [name="document"][data-title="<?php echo $value;?>"]').prop('checked', true);
            <?php } ?>
            $('#table_document tbody').html(html);
        <?php } ?>


        $('#confirm_file').click(function(event) {
            var html = '';
            var value = new Array();
            $('#add_file [name="document"]').each(function(index, el) {
                if ($(this).is(':checked')) {
                    html += '<tr>';
                    html += '<td><input type="hidden" name="file['+$(this).val()+']" value="1">'+$(this).data('title')+'</td>';
                    html += '</tr>';
                    value.push($(this).val());
                }
            });
            $('#table_document tbody').html(html);
            $('#add_file').modal('hide');
            $('#add_file [name="document"]').prop('checked', false);
            $('[name="file"]').val(value.join(','));
        });
    });
    </script>
    <!-- File Checkbox Event -->

    <!-- Checkbox สรรหา -->
    <script>
    jQuery(document).ready(function($) {
        $('.cb_member').change(function(event) {
            var checked = $(this).prop('checked');
            var id = $(this).data('id');
            $('.cb_member').prop('checked', false);
            $('.cb_input').val('');
            $('.cb_input').removeAttr('required');
            $('.cb_input').attr('disabled','disabled');
            if (checked==true) {
                $(this).prop('checked', true);
                $('.cb_input.input'+id).removeAttr('disabled');
                $('.cb_input.input'+id).attr('required','required');
                $('.cb_input.input'+id+':eq(0)').focus();
            }
        });
    });
    </script>
    <!-- Checkbox สรรหา -->
</div>
