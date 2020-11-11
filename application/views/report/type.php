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
                                    <label for="staticEmail" class="col-sm-3 col-form-label">ประเภทการสรรหา</label>
                                    <div class="col-sm-9">
                                        <select name="member_group_id" id="" class="form-control">
                                            <option value=""></option>
                                            <?php foreach ($groups as $key => $value): ?>
                                            <optgroup label="<?php echo $key; ?>">
                                            <?php foreach ($value as $key2 => $value2): ?>
                                            <option value="<?php echo $value2->id;?>" <?php echo $member_group_id==$value2->id?'selected':'';?>><?php echo $value2->name;?></option>    
                                            <?php endforeach ?>
                                            </optgroup>
                                            <?php endforeach ?>
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
                                    <h2>ผู้มาลงคะแนนแยกตามประเภท</h2>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-left">ชุด</th>
                                        <th class="text-left">ปี</th>
                                        <th class="text-left">ครั้งที่</th>
                                        <th class="text-center" width="20%">จำนวนผู้มีสิทธิทั้งหมด</th>
                                        <th class="text-center" width="20%">จำนวนผู้มาลงคะแนน</th>
                                        <th class="text-center" width="20%">จำนวนผู้ไม่มาลงคะแนน</th>
                                        <th class="text-center" width="20%">จำนวนผู้มาลงคะแนนคิดเป็นร้อยละ</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php if (count($recruitings)>0): ?>
                                    <?php foreach ($recruitings as $recruiting): ?>
                                    <tr>
                                        <td><?php echo $recruiting['set'] ?></td>
                                        <td><?php echo $recruiting['year'] ?></td>
                                        <td><?php echo $recruiting['no']; ?></td>
                                        <td class="text-center"><?php echo $recruiting['all']; ?></td>
                                        <td class="text-center"><?php echo $recruiting['memberuse']; ?></td>
                                        <td class="text-center"><?php echo $recruiting['membernotuse']; ?></td>
                                        <td class="text-center"><?php echo $recruiting['percent']; ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-left">ชุด</th>
                                        <th class="text-left">ปี</th>
                                        <th class="text-left">ครั้งที่</th>
                                        <th class="text-center">จำนวนผู้มีสิทธิทั้งหมด</th>
                                        <th class="text-center">จำนวนผู้มาลงคะแนน</th>
                                        <th class="text-center">จำนวนผู้ไม่มาลงคะแนน</th>
                                        <th class="text-center">จำนวนผู้มาลงคะแนนคิดเป็นร้อยละ</th>
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
        titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
        weekStart: 0
    };

    $('#datescore').datepicker({
        language: 'th',
        format: 'dd-mm-yyyy',
        autoclose: true,
    });



    $('#zero_config').dataTable({
        destroy: true, 
        columnDefs: [
        ]
    });
});
</script>