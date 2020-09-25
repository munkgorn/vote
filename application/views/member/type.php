<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
                        <div class="row">
                            <div class="col-12 text-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#Modal1">เพิ่มประเภทผู้ใช้ระบบ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลำดับที่</th>
                                        <th>ประเภทผู้ใช้ระบบ</th>
                                        <th>ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($types as $type) { ?>
                                    <tr>
                                        <td><?php echo $type['no']; ?></td>
                                        <td><?php echo $type['name']; ?></td>
                                        <td><button class="btn btn-danger" data-id="<?php echo $type['id'];?>" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ลำดับที่</th>
                                        <th>ประเภทผู้ใช้ระบบ</th>
                                        <th>ลบ</th>
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
        <div class="modal-dialog modal-lg" role="document ">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalLabel">เพิ่ม ประเภทผู้ใช้ระบบ</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
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
                                        <td class="text-right">ประเภทผู้ใช้ระบบ</td>
                                        <td><input type="text" name="name" class="form-control" required></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-danger">ยกเลิก</button>
                            <button type="submit" class="btn btn-default">บันทึก</button>
                        </div>
                    </div>
                    </form>
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
                    <div class="row">
                        <div class="col-md-12">
                            <p>คุณต้องการลบข้อมูลประเภทผู้ใช้ระบบ</p>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-danger">ยกเลิก</button>
                            <button type="submit" class="btn btn-default">ตกลง</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#zero_config').DataTable();
    $('#delete').on('show.bs.modal', function (event) {
        var ele = $('#delete .modal-body form');
        var actionlink = ele.attr('action');
        ele.attr('action', actionlink + $(event.relatedTarget).data('id'));
    });
});
</script>