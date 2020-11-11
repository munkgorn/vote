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
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">ลำดับที่</th>
                                        <th>วาระการสรรหา</th>
                                        <th>ตำแหน่ง</th>
                                        <th width="9%">ชุดที่</th>
                                        <th width="9%">ปีบัญชีที่</th>
                                        <th width="9%">ครั้งที่</th>
                                        <th class="text-center" width="20%">รายงาน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recruitings as $recruiting) { ?>
                                    <tr>
                                        <td class="text-center"><?php echo $recruiting['id']; ?></td>
                                        <td><?php echo $recruiting['name']; ?></td>
                                        <td><?php echo $recruiting['list']; ?></td>
                                        <td><?php echo $recruiting['set']; ?></td>
                                        <td><?php echo $recruiting['year']; ?></td>
                                        <td><?php echo $recruiting['no']; ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-default" data-toggle="modal" data-id="<?php echo $recruiting['id'];?>" data-target="#Modaltable"><i class="fas fa-table"></i></button>
                                            <!-- <a href="#" target="new" class="btn btn-default"><i class="fas fa-table"></i></a> -->
                                            <?php if ($recruiting['type']=='member') { ?>
                                            <button class="btn btn-default" data-toggle="modal" data-id="<?php echo $recruiting['id'];?>" data-target="#chart_bar"><i class="fas fa-chart-bar"></i></button>
                                            <button class="btn btn-default" data-toggle="modal" data-id="<?php echo $recruiting['id'];?>" data-target="#chart_pie"><i class="fas fa-chart-pie"></i></button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">ลำดับที่</th>
                                        <th>วาระการสรรหา</th>
                                        <th>ตำแหน่ง</th>
                                        <th>ชุดที่</th>
                                        <th>ปีบัญชีที่</th>
                                        <th>ครั้งที่</th>
                                        <th class="text-center">รายงาน</th>
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
<div class="modal fade" id="Modaltable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document " style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">รายงานแสดงจำนวนผู้มาใช้สิทธิแยกตามกลุ่มของแต่ละวาระ</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a class="btn btn-info" id="exportExcel" target="new"><i class="fas fa-file-excel"></i> EXPORT</a>
                    </div>
                    <div class="col-md-12 text-center">
                        <h3>รายงานแสดงจำนวนผู้มาลงคะแนน สรรหาคณะกรรมการดำเนินการ</h3>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-bordered" id="tableMemberGroup">
                            <thead>
                                <tr>
                                    <th width="30%">กลุ่มเขต</th>
                                    <th>จำนวนผู้มีสิทธิทั้งหมด</th>
                                    <th>จำนวนผู้มาลงคะแนน</th>
                                    <th>จำนวนผู้ไม่มาลงคะแนน</th>
                                    <th>จำนวนผู้มาลงคะแนนคิดเป็นร้อยละ</th>
                                    <th>จำนวนผู้ไม่ออกเสียง(Voteno)</th>
                                    <th>จำนวนผู้ไม่ออกเสียง คิดเป็นร้อยละ</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-center">รวม</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">%</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">%</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">ปิด</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="chart_bar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document " style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">กราฟแสดงจำนวนผู้มาลงคะแนนวาระการสรรหาผู้แทนสมาชิก เรียงตามร้อยละผู้มาใช้สิทธิ์ที่มากที่สุด</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">ภาค</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="colunm_recruitingid" value="">
                                <select name="" id="column_region" class="form-control">
                                    <option value="">-- Select --</option>
                                    <?php foreach ($region as $r) { ?>
                                    <option value="<?php echo $r->id; ?>"><?php echo $r->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">กลุ่ม</label>
                            <div class="col-sm-10">
                                <select name="" id="column_membergroup" class="form-control">
                                    <option value="">-- Select --</option>
                                </select>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-md-12">

                            <div id="column_chart"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">ปิด</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="chart_pie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document " style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">กราฟแสดงสัดส่วนผู็มาใช้สิทธิ์ กลุ่ม</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- <div class="col-md-6">
                        <div class="form-group row">
                            <input type="hidden" name="pie_recruitingid" value="">
                            <label for="inputPassword" class="col-sm-2 col-form-label">ภาค</label>
                            <div class="col-sm-10">
                                <select name="" id="pie_region" class="form-control">
                                    <option value="">-- Select --</option>
                                    <?php foreach ($region as $r) { ?>
                                    <option value="<?php echo $r->id; ?>"><?php echo $r->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">กลุ่ม</label>
                            <div class="col-sm-10">
                                <select name="" id="pie_membergroup" class="form-control">
                                    <option value="">-- Select --</option>
                                </select>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- <div class="pie" style="height: 400px;"></div> -->
                        <div id="pie_chart"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">ปิด</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
jQuery(document).ready(function($) {
});
</script>
<script>
jQuery(document).ready(function($) {
    $('#zero_config').dataTable({
        destroy: true, 
        columnDefs: [
            { targets:6, orderable: false }
        ]
    });


    $('#pie_region').change(function(event) {
        var recruitingid = $('[name="pie_recruitingid"]').val();
        var html = '<option>กำลังโหลด</option>';
        $('#pie_membergroup').html(html);
        $.ajax({
            url: '<?php echo $base_url;?>Report/ajaxFindMemberGroup',
            type: 'POST',
            dataType: 'json',
            data: {region_id: $(this).val()},
            success: function(data) {
                var html = '<option>-- เลือก --</option>';
                $.each(data, function(index, val) {
                     html += '<option value="'+val.id+'">'+val.name+'</option>';
                });
                $('#pie_membergroup').html(html);
            }
        });
        
        // $('#pie_chart').html('<p class="text-center>กำลังโหลด</p>');
        $.ajax({
            url: '<?php echo $base_url;?>Report/ajaxPieChart/'+recruitingid,
            type: 'POST',
            dataType: 'json',
            data: {region_id: $(this).val()},
            success: function(datachart) {
                console.log(datachart);

                google.charts.load('current', {packages: ['corechart']});
                google.charts.setOnLoadCallback(function(){
                    var data = google.visualization.arrayToDataTable(datachart);
                    var options_fullStacked = {
                        isStacked: 'percent',
                        height: 600,
                        width: '100%',
                        // bar: { groupWidth: '75%
                        sliceVisibilityThreshold: .1
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
                    chart.draw(data, options_fullStacked);
                });
                
            }
        });
    });
    $('#pie_membergroup').change(function(event) {
        var recruitingid = $('[name="pie_recruitingid"]').val();
        // $('#pie_chart').html('<p class="text-center>กำลังโหลด</p>');
        
        $.ajax({
            url: '<?php echo $base_url;?>Report/ajaxPieChart/'+recruitingid,
            type: 'POST',
            dataType: 'json',
            data: {region_id: $('#pie_region').val(), member_group_id: $(this).val()},
            success: function(datachart) {
                console.log(datachart);
                google.charts.load('current', {packages: ['corechart']});
                google.charts.setOnLoadCallback(function(){
                    var data = google.visualization.arrayToDataTable(datachart);
                    var options_fullStacked = {
                        isStacked: 'percent',
                        height: 600,
                        width: '100%',
                        // bar: { groupWidth: '75%
                        sliceVisibilityThreshold: .1
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
                    chart.draw(data, options_fullStacked);
                });
                
            }
        });
    });

    $('#chart_pie').on('show.bs.modal', function(event) {
        var recruitingid = $(event.relatedTarget).data('id');
        $('[name="pie_recruitingid"]').val(recruitingid);

        $.ajax({
            url: '<?php echo $base_url;?>Report/ajaxPieChart/'+recruitingid,
            type: 'POST',
            dataType: 'json',
            success: function(datachart) {
                console.log(datachart);

                google.charts.load('current', {packages: ['corechart']});
                google.charts.setOnLoadCallback(function(){
                    var data = google.visualization.arrayToDataTable(datachart);
                    var options_fullStacked = {
                        isStacked: 'percent',
                        height: 600,
                        width: '100%',
                        // bar: { groupWidth: '75%
                        sliceVisibilityThreshold: .01
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
                    chart.draw(data, options_fullStacked);
                });
                
            }
        });
        

    });



    $('#column_region').change(function(event) {
        var recruitingid = $('[name="colunm_recruitingid"]').val();
        $.ajax({
            url: '<?php echo $base_url;?>Report/ajaxFindMemberGroup',
            type: 'POST',
            dataType: 'json',
            data: {region_id: $(this).val()},
            success: function(data) {
                var html = '<option></option>';
                $.each(data, function(index, val) {
                     html += '<option value="'+val.id+'">'+val.name+'</option>';
                });
                $('#column_membergroup').html(html);
            }
        });
        
        $.ajax({
            url: '<?php echo $base_url;?>Report/ajaxColumnChart/'+recruitingid,
            type: 'POST',
            dataType: 'json',
            data: {region_id: $(this).val()},
            success: function(datachart) {
                console.log(datachart);

                google.charts.load('current', {packages: ['corechart','bar']});
                google.charts.setOnLoadCallback(function(){
                    var data = google.visualization.arrayToDataTable(datachart);
                    var options_fullStacked = {
                        // isStacked: 'percent',
                        // height: 600,
                        // width: '100%',
                        // bar: { groupWidth: '75%' },
                        // bars: 'vertical',
                        // vAxis: {
                        //     minValue: 0,
                        //     ticks: [0, .3, .6]
                        //   }
                    };

                    var chart = new google.visualization.ColumnChart(document.getElementById('column_chart'));
                    chart.draw(data, options_fullStacked);
                });
                
            }
        });
    });
    $('#column_membergroup').change(function(event) {
        var recruitingid = $('[name="colunm_recruitingid"]').val();
        
        $.ajax({
            url: '<?php echo $base_url;?>Report/ajaxColumnChart/'+recruitingid,
            type: 'POST',
            dataType: 'json',
            data: {region_id: $('#column_region').val(), member_group_id: $(this).val()},
            success: function(datachart) {
                console.log(datachart);
                google.charts.load('current', {packages: ['corechart','bar']});
                google.charts.setOnLoadCallback(function(){
                    var data = google.visualization.arrayToDataTable(datachart);
                    var options_fullStacked = {
                        // isStacked: 'percent',
                        // height: 600,
                        // width: '100%',
                        // bar: { groupWidth: '75%' },
                        // // bars: 'vertical',
                        // vAxis: {
                        //     minValue: 0,
                        //     ticks: [0, .3, .6]
                        //   }
                    };

                    var chart = new google.visualization.ColumnChart(document.getElementById('column_chart'));
                    chart.draw(data, options_fullStacked);
                });
                
            }
        });
    });

    $('#chart_bar').on('show.bs.modal', function(event) {
        var recruitingid = $(event.relatedTarget).data('id');
        $('[name="colunm_recruitingid"]').val(recruitingid);
        // google.charts.setOnLoadCallback(drawBasic);

        $.ajax({
            url: '<?php echo $base_url;?>Report/ajaxColumnChart/'+recruitingid,
            type: 'POST',
            dataType: 'json',
            success: function(datachart) {
                console.log(datachart);

                google.charts.load('current', {packages: ['corechart','bar']});
                google.charts.setOnLoadCallback(function(){
                    var data = google.visualization.arrayToDataTable(datachart);
                    var options_fullStacked = {
                        // isStacked: 'percent',
                        // height: 600,
                        // width: '100%',
                        // bar: { groupWidth: '75%' },
                        // // bars: 'vertical',
                        // vAxis: {
                        //     minValue: 0,
                        //     ticks: [0, .3, .6]
                        //   }
                    };

                    var chart = new google.visualization.ColumnChart(document.getElementById('column_chart'));
                    chart.draw(data, options_fullStacked);
                });
                
            }
        });
        

    });

    // $('#exportExcel').click(function(event) {
    //     // var id = $(this).data('id');
    //     // $(this).attr('href', '<?php echo $base_url;?>Report/exportExcel/'+id);
    // });

    $('#Modaltable').on('show.bs.modal', function(event) {
        var recruitingid = $(event.relatedTarget).data('id');
        $('#exportExcel').attr('href', '<?php echo $base_url;?>Report/exportExcel/'+recruitingid);
        $('#exportExcel').click(function(event) {
            if(confirm('กรุณา export ไฟล์นี้หลังจากการสรรหาเสร็จสิ้นแล้ว  เพื่อลดการทำงานของ server กดยกเลิกเพื่อออก หรือ ยืนยันเพื่อ download รายชื่อ')==true){
            }else{
                event.preventDefault();
            }
        });
        
        // console.log(recruitingid);

        $('#tableMemberGroup').dataTable({
            destroy: true, 
            columnDefs: [
                // { targets:6, orderable: false }
            ]
        });
        $('#tableMemberGroup tbody').html('<tr><td colspan="7" class="text-center">กำลังโหลด...</td></tr>');
        
        // setInterval(function(){
            $.ajax({
                url: '<?php echo $base_url;?>Report/ajaxMember/'+recruitingid,
                type: 'POST',
                dataType: 'json',
                cache: false,
                success: function(data) {
                    console.log(data);
                    if (data.member_groups.length>0) {
                        var html = '';
                        $('#tableMemberGroup tbody').html('');
                        $.each(data.member_groups, function(index, val) {
                            html += '<tr>';
                                html += '<td class="text-left" width="30%">'+val.name+'</td>';
                                html += '<td class="text-center">'+val.all+'</td>';
                                html += '<td class="text-center">'+val.memberuse+'</td>';
                                html += '<td class="text-center">'+val.membernotuse+'</td>';
                                html += '<td class="text-center">'+val.percent+'</td>';
                                html += '<td class="text-center">'+val.voteno+'</td>';
                                html += '<td class="text-center">'+val.percent_voteno+'</td>';
                            html += '</tr>';
                        });
                        $('#tableMemberGroup tbody').html(html);
                    }
                }
            });
        // }, 10000);
        
    });
    $('#Modaltable').on('hide.bs.modal', function(event) {
        console.log('hide2');
        $('#tableMemberGroup tbody').html('<tr><td colspan="7" class="text-center">กำลังโหลด...</td></tr>');
        $('#tableMemberGroup').dataTable({
            destroy: true, 
            columnDefs: [
            ]
        });
    });
});
</script>