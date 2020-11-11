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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo $action; ?>" method="post" id="search-form">
                            <div class="row">
                                <div class="col-10">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">วันที่ลงคะแนน</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="date" type="text" id="datescore" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 text-right"><button type="submit" class="btn btn-info">ค้นหา</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <!-- <a href="#" class="btn btn-info">Export</a> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"> 
                                <div class="text-center">
                                    <h2>รายงานแสดงจำนวนผู้มาลงคะแนน</h2>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-left">กลุ่มเขต</th>
                                        <th class="text-left" width="20%">จำนวนผู้มีสิทธิทั้งหมด</th>
                                        <th class="text-left" width="20%">จำนวนผู้มาลงคะแนน</th>
                                        <th class="text-left" width="20%">จำนวนผู้ไม่มาลงคะแนน</th>
                                        <th class="text-left" width="20%">จำนวนผู้มาลงคะแนนคิดเป็นร้อยละ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $t_all = 0; $t_use = 0; $t_notuse = 0;
                                    foreach ($member_groups as $member_group) { 
                                        $t_all += (int)$member_group['all'];
                                        $t_use += (int)$member_group['memberuse'];
                                        $t_notuse += (int)$member_group['membernotuse'];
                                    ?>
                                    <tr>
                                        <td><?php echo $member_group['name']; ?></td>
                                        <td class="text-center"><?php echo number_format($member_group['all'],0); ?></td>
                                        <td class="text-center"><?php echo number_format($member_group['memberuse'],0); ?></td>
                                        <td class="text-center"><?php echo number_format($member_group['membernotuse'],0); ?></td>
                                        <td class="text-center"><?php echo $member_group['percent']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-left">กลุ่มเขต</th>
                                        <th class="text-left">จำนวนผู้มีสิทธิทั้งหมด</th>
                                        <th class="text-left">จำนวนผู้มาลงคะแนน</th>
                                        <th class="text-left">จำนวนผู้ไม่มาลงคะแนน</th>
                                        <th class="text-left">จำนวนผู้มาลงคะแนนคิดเป็นร้อยละ</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <p class="mb-0">จำนวนผู้มีสิทธิทั้งหมด <?php echo number_format($t_all, 0);?> คน</p>
                            <p class="mb-0">จำนวนผู้มาลงคะแนน <?php echo number_format($t_use, 0);?> คน</p>
                            <p class="mb-0">จำนวนผู้ไม่มาลงคะแนน <?php echo number_format($t_notuse, 0);?> คน</p>
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

<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<script type="text/javascript">
    $(document).ready(function() {
        $('#search-form').submit(function(event) {
            if(confirm('กรุณา ค้นหา ไฟล์นี้หลังจากการสรรหาเสร็จสิ้นแล้ว  เพื่อลดการทำงานของ server กดยกเลิกเพื่อออก หรือ ยืนยันเพื่อ ค้นหา')==true){

            }else{
                event.preventDefault();
            }
        });
    });
</script>

<script>
jQuery(document).ready(function($) {

    $.fn.datepicker.dates['th'] = {
        days: ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤ", "ศุกร์", "เสาร์"],
        daysShort: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
        daysMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
        months: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
        monthsShort: ["ม.ค.", "ก.พ.", "มี.ค.", "ม.ย.", "พ.ค.", "ม.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ต.ค."],
        today: "วันนี้",
        clear: "ล้าง",
        format: "dd-mm-yyyy",
        titleFormat: "MM yyyy",
        /* Leverages same syntax as 'format' */
        weekStart: 0
    };

    $('#datescore').datepicker({
        language: 'th',
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        endDate: 'today',
    });

    <?php if ($date) { ?>
        $('#datescore').datepicker('setDate', '<?php echo $date;?>'); 
    <?php } ?>


    $('#zero_config').dataTable({
        destroy: true,
        dom: 'Bfrtip',
        buttons: [
            'print'
        ],
        columnDefs: []
    });
});
</script>