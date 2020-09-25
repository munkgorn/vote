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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">ปีบัญชี</label>
                                    <div class="col-sm-8">
                                        <select id="filteryear" class="form-control">
                                            <option></option>
                                            <?php foreach ($years as $value) { ?>
                                            <option value="<?php echo $value; ?>" <?php echo !empty($year)&&$year==$value?'selected':'';?>><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">วาระการสรรหาชุดที่</label>
                                    <div class="col-sm-8">
                                        <select id="filterset" class="form-control"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 text-right"><button class="btn btn-info" id="search">ค้นหา</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row hide" id="data">
            <input type="hidden" name="recruiting_id" value="">
            <input type="hidden" name="type_id" value="">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="text-danger" id="type_name">ผู้ตรวจสอบกิจการ</h3>
                                <p class="text-danger">จำนวนผู้รับเลือกเข้ารับตำแหน่ง <span id="receiving">0</span> คน จำนวนสำรองผลการลงคะแนน <span id="reserve"></span> คน</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-info" type="button" id="print" data-recruitingid="" data-typeid="">Print</button>
                                <button class="btn btn-success" type="button" id="countscore">นับคะแนน</button>
                                <button class="btn btn-success" type="button" id="confirmscore">ยืนยันผลการลงคะแนน</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับที่</th>
                                        <th>หมายเลขผู้สมัคร</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>หมายเลขสมาชิก</th>
                                        <th>จังหวัด</th>
                                        <th>คะแนน</th>
                                        <th>การรับรองสิทธิ์</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ลำดับที่</th>
                                        <th>หมายเลขผู้สมัคร</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>หมายเลขสมาชิก</th>
                                        <th>จังหวัด</th>
                                        <th>คะแนน</th>
                                        <th>การรับรองสิทธิ์</th>
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
<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document " style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white" id="exampleModalLabel">เลือกวาระการลรรหา</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true ">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="popup_table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">ลำดับที่</th>
                                        <th>วาระการสรรหา</th>
                                        <th>ตำแหน่ง</th>
                                        <th>ชุดที่</th>
                                        <th>ปีบัญชีที่</th>
                                        <th>ครั้งที่</th>
                                        <th>สถานะ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>สรรหาคณะกรรมการดำเนินการ</td>
                                        <td>ผู้ตรวจสอบกิจการ</td>
                                        <td>47/48</td>
                                        <td>2561</td>
                                        <td>8</td>
                                        <td>Complete</td>
                                        <td><button class="btn btn-success" id="show_data" data-dismiss="modal" aria-label="Close">เลือก</button></td>
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
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                     <div class="col-md-12 text-right">
                        <button class="btn btn-default" data-dismiss="modal" aria-label="Close">ยกเลิก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function($) {
    $('#confirmscore').hide();

    <?php if (!empty($recruitingid)&&!empty($typeid)&&!empty($year)&&!empty($set)) { ?>
    var postyear = '<?php echo $year;?>';
    var postset = '<?php echo $set;?>';
    var recruitingid = '<?php echo $recruitingid;?>';
    var typeid = '<?php echo $typeid;?>';
    $('#filteryear').trigger('change');
    console.log(postyear);
    console.log(postset);
    $.ajax({
        url: '<?php echo $base_url?>Recruiting/ajaxFilterSetByYear',
        type: 'POST',
        dataType: 'json',
        data: {year: postyear},
        success: function(data) {
            var option = '';
            $.each(data.sets, function(index, val) {
                 option += '<option value="'+val+'" '+(postset==val?'selected':'')+'>'+val+'</option>';
            });
            $('#filterset').html(option);
            $('#filterset option[value="'+postset+'"]').attr('selected','selected');

            $.ajax({
            url: '<?php echo $base_url;?>Candidate/ajaxGetCandidates/'+recruitingid+'/'+typeid,
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                if (data.length>0) {
                    var html = '';
                    var i = 1;
                    $.each(data, function(index, val) {
                        html += '<tr>';
                        html += '<td>'+val.candidate_no+'</td>';
                        html += '<td>'+i+'</td>';
                        html += '<td>'+val.name+'</td>';
                        html += '<td>'+val.member_no+'</td>';
                        html += '<td>'+val.member_group_name+'</td>';
                        html += '<td>'+val.score+'</td>';
                        html += '<td>';
                        html += '<select class="form-control select_status" data-id="'+val.id+'">';
                        html += '<option></option>';
                        html += '<option value="pass" '+(val.status_pass=="pass"?'selected':'')+'>ผ่านการเลือกตั้ง</option>';
                        html += '<option value="sub" '+(val.status_pass=="sub"?'selected':'')+'>สำรอง</option>';
                        html += '<option value="no" '+(val.status_pass=="no"?'selected':'')+'>ไม่ผ่าน</option>';
                        html += '</select>';
                        html += '</td>';
                        html += '</tr>';
                        i++;
                        $('#type_name').html(val.type_name);
                        $('#receiving').html(val.receiving);
                        $('#reserve').html(val.reserve);
                        $('[name="recruiting_id"]').val(val.recruiting_id);
                        $('[name="type_id"]').val(val.type_id);
                    });
                    $('#Modal1').modal('hide');
                    $('#data').show();

                    $('#data #zero_config tbody').html(html);
                } else {
                    var html = '<tr><td colspan="6" class="text-center">ไม่พบ</td></tr>';
                    $('#Modal1').modal('hide');
                    $('#data').show();
                    $('#data #zero_config tbody').html(html);
                }
            }
        });
        }
    });
    <?php } ?>

    $('#filteryear').change(function(event) {
        $('#data').hide();
        $('#data #zero_config tbody').html('');
        $.ajax({
            url: '<?php echo $base_url?>Recruiting/ajaxFilterSetByYear',
            type: 'POST',
            dataType: 'json',
            data: {year: $(this).val()},
            success: function(data) {
                var option = '';
                $.each(data.sets, function(index, val) {
                     option += '<option value="'+val+'">'+val+'</option>';
                });
                $('#filterset').html(option);
            }
        });
    });
    $('#popup_table').DataTable({
        destory: true
    });
    $('#search').click(function(event) {
        $.ajax({
            url: '<?php echo $base_url;?>Recruiting/ajaxFilterCandidate',
            type: 'POST',
            dataType: 'json',
            data: {year: $('#filteryear').val(), setvalue: $('#filterset').val()},
            success: function(data) {
                console.log(data);  
                $('#popup_table').DataTable().clear();
                $('#popup_table').DataTable().destroy();
                $('#popup_table tbody').html('');
                var html = '';
                $.each(data.lists, function(index, val) {
                    html += '<tr>';
                    html += '<td>'+val.i+'</td>';
                    html += '<td>'+val.recruiting_type+'</td>';
                    html += '<td>'+val.type_name+'</td>';
                    html += '<td>'+val.set+'</td>';
                    html += '<td>'+val.year+'</td>';
                    html += '<td>'+val.no+'</td>';
                    html += '<td>'+val.status+'</td>';
                    html += '<td><button class="btn btn-primary select_candidate" data-typeid="'+val.type_id+'" data-recruitingid="'+val.recruiting_id+'">เลือก</button></td>';
                    html += '</tr>';
                });
                $('#Modal1').modal('show');
                $('#popup_table tbody').html(html);
                $('#popup_table').DataTable({
                    destory: true
                });
            }
        });
    });
    $('#popup_table').on('click', '.select_candidate', function(event) {
        var recruitingid = $(this).data('recruitingid');
        var typeid = $(this).data('typeid');
        $('#print').attr('data-recruitingid', recruitingid);
        $('#print').attr('data-typeid', typeid);        
        $.ajax({
            url: '<?php echo $base_url;?>Candidate/ajaxGetCandidates/'+recruitingid+'/'+typeid,
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data.length>0) {
                    var html = '';
                    var i = 1;
                    $.each(data, function(index, val) {
                        html += '<tr>';
                        html += '<td>'+i+'</td>';
                        html += '<td>'+val.candidate_no+'</td>';
                        html += '<td>'+val.name+'</td>';
                        html += '<td>'+val.member_no+'</td>';
                        html += '<td>'+val.member_group_name+'</td>';
                        html += '<td>'+val.score+'</td>';
                        html += '<td>';
                        html += '<select class="form-control select_status" data-id="'+val.id+'">';
                        html += '<option></option>';
                        html += '<option value="pass" '+(val.status_pass=="pass"?'selected':'')+'>ผ่านการเลือกตั้ง</option>';
                        html += '<option value="sub" '+(val.status_pass=="sub"?'selected':'')+'>สำรอง</option>';
                        html += '<option value="no" '+(val.status_pass=="no"?'selected':'')+'>ไม่ผ่าน</option>';
                        html += '</select>';
                        html += '</td>';
                        html += '</tr>';
                        i++;
                        $('#type_name').html(val.type_name);
                        $('#receiving').html(val.receiving);
                        $('#reserve').html(val.reserve);
                        $('[name="recruiting_id"]').val(val.recruiting_id);
                        $('[name="type_id"]').val(val.type_id);
                    });
                    $('#Modal1').modal('hide');
                    $('#data').show();

                    $('#data #zero_config tbody').html(html);
                } else {
                    var html = '<tr><td colspan="6" class="text-center">ไม่พบ</td></tr>';
                    $('#Modal1').modal('hide');
                    $('#data').show();
                    $('#data #zero_config tbody').html(html);
                }
            }
        });
    });

    $('#data').on('change', '.select_status', function(event) {
        var candidateid = $(this).data('id');
        $.ajax({
            url: '<?php echo $base_url;?>Candidate/ajaxUpdateStatusCandidate/'+candidateid,
            type: 'POST',
            dataType: 'json',
            data: {status: $(this).val()},
            success: function(data) {
                if (data==1) {
                    toastr.success('อัพเดทการรับรองสิทธิ์เรียบร้อยแล้ว','สำเร็จ');
                } else {
                    toastr.error('เกิดข้อผิดพลาดในการอัพเดทรับรองสิทธิ์','ผิดพลาด');
                }
            }
        });
    });

    $('#countscore').click(function(event) {
        var recruitingid = $('#data [name="recruiting_id"]').val();
        var year = $('#filteryear').val();
        var set = $('#filterset').val();
        var typeid = $('#data [name="type_id"]').val();
        // console.log(typeid);
        window.location.href = '<?php echo $base_url;?>Candidate/countScore/'+recruitingid+'/'+typeid+'/'+year+'/'+set;
        window.open('<?php echo $base_url;?>Candidate/exportPrint/'+recruitingid+'/'+typeid, 'new');
    });

    $('#print').click(function(event) {
        var recruiting_id = $('#data [name="recruiting_id"]').val();
        var type_id = $('#data [name="type_id"]').val();
        // console.log(recruiting_id);
        // console.log(type_id);
        window.open('<?php echo $base_url;?>Candidate/exportPrint/'+recruiting_id+'/'+type_id, 'new');
    });
});
</script>