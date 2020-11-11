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
                                        <label for="staticEmail" class="col-sm-3 col-form-label">วาระ</label>
                                        <div class="col-sm-9">
                                            <select name="recruiting_id" id="" class="form-control">
                                            <?php foreach($recruitings as $recruiting) : ?>
                                                <option value="<?php echo $recruiting['id'];?>"><?php echo 'ปี '.$recruiting['year'].' '.$recruiting['name'].' ชุด '.$recruiting['set'].' ครั้งที่ '.$recruiting['no'];?></option>
                                            <?php endforeach; ?>
                                            </select>
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
        <?php if ($recruiting_id>0) : ?>
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
                                    <h2>ผู้มาลงคะแนนแยกตามเวลา</h2>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-left">กลุ่มเขต</th>
                                        <?php for ($i=0; $i<=23; $i++) : ?>
                                        <th class="text-center">เวลา<br><?php echo sprintf('%02d',$i);?>:00 ถึง <?php echo sprintf('%02d', ($i+1==24)?0:$i+1);?>:00</th>
                                        <?php endfor; ?>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php foreach ($result as $value) : ?>
                                    <tr>
                                        <td><?php echo $value['group'];?></td>
                                        <?php foreach ($value['times'] as $count) : ?>
                                        <td><?php echo $count;?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <?php endif; ?>
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
        columnDefs: [
        ]
    });
});
</script>