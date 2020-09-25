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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ประเภทข่าว</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">ประเภทเอกสาร</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">คำนำหน้าชื่อ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content" id="pills-tabContent">
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
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#add" data-href="<?php echo $action_addtype; ?>"><i class="fas fa-save"></i> เพิ่มค่าระบบ</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="newtypeDatatable" class="table table-striped table-bordered datatable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Value</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($types as $key => $type) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $type['no']; ?></td>
                                                <td><?php echo $type['name']; ?></td>
                                                <td><?php echo $type['status']; ?></td>
                                                <td>
                                                    <button class="btn btn-warning" data-toggle="modal" data-id="<?php echo $type['id'];?>" data-href="<?php echo $type['edit'];?>" data-target="#edit"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-default" data-toggle="modal" data-id="<?php echo $type['id'];?>" data-href="<?php echo $type['view'];?>" data-target="#view"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-danger" data-toggle="modal" data-id="<?php echo $type['id'];?>" data-href="<?php echo $type['delete'];?>" data-target="#delete"><i class="fas fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Value</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#add" data-href="<?php echo $action_adddocument; ?>"><i class="fas fa-save"></i> เพิ่มค่าระบบ</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="viewDatatable" class="table table-striped table-bordered datatable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Value</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($documents as $key => $document) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $document['no']; ?></td>
                                                <td><?php echo $document['name']; ?></td>
                                                <td><?php echo $document['status']; ?></td>
                                                <td>
                                                    <button class="btn btn-warning" data-toggle="modal" data-id="<?php echo $document['id'];?>" data-href="<?php echo $document['edit'];?>" data-target="#edit"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-default" data-toggle="modal" data-id="<?php echo $document['id'];?>" data-href="<?php echo $document['view'];?>" data-target="#view"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-danger" data-toggle="modal" data-id="<?php echo $document['id'];?>" data-href="<?php echo $document['delete'];?>" data-target="#delete"><i class="fas fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Value</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#add" data-href="<?php echo $action_addprefix; ?>"><i class="fas fa-save"></i> เพิ่มค่าระบบ</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="prefixDatatable" class="table table-striped table-bordered datatable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Value</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($members as $key => $member) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $member['no']; ?></td>
                                                <td><?php echo $member['name']; ?></td>
                                                <td><?php echo $member['status']; ?></td>
                                                <td>
                                                    <button class="btn btn-warning" data-toggle="modal" data-id="<?php echo $member['id'];?>" data-href="<?php echo $member['edit'];?>" data-target="#edit"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-default" data-toggle="modal" data-id="<?php echo $member['id'];?>" data-href="<?php echo $member['view'];?>" data-target="#view"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-danger" data-toggle="modal" data-id="<?php echo $member['id'];?>" data-href="<?php echo $member['delete'];?>" data-target="#delete"><i class="fas fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Value</th>
                                            <th>Status</th>
                                            <th>Edit</th>
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
    </div>
</div>

<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document ">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLabel">ยืนยัน</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true ">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Value</td>
                                    <td><input type="text" name="name" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" checked>
                                            <label class="form-check-label" for="inlineRadio1">ใช้งาน</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
                                            <label class="form-check-label" for="inlineRadio2">ไม่ใช้งาน</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">ยกเลิก</button>
                        <button class="btn btn-default" type="submit">บันทึก</button>
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
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLabel">ยืนยัน</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true ">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Value</td>
                                    <td><input type="text" name="name" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="editStatus" value="1">
                                            <label class="form-check-label" for="editStatus">ใช้งาน</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="editStatus2" value="0">
                                            <label class="form-check-label" for="editStatus2">ไม่ใช้งาน</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">ยกเลิก</button>
                        <button class="btn btn-default" type="submit">บันทึก</button>
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
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLabel">ยืนยัน</h5>
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
                                    <td>Value</td>
                                    <td><span id="name"></span></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><span id="status"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <button class="btn btn-default" data-dismiss="modal" aria-label="Close">ปิด</button>
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
                <form action="">
                <div class="row">
                    <div class="col-md-12">
                        <p>คุณต้องการลบข้อมูลค่าระบบ</p>
                    </div>
                    <div class="col-md-12 text-right">
                        <button class="btn btn-default" type="button">ยกเลิก</button>
                        <button class="btn btn-danger" type="submit">ตกลง</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    $('#newtypeDatatable').DataTable({
        destroy: true, 
        columnDefs: [
            { targets:3, orderable: false }
        ]
    });
    $('#viewDatatable').DataTable({
        destroy: true, 
        columnDefs: [
            { targets:3, orderable: false }
        ]
    });
    $('#prefixDatatable').DataTable({
        destroy: true, 
        columnDefs: [
            { targets:3, orderable: false }
        ]
    });



    $('#add').on('show.bs.modal', function (event) {
        var link = $(event.relatedTarget).data('href');
        $('#add form').attr('action', link);
    });
    $('#delete').on('show.bs.modal', function (event) {
        var link = $(event.relatedTarget).data('href');
        $('#delete form').attr('action', link);
    });
    $('#view').on('show.bs.modal', function (event) {
        var dataid = $(event.relatedTarget).data('id');
        var datahref = $(event.relatedTarget).data('href');
        var link = datahref+dataid;
        $.ajax({
            url: link,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#view #name').html(data.name);
                $('#view #status').html((data.status=='1'?'Active':'Deactive'));
            }
        });
    });
    $('#edit').on('show.bs.modal', function (event) {
        var dataid = $(event.relatedTarget).data('id');
        var datahref = $(event.relatedTarget).data('href');
        var link = datahref+dataid;
        $('#edit form').attr('action', link);
        $.ajax({
            url: link,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#edit [name="name"]').val(data.name);
                if (data.status==0) {
                    $('#edit [name="status"][value="0"]').prop('checked', true);
                } else {
                    $('#edit [name="status"][value="1"]').prop('checked', true);
                }
                
            }
        });
    });
});
</script>