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
                        <div class="text-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal1"><i class="fa fa-save"></i> เพิ่มข่าวสาร</button></div>
                        <hr>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับที่</th>
                                        <th>หัวข้อข่าว</th>
                                        <th>ประเภทข่าว</th>
                                        <th>ความสำคัญข่าว</th>
                                        <th>วันที่แสดงผล</th>
                                        <th>วันที่สิ้นสุด</th>
                                        <th>รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($lists as $list) { ?>
                                    <tr>
                                        <td><?php echo $list['no']; ?></td>
                                        <td><?php echo $list['name']; ?></td>
                                        <td><?php echo $list['type_name']; ?></td>
                                        <td><?php echo $list['priority']; ?></td>
                                        <td><?php echo $list['date_show']; ?></td>
                                        <td><?php echo $list['date_end'] ?></td>
                                        <td>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#edit" data-id="<?php echo $list['id'];?>"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#view" data-id="<?php echo $list['id'];?>"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#delete" data-id="<?php echo $list['id'];?>"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th>ลำดับที่</th>
                                        <th>หัวข้อข่าว</th>
                                        <th>ประเภทข่าว</th>
                                        <th>ความสำคัญข่าว</th>
                                        <th>วันที่แสดงผล</th>
                                        <th>วันที่สิ้นสุด</th>
                                        <th>รายละเอียด</th>
                                    </tr>
                                </tfoot> -->
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
    <div class="modal-dialog modal-lg" role="document ">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">เพิ่ม ข่าวสาร</h5>
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
                                    <td>หัวข้อข่าว</td>
                                    <td><input type="text" name="name" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>ข้อมูลข่าว</td>
                                    <td><textarea name="detail" id="" cols="30" rows="5" class="form-control"></textarea></td>
                                </tr>
                                <tr>
                                    <td>ประเภทข่าว</td>
                                    <td>
                                        <select name="news_type_id" id="" class="form-control" required>
                                            <?php foreach ($news_types as $news_type) { ?>
                                            <option value="<?php echo $news_type->id; ?>"><?php echo $news_type->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ความสำคัญข่าว</td>
                                    <td>
                                        <select name="priority" id="" class="form-control">
                                            <option value="1" selected>ด่วน</option>
                                            <option value="2">ด่วนมาก</option>
                                            <option value="3">ด่วนที่สุด</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>วันที่แสดงผล</td>
                                    <td>
                                        <div class="input-group input-daterange">
                                            <input type="text" name="date_show" class="form-control" placeholder="mm/dd/yyyy">
                                            <div class="input-group-append">
                                                <span class="input-group-text">to</span>
                                            </div>
                                            <input type="text" name="date_end" class="form-control" placeholder="mm/dd/yyyy">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>เอกสาร</td>
                                    <td><input type="file" name="image" class="form-control"></td>
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
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document ">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white" id="exampleModalLabel">แก้ไข ข่าวสาร</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $action_edit; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>หัวข้อข่าว</td>
                                    <td><input type="text" name="name" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>ข้อมูลข่าว</td>
                                    <td><textarea name="detail" id="" cols="30" rows="5" class="form-control"></textarea></td>
                                </tr>
                                <tr>
                                    <td>ประเภทข่าว</td>
                                    <td>
                                        <select name="news_type_id" id="" class="form-control" required>
                                            <?php foreach ($news_types as $news_type) { ?>
                                            <option value="<?php echo $news_type->id; ?>"><?php echo $news_type->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ความสำคัญข่าว</td>
                                    <td>
                                        <select name="priority" id="" class="form-control">
                                            <option value="1" selected>ด่วน</option>
                                            <option value="2">ด่วนมาก</option>
                                            <option value="3">ด่วนที่สุด</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>วันที่แสดงผล</td>
                                    <td>
                                        <div class="input-group input-daterange">
                                            <input type="text" name="date_show" class="form-control" placeholder="mm/dd/yyyy">
                                            <div class="input-group-append">
                                                <span class="input-group-text">to</span>
                                            </div>
                                            <input type="text" name="date_end" class="form-control" placeholder="mm/dd/yyyy">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>รูปภาพ</td>
                                    <td>
                                        <input type="file" name="image" class="form-control" accept="image/x-png,image/gif,image/jpeg">
                                        <img src="" alt="" style="width:200px;" id="previewimg">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                        <button class="btn btn-default">บันทึก</button>
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
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">รายละเอียด ข่าวสาร</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>หัวข้อข่าว</td>
                                    <td colspan="3"><span class="name"></span></td>
                                </tr>
                                <tr>
                                    <td>ข้อมูลข่าว</td>
                                    <td colspan="3"><span class="detail"></span></td>
                                </tr>
                                <tr>
                                    <td>ประเภทข่าว</td>
                                    <td colspan="3"><span class="type_name"></span></td>
                                </tr>
                                <tr>
                                    <td>ความสำคัญข่าว</td>
                                    <td colspan="3"><span class="priority"></span></td>
                                </tr>
                                <tr>
                                    <td>วันที่เปิดรับสมัคร</td>
                                    <td><span class="date_show"></span></td>
                                    <td>ถึงวันที่</td>
                                    <td><span class="date_end"></span></td>
                                </tr>
                                <tr>
                                    <td>รูปภาพ</td>
                                    <td colspan="3">
                                        <img src="" alt="" style="width:200px;" id="previewimg2">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <button class="btn btn-default" data-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document ">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLabel">ยืนยัน</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?php echo $action_del; ?>" method="post">
                <input type="hidden" name="id" value="">
                <div class="row">
                    <div class="col-md-12">
                        <p>คุณต้องการลบข้อมูลข่าว</p>
                    </div>
                    <div class="col-md-12 text-right">
                        <button class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-default">ตกลง</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function($) {
        
    $('#zero_config').DataTable({
        responsive: true,
    });
    $('.input-daterange input').each(function() {
        $(this).datepicker('clearDates');
    });
    <?php if (!empty($status)&&!empty($message)) { ?>
        <?php if ($status==1) { ?>
        toastr.success('<?php echo $message;?>','Success.');
        <?php } else { ?>
        toastr.error('<?php echo $message; ?>','WRONG!');
        <?php } ?>
    <?php } ?>
    $('#edit').on('show.bs.modal', function (event) {
        var newsid = $(event.relatedTarget).data('id');
        $(this).find('.modal-body input[name="id"]').val(newsid);
        $.post('<?php echo base_url();?>news/getList', {id: newsid}, function(data, textStatus, xhr) {
            $.each(data, function(index, val) {
                if (index=='file') {
                    $('#edit img#previewimg').attr('src', val);
                } else {
                    $('#edit [name="'+index+'"]').val(val);   
                }
            });
        });
    });

    $('#view').on('show.bs.modal', function (event) {
        var newsid = $(event.relatedTarget).data('id');
        $(this).find('.modal-body input[name="id"]').val(newsid);
        $.post('<?php echo base_url();?>news/getList', {id: newsid}, function(data, textStatus, xhr) {
            $.each(data, function(index, val) {
                if (index=='file') {
                    $('#view img#previewimg2').attr('src', val);
                } else {
                 $('#view span.'+index+'').html(val);
                 }
            });
        });
    });

    $('#delete').on('show.bs.modal', function (event) {
        var newsid = $(event.relatedTarget).data('id');
        $(this).find('.modal-body input[name="id"]').val(newsid);
        $.post('<?php echo base_url();?>news/getList', {id: newsid}, function(data, textStatus, xhr) {
            $.each(data, function(index, val) {
                if (index=='file') {
                    $('#view img#previewimg2').attr('src', val);
                } else {
                 $('#view span.'+index+'').html(val);
                 }
            });
        });
    });
});    
</script>