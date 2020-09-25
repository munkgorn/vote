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
                        <form action="<?php echo $action_import; ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Upload file</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="importfile" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <button type="submit" class="btn btn-info"><i class="fas fa-paper-plane"></i> IMPORT ข้อมูล</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo $action_search;?>" method="get">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">ชื่อ</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="filter_firstname" class="form-control" value="<?php echo $filter_firstname; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">นามสกุล</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="filter_lastname" class="form-control" value="<?php echo $filter_lastname; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">เลขที่สมาชิก</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="filter_member_no" class="form-control" value="<?php echo $filter_member_no; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 text-right"><button type="submit" class="btn btn-info">ค้นหา</button></div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 text-right mb-5">
                <button class="btn btn-success mr-3" data-toggle="modal" data-target="#Modal1"><i class="far fa-save"></i> เพิ่มสมาชิก</button>
                <a class="btn btn-default mr-3" href="<?php echo $export;?>"><i class="fas fa-file-excel"></i> EXPORT</button>
                <a class="btn btn-default" href="<?php echo $export_all; ?>" target="new"><i class="fas fa-file-excel"></i> EXPORT ALL</a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Basic Datatable</h5>
                        <div class="table-responsive">
                            <table id="memberDatatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับที่</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>หมายเลขสมาชิก</th>
                                        <th>จังหวัด</th>
                                        <th>สถานะ</th>
                                        <th>รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php /* foreach ($lists as $list) { ?>
                                    <tr>
                                        <td><?php echo $list['no']; ?></td>
                                        <td><?php echo $list['name']; ?></td>
                                        <td><?php echo $list['member_no']; ?></td>
                                        <td><?php echo $list['member_group_name'] ?></td>
                                        <td><?php echo $list['status']; ?></td>
                                        <td>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#edit" data-id="<?php echo $list['id'];?>"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-default" data-toggle="modal" data-target="#view" data-id="<?php echo $list['id'];?>"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#Modal3"><i class="fa fa-key"></i></button>
                                        </td>
                                    </tr>
                                    <?php } */ ?>
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th>ลำดับที่</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>หมายเลขสมาชิก</th>
                                        <th>จังหวัด</th>
                                        <th>สถานะ</th>
                                        <th>รายละเอียด</th>
                                    </tr>
                                </tfoot> -->
                            </table>
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
    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่ม สมาชิก</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $action_add; ?>" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>คำนำหน้าชื่อ</td>
                                        <td colspan="3">
                                            <select name="prefix_name" id="" class="form-control">
                                                <option value="จ.ท.">จ.ท.</option>
                                                <option value="ว่าที่ ร.ต.">ว่าที่ ร.ต.</option>
                                                <option value="ว่าที่ ร.ท.">ว่าที่ ร.ท.</option>
                                                <option value="ว่าที่ ร.ต. หญิง">ว่าที่ ร.ต. หญิง</option>
                                                <option value="ว่าที่ ร.อ.">ว่าที่ ร.อ.</option>
                                                <option value="จ.ส.ต.">จ.ส.ต.</option>
                                                <option value="นาง">นาง</option>
                                                <option value="นางสาว">นางสาว</option>
                                                <option value="นาย">นาย</option>
                                                <option value="พ.จ.ต.">พ.จ.ต.</option>
                                                <option value="มรว.">มรว.</option>
                                                <option value="รต.">รต.</option>
                                                <option value="ว่าที่ พ.ต.">ว่าที่ พ.ต.</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ชื่อ</td>
                                        <td><input type="text" name="firstname" class="form-control"></td>
                                        <td>นามสกุล</td>
                                        <td><input type="text" name="lastname" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>รหัสบัตรประชาชน</td>
                                        <td><input type="text" name="id_card" class="form-control"></td>
                                        <td>สมาชิกเลขที่</td>
                                        <td><input type="text" name="member_no" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>กลุ่มสมาชิก</td>
                                        <td>
                                            <select name="member_group_id" id="" class="form-control">
                                                <?php foreach ($member_groups as $member_group) { ?>
                                                <option value="<?php echo $member_group->id; ?>"><?php echo $member_group->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>Email</td>
                                        <td><input type="text" name="email" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>วันเกิด</td>
                                        <td><input type="text" name="birthday" class="form-control datepicker"></td>
                                        <td>วันที่เป็นสมาชิกสหกรณ์</td>
                                        <td><input type="text" name="date_register" class="form-control datepicker"></td>
                                    </tr>
                                    <tr>
                                        <td>ประเภทสมาชิก</td>
                                        <td>
                                            <select name="member_type_id" id="" class="form-control">
                                                <?php foreach ($member_types as $member_type) { ?>
                                                <option value="<?php echo $member_type->id; ?>"><?php echo $member_type->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>เบอร์โทรศัพท์</td>
                                        <td><input type="text" name="phone" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>สถานะ</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    ใช้งาน
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    ไม่ใช้งาน
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <td>รหัสผ่าน</td>
                                    <td>
                                        <input type="text" class="form-control" name="password" value="" placeholder="รหัสผ่านใหม่">
                                    </td>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-default">บันทึก</button>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่ม สมาชิก</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $action_edit; ?>" method="post">
                    <input type="hidden" name="id" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>คำนำหน้าชื่อ</td>
                                        <td colspan="3">
                                            <select name="prefix_name" id="" class="form-control">
                                                <option value="จ.ท.">จ.ท.</option>
                                                <option value="ว่าที่ ร.ต.">ว่าที่ ร.ต.</option>
                                                <option value="ว่าที่ ร.ท.">ว่าที่ ร.ท.</option>
                                                <option value="ว่าที่ ร.ต. หญิง">ว่าที่ ร.ต. หญิง</option>
                                                <option value="ว่าที่ ร.อ.">ว่าที่ ร.อ.</option>
                                                <option value="จ.ส.ต.">จ.ส.ต.</option>
                                                <option value="นาง">นาง</option>
                                                <option value="นางสาว">นางสาว</option>
                                                <option value="นาย">นาย</option>
                                                <option value="พ.จ.ต.">พ.จ.ต.</option>
                                                <option value="มรว.">มรว.</option>
                                                <option value="รต.">รต.</option>
                                                <option value="ว่าที่ พ.ต.">ว่าที่ พ.ต.</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ชื่อ</td>
                                        <td><input type="text" name="firstname" class="form-control"></td>
                                        <td>นามสกุล</td>
                                        <td><input type="text" name="lastname" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>รหัสบัตรประชาชน</td>
                                        <td><input type="text" name="id_card" class="form-control"></td>
                                        <td>สมาชิกเลขที่</td>
                                        <td><input type="text" name="member_no" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>กลุ่มสมาชิก</td>
                                        <td>
                                            <select name="member_group_id" id="" class="form-control">
                                                <?php foreach ($member_groups as $member_group) { ?>
                                                <option value="<?php echo $member_group->id; ?>"><?php echo $member_group->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>Email</td>
                                        <td><input type="text" name="email" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>วันเกิด</td>
                                        <td><input type="text" name="birthday" class="form-control datepicker"></td>
                                        <td>วันที่เป็นสมาชิกสหกรณ์</td>
                                        <td><input type="text" name="date_register" class="form-control datepicker"></td>
                                    </tr>
                                    <tr>
                                        <td>ประเภทสมาชิก</td>
                                        <td>
                                            <select name="member_type_id" id="" class="form-control">
                                                <?php foreach ($member_types as $member_type) { ?>
                                                <option value="<?php echo $member_type->id; ?>"><?php echo $member_type->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>เบอร์โทรศัพท์</td>
                                        <td><input type="text" name="phone" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>สถานะ</td>
                                        <td >
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    ใช้งาน
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="0">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    ไม่ใช้งาน
                                                </label>
                                            </div>
                                        </td>
                                        <td>เปลี่ยนรหัสผ่าน</td>
                                        <td>
                                            <input type="text" class="form-control" name="password" value="" placeholder="รหัสผ่านใหม่">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-default">บันทึก</button>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่ม ข่าวสาร</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>คำนำหน้าชื่อ</td>
                                        <td colspan="3"><span class="prefix_name"></span></td>
                                    </tr>
                                    <tr>
                                        <td>ชื่อ</td>
                                        <td><span class="firstname"></span></td>
                                        <td>นามสกุล</td>
                                        <td><span class="lastname"></span></td>
                                    </tr>
                                    <tr>
                                        <td>รหัสบัตรประชาชน</td>
                                        <td><span class="id_card"></span></td>
                                        <td>สมาชิกเลขที่</td>
                                        <td><span class="member_no"></span></td>
                                    </tr>
                                    <tr>
                                        <td>กลุ่มสมาชิก</td>
                                        <td><span class="member_group_name"></span></td>
                                        <td>Email</td>
                                        <td><span class="email"></span></td>
                                    </tr>
                                    <tr>
                                        <td>วันเกิด</td>
                                        <td><span class="birthday"></span></td>
                                        <td>วันที่เป็นสมาชิกสหกรณ์</td>
                                        <td><span class="date_register"></span></td>
                                    </tr>
                                    <tr>
                                        <td>เบอร์โทรศัพท์</td>
                                        <td><span class="phone"></span></td>
                                        <td>รหัสผ่าน</td>
                                        <td><span class="password"></span></td>
                                    </tr>
                                    <tr>
                                        <td>สถานะ</td>
                                        <td colspan="3"><span class="status"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 text-right">
                            <button class="btn btn-danger" data-dismiss="modal">ปิด</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-right">
                            <button class="btn btn-default">ยกเลิก</button>
                            <button class="btn btn-danger">บันทึก</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>


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
    });
    $('[name="birthday"].datepicker').datepicker('destroy');
    $('[name="birthday"].datepicker').datepicker({
        language: 'th',
        format: 'dd-mm-yyyy',
        autoclose: true,
        startView: 'centuries',
    });
});
</script>
<script>
    jQuery(document).ready(function($) {

        var obj = new Object();
        obj.filter_firstname = $('[name="filter_firstname"]').val();
        obj.filter_lastname = $('[name="filter_lastname"]').val();
        obj.filter_member_no = $('[name="filter_member_no"]').val();


        var memberDatatable = $('#memberDatatable').dataTable({
            processing : true,
            serverSide : true,
            searching : false,
            language: {
                search: "Search"
            },
            order: [],
            ajax : {
                url :  '<?php echo base_url(); ?>Member/getLists',
                type: "POST",
                data: obj,
                dataFilter: function(data){
                    var json = jQuery.parseJSON( data );
                    // console.log(json);
                    return JSON.stringify( json ); // return JSON string
                }
            },
            dataSrc: 'data',
            columns: [
                { data: 'no' },
                { data: 'name' },
                { data: 'member_no' },
                { data: 'member_group_name' },
                { data: 'status' },
                { data: 'action' }
            ],
        });

        $('#edit').on('show.bs.modal', function (event) {
            var memberid = $(event.relatedTarget).data('id');
            $(this).find('.modal-body input[name="id"]').val(memberid);

            $.post('<?php echo base_url();?>member/getList', {id: memberid}, function(data, textStatus, xhr) {
                $.each(data, function(index, val) {
                    if (index=='password') {
                    } else if (index=='status') {
                        $('#edit [name="'+index+'"][value="'+val+'"]').prop('checked', true);
                    } else {
                        $('#edit [name="'+index+'"]').val(val);
                    }
                    if ($('#edit [name="'+index+'"]').hasClass('datepicker')) {
                        $('#edit [name="'+index+'"]').datepicker('setDate', val);
                    }
                });
            });    
        });
        $('#view').on('show.bs.modal', function (event) {
            var newsid = $(event.relatedTarget).data('id');
            $(this).find('.modal-body input[name="id"]').val(newsid);
            $.post('<?php echo base_url();?>member/getList', {id: newsid}, function(data, textStatus, xhr) {
                $.each(data, function(index, val) {
                    if (index=='status') {
                        $('#view span.'+index).html(((val==true)?'ใช้งาน':'ไม่ใช้งาน'));
                    } else {
                         $('#view span.'+index).html(val);
                     }
                });
            });
        });
    });
</script>