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
                            <table id="recruitingDatatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">ลำดับที่</th>
                                        <th>วาระการสรรหา</th>
                                        <th>ตำแหน่ง</th>
                                        <th>ชุดที่</th>
                                        <th>ปีบัญชีที่</th>
                                        <th>ครั้งที่</th>
                                        <th>สถานะ</th>
                                        <th width="20%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recruitings as $recruiting) { ?>
                                    <tr>
                                        <td class="text-center"><?php echo $recruiting['sort']; ?></td>
                                        <td><?php echo $recruiting['type']; ?></td>
                                        <td><?php echo $recruiting['list']; ?></td>
                                        <td><?php echo $recruiting['set']; ?></td>
                                        <td><?php echo $recruiting['year']; ?></td>
                                        <td><?php echo $recruiting['no']; ?></td>
                                        <td><?php echo $recruiting['status_text']; ?></td>
                                        <td width="20%">
                                            <?php if ($recruiting['status']==1) { ?>
                                            <a href="<?php echo $base_url;?>Recruiting/View/<?php echo $recruiting['id'];?>" class="btn btn-secondary"><i class="fa fa-eye"></i></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $base_url;?>Recruiting/Edit/<?php echo $recruiting['id'];?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo $base_url;?>Recruiting/View/<?php echo $recruiting['id'];?>" class="btn btn-secondary"><i class="fa fa-eye"></i></a>
                                            <a href="<?php echo $base_url;?>Recruiting/Confirm/<?php echo $recruiting['id'];?>" class="btn btn-info" data-toggle="tooltip" data-placement="right" title="ล็อควาระ ไม่ให้แก้ไข" onclick="return confirm('ยืนยันการล็อควาระ เพื่อไม่ให้แก้ไข\nยืนยันไหม?');"><i class="fas fa-lock"></i></a>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#delete" data-id="<?php echo $recruiting['id'];?>" onclick="return confirm('ยืนยันการลบ?');"><i class="fa fa-trash"></i></button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th class="text-center">ลำดับที่</th>
                                        <th>วาระการสรรหา</th>
                                        <th>ตำแหน่ง</th>
                                        <th>ชุดที่</th>
                                        <th>ปีบัญชีที่</th>
                                        <th>ครั้งที่</th>
                                        <th>สถานะ</th>
                                        <th width="20%"></th>
                                    </tr>
                                </tfoot> -->
                            </table>
                        </div>

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
                    <h5 class="modal-title text-white" id="exampleModalLabel">ลบข้อมูล</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $action_del; ?>" method="post">
                    <div class="row">
                        <div class="col-12">
                            <p>ยืนยันการลบ</p>
                        </div>
                        <div class="col-12 text-right">
                            <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">ยกเลิก</button>
                            <button class="btn btn-danger">ยืนยัน</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl" role="document ">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="exampleModalLabel">จัดการวาระการสรรหา</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                
                <div class="card">
                    <div class="card-body">
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

                                        <form method="post" id="recruiting_form">
                                        <div class="row">
                                            <div class="col-12">
                                                <p>รายละเอียดวาระ</p>
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td>ชุดที่</td>
                                                            <td><input type="text" name="set" class="form-control" value=""></td>
                                                            <td>ปีบัญชีที่</td>
                                                            <td><input type="text" name="year" class="form-control" value=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>ครั้งที่สรรหา</td>
                                                            <td><input type="text" name="no" class="form-control" value=""></td>
                                                            <td>ประเภทการสรรหา</td>
                                                            <td>
                                                                <select name="recruiting_type" id="" class="form-control">
                                                                    <option value="">กรุณาเลือก...</option>
                                                                    <option value="committee">สรรหาคณะกรรมการดำเนินการ</option>
                                                                    <option value="members">สรรหาผู้แทนสมาชิก</option>
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
                                                                <td><input type="checkbox" name="committee[<?php echo $value->id;?>]" class="form-control" value="1" ></td>
                                                                <td><?php echo $value->name; ?></td>
                                                                <td><input type="text" name="committee_receiving[<?php echo $value->id;?>]" class="form-control" value=""></td>
                                                                <td><input type="text" name="committee_reserve[<?php echo $value->id;?>]" class="form-control" value=""></td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div id="option_members" class="select-hide" style="display: none;">
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
                                                                            <?php foreach ($region->member_groups as $member_group) { ?>
                                                                            <tr>
                                                                                <td><input type="checkbox" name="member_group[<?php echo $member_group->id;?>]" class="form-control" value="1"></td>
                                                                                <td><?php echo $member_group->name; ?></td>
                                                                                <td><input type="text" name="member_receiving[<?php echo $member_group->id;?>]" class="form-control" value=""></td>
                                                                                <td><input type="text" name="member_reserve[<?php echo $member_group->id;?>]" class="form-control" value=""></td>
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
                                                            <td colspan="3"><textarea name="detail" id="" cols="30" rows="5" class="form-control"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td>วันที่เปิดรับสมัคร</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" name="date_register_start" class="form-control datepicker" placeholder="วว-ดด-ปปปป">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>ถึงวันที่</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" name="date_register_end" class="form-control datepicker" placeholder="วว-ดด-ปปปป">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>กำหนดวันลงคะแนน</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" name="date_score_start" class="form-control datepicker" placeholder="วว-ดด-ปปปป">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>ปิดลงคะแนน</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" name="date_score_end" class="form-control datepicker" placeholder="วว-ดด-ปปปป">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6"><h4>เอกสารการสมัคร</h4></div>
                                            <div class="col-6 text-right"><button class="btn btn-warning" id="add_file" type="button" data-toggle="modal" data-target="#add_file">เพิ่มเอกสาร</button></div>
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
                                                <button class="btn btn-default" type="button" id="next">CONTINUE</button>
                                            </div>
                                        </div>
                                        </form>

                                        
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table id="profiletable" class="datatable table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>ตำแหน่งที่สมัคร</th>
                                                                <th>หมายเลข</th>
                                                                <th>ชื่อ-นามสกุล</th>
                                                                <th>หมายเลขสมาชิก</th>
                                                                <th>การอนุมัติ</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>ตำแหน่งที่สมัคร</th>
                                                            <th>หมายเลข</th>
                                                            <th>ชื่อ-นามสกุล</th>
                                                            <th>หมายเลขสมาชิก</th>
                                                            <th>การอนุมัติ</th>
                                                            <th></th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>

                                        <form id="formaddcandidate">
                                        <input type="hidden" name="recruiting_id" value="">
                                        <div class="row">
                                            <div class="col-12">
                                                
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <td>IMAGE</td>
                                                            <td>
                                                                <input type="file" name="image" class="form-control">
                                                                <button type="button" class="btn btn-primary btn-sm" id="add_image">เลือกรูปภาพ</button>
                                                                <img src="" alt="" id="preview_image" class="img-fluid">
                                                                <br>
                                                                <button type="button" class="btn btn-info btn-sm" id="edit_image">แก้ไขรูปภาพ</button>
                                                                <button type="button" class="btn btn-danger btn-sm" id="delete_image">ลบรูปภาพ</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>สร้างในนาม</td>
                                                            <td>
                                                                <input type="text" name="author" class="form-control" value="">
                                                            </td>
                                                            <td>วันที่สมัคร</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" name="date_register" class="form-control datepicker" placeholder="วว-ดด-ปปปป">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>ชื่อ-นามสกุล</td>
                                                            <td colspan="3">
                                                                <button class="btn" type="button" style="width:100%; border:1px solid #eee;height: 35px;text-align:left;" data-toggle="modal" data-target="#select_members"></button>
                                                                <input type="hidden" name="member_id" value="">
                                                                <!-- <select name="member_id" id="" class="form-control select2" data-placeholder="กรุณาเลือก">
                                                                    <option></option>
                                                                    <?php foreach ($members as $member) { ?>
                                                                    <option value="<?php echo $member->id; ?>" ><?php echo $member->firstname.' '.$member->lastname; ?></option>
                                                                    <?php } ?>
                                                                </select> -->
                                                                <small>กดเพื่อค้นหาชื่อสมาชิก</small>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>สมาชิกเลขที่</td>
                                                            <td><input type="text" name="member_no" class="form-control" value="" readonly></td>
                                                            <td>อายุ</td>
                                                            <td><input type="text" name="age" class="form-control" value=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td>ปัจจุบันดำรงค์ตำแหน่ง</td>
                                                            <td><input type="text" name="position" class="form-control" value=""></td>
                                                            <td>เป็นสมาชิกสหกรณ์</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <input type="number" name="member_year" pattern="[0-9]{2}" title="กรุณากรอกตัวเลข 2 หลัก" class="form-control" value="">
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <p>ปี</p>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <input type="number" name="member_month"  pattern="[0-9]{2}" title="กรุณากรอกตัวเลข 2 หลัก" class="form-control" value="">
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <p>เดือน</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>สังกัด</td>
                                                            <td colspan="3">
                                                                <input type="text" name="member_group_name" class="form-control" value="" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>โทรศัพท์</td>
                                                            <td><input type="text" name="phone_office" class="form-control" value=""></td>
                                                            <td>ตำแหน่งที่สมัคร</td>
                                                            <td>
                                                                <select name="type_id" id="register_type" class="form-control">
                                                                <?php foreach ($recruiting_types as $recruiting_type) { ?>
                                                                    <option value="<?php echo $recruiting_type->recruiting_committee_id; ?>" ><?php echo $recruiting_type->committee_name; ?></option>
                                                                <?php } ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>โทรศัพท์มือถือ</td>
                                                            <td><input type="text" name="phone" class="form-control" value=""></td>
                                                            <td>เลขที่ผู้สมัคร</td>
                                                            <td><input type="text" name="candidate_no" class="form-control" value=""></td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <button class="btn btn-secondary" type="button" id="back">Back</button>
                                                <button class="btn btn-default" type="button" id="add_candidate">Add</button>
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
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="select_members" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white" id="exampleModalLabel">ค้นหาสมาชิก</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <form id="form_search_member">
                                <div class="form-group row">
                                    <label for="inputmembername" class="col-sm-2 col-form-label">ชื่อ</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="filter_firstname" id="inputmembername" placeholder="ชื่อสมาชิก">
                                    </div>
                                    <label for="inputmemberlastname" class="col-sm-2 col-form-label">นามสกุล</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="filter_lastname" id="inputmemberlastname" placeholder="ชื่อสมาชิก">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputmemberno" class="col-sm-2 col-form-label">เลขที่สมาชิก</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="filter_member_no" id="inputmemberno" placeholder="เลขที่สมาชิก">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button class="btn btn-primary" id="btn_search_member" type="button">ค้นหา</button>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-bordered" id="tableListSearchMember">
                                <thead>
                                    <tr>
                                        <th>สมาชิกเลขที่</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>เลขประจำตัวประชาชน</th>
                                        <th>เลือกสมาชิก</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center">กรุณาค้นหาสมาชิกก่อน</td>
                                    </tr>
                                </tbody>
                            </table>
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
                                        <td width="10%" class="text-center"><input type="checkbox" name="document" class="form-control" data-title="<?php echo $document->name;?>" value="<?php echo $document->id;?>"></td>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="confirm">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">ยืนยันการลบผู้สมัคร</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>คุณต้องการลบผู้สมัคร?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            <button type="button" id="confirm_delete" data-id="" class="btn btn-danger">ลบ</button>
          </div>
        </div>
      </div>
    </div>




<style>
    
@media (min-width: 992px) {
  .modal-lg,
  .modal-xl {
    max-width: 800px;
  }
}

@media (min-width: 1200px) {
  .modal-xl {
    max-width: 1140px;
  }
#preview_image { width:300px; }
span.select2.select2-container { width: 100% !important; height: 35px !important; }
.select2-container--default .select2-selection--single { border: 1px solid #eef1f3 !important; height: 35px; padding: 5px; }
[class^='select2'] { border-radius: 2px !important; }

.modal.show .modal-dialog .modal-content {
    -webkit-box-shadow: 5px 5px 10px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 5px 5px 10px 0px rgba(0,0,0,0.75);
    box-shadow: 5px 5px 10px 0px rgba(0,0,0,0.75);
}


</style>
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
        // startDate: 'today'
    });

    // date function
});
</script>
<script>
jQuery(document).ready(function($) {

    // $('#edit').on('show.bs.modal', function(event) {
    //     var recruitingid = $(event.relatedTarget).data('id');        
    //     getEdit(recruiting_id);
        
    // });

    $('#add_candidate').click(function(event) {
        var arr = $('#formaddcandidate').serializeArray();
        var obj = new Object();
        $.each(arr, function(index, val) {
             obj[val.name] = val.value;
        });
        
        $.ajax({
            url: '<?php echo $base_url;?>Candidate/ajaxAdd',
            type: 'POST',
            dataType: 'json',
            data: obj,
            success: function(data) {
                console.log(data);
                // getEdit(obj.recruiting_id);
                getCandidates(obj.recruiting_id);
                
            }
        });
        
    });

    function getCandidates(recruiting_id)
    {
        $.ajax({
            url: '<?php echo $base_url;?>Candidate/ajaxGetCandidates/'+recruiting_id,
            type: 'POST',
            dataType: 'json',
            success: function (data2) {
                var html = '';
                $('#profiletable').DataTable().clear();
                $('#profiletable').DataTable().destroy();
               $.each(data2, function(index2, val2) {
                    html += '<tr>'+
                    '  <td>'+val2.position+'</td>'+
                    '  <td>'+val2.candidate_no+'</td>'+
                    '  <td>'+val2.member_prefix+' '+val2.firstname+' '+val2.lastname+'</td>'+
                    '  <td>'+val2.member_no+'</td>'+
                    '  <td width="15%">'+
                    '      <div class="form-check form-check-inline">'+
                    '        <input class="form-check-input change_status" data-id="'+val2.id+'" type="radio" name="status'+val2.id+'" id="status_approve'+val2.id+'" value="1" '+(val2.status==1?'checked':'')+'>'+
                    '        <label class="form-check-label" for="status_approve'+val2.id+'">อนุมัติ</label>'+
                    '      </div>'+
                    '      <div class="form-check form-check-inline">'+
                    '        <input class="form-check-input change_status" data-id="'+val2.id+'" type="radio" name="status'+val2.id+'" id="status_unapprove'+val2.id+'" value="0" '+(val2.status==0?'checked':'')+'>'+
                    '        <label class="form-check-label" for="status_unapprove'+val2.id+'">ตัดสิทธิ์</label>'+
                    '      </div>'+
                    '      '+
                    '  </td>'+
                    '  <td width="15%">'+
                    '      <button type="button" data-id="'+val2.id+'" data-recruitingid="'+recruiting_id+'" class="edit_candidate btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>'+
                    '      <button type="button" data-toggle="modal" data-target="#confirm" class="btn btn-danger btn-sm" data-id="'+val2.id+'"><i class="fas fa-trash-alt text-white"></i></button>'+
                    '  </td>'+
                    '</tr>';
               });
               $('#profiletable tbody').html(html);
               $('#profiletable').dataTable({
                    destroy: true, 
                    columnDefs: [
                        { targets:4, orderable: false },
                        { targets:5, orderable: false }
                    ]
               })
               $('#formaddcandidate input[name!=recruiting_id]').val('');
            }
        });
    }

    $('#btn_search_member').click(function(event) {
        var arr = $('#form_search_member').serializeArray();
        var obj = new Object();
        $.each(arr, function(index, val) {
             obj[val.name] = val.value;
        });
        $.ajax({
            url: '<?php echo $base_url;?>Member/getLists',
            type: 'POST',
            dataType: 'json',
            data: obj,
            success: function(data) {
                console.log(data);
                if (data.data.length>0) {
                    var html = '';
                    $.each(data.data, function(index, val) {
                        console.log(val);
                        html += '<tr>';
                        html += '<td>'+val.member_no+'</td>';
                        html += '<td>'+val.name+'</td>';
                        html += '<td>'+val.id_card+'</td>';
                        html += '<td><button type="button" class="btn btn-default selected_member" data-id="'+val.id+'">เลือกสมาชิก</button></td>';
                        html += '</tr>';
                    });
                    $('#tableListSearchMember tbody').html(html);
                }
            }
        });
    });

    $('#tableListSearchMember').on('click', '.selected_member', function(event) {
        var memberid = $(this).data('id');
        // console.log('click search');
        $.ajax({
            url: '<?php echo $base_url;?>Member/getList',
            type: 'POST',
            dataType: 'json',
            data: {id: memberid},
            success: function(data) {
                console.log(data);
                $('#select_members').modal('hide');
                $.each(data, function(index, val) {
                    $('#pills-profile input[name="'+index+'"]').val(val);
                });
                var tempname = data.prefix_name+' '+data.firstname+' '+data.lastname;
                $('[data-target="#select_members"]').html(tempname);
                $('#pills-profile [name="member_id"]').val(data.id);
                
            }
        });
        
    });

    $('#recruitingDatatable').dataTable({
        destroy: true, 
        columnDefs: [
            { targets:7, orderable: false }
        ]
    });

	$('#edit').on('shown.bs.modal', function (e) {
		var id = $(e.relatedTarget).data('id');
        var type = $(e.relatedTarget).data('type');
        $('#next').html('Loading...').attr('disabled','disabled');
        $('#back').attr('data-id', id);
        
        $('#edit .tab-pane').removeClass('active').removeClass('show');
        $('#pills-home').addClass('active').addClass('show');


        if (type=='view') {
            getEdit(id, true);
        } else {
            getEdit(id, false);
        }
	});
    $('#edit').on('hide.bs.modal', function(event) {

        $('#edit #pills-home input,#edit #pills-home textarea,#edit #pills-home select').removeAttr('disabled').removeAttr('readonly').val('').css({
            border: '1px solid #eee',
            background: '#fff'
        });
        $('#edit #pills-home [type="checkbox"]').prop('checked', false);
        $('#edit #pills-home #add_file').removeClass('disabled').removeAttr('disabled').show();

        $('#add_file').show();
        $('#profiletable .edit_candidate').show();
        $('#profiletable [data-target="#confirm"]').show();
        $('#formaddcandidate').show();
        $('#pills-home-tab').tab('show');
    });
    
    $('#back').click(function(event) {
        $('#pills-home-tab').tab('show');
        var id = $(this).data('id');
        getEdit(id);
        

    });

    $('#edit').on('click', '.edit_candidate', function(event) {
    	var candidate_id = $(this).data('id');
    	var recruiting_id = $(this).data('recruitingid');
        $.ajax({
        	url: '<?php echo base_url();?>Candidate/getCandidate/'+recruiting_id,
        	type: 'POST',
        	dataType: 'json',
        	data: {id: candidate_id},
        	success: function(data) {
        		console.log(data);
        		$.each(data, function(index, val) {
                    if (index=='member_id') {
                    //     $('#pills-profile [name="'+index+'"]').select2("destroy");
                    //     console.log(index);
                    //     console.log(val);
                    //     $('#pills-profile [name="'+index+'"]').select2({
                    //         placeholder: 'กรุณาเลือก',
                    //         allowClear: true
                    //     });
                    //     $('#pills-profile [name="'+index+'"]').val(val).trigger('change');
                    } else {
                        $('#pills-profile [name="'+index+'"]').val(val).trigger('change');
                    }
        			
        		});
        		
        	}
        });
    });

    $('#confirm').on('shown.bs.modal', function(event) {
        var id = $(event.relatedTarget).data('id');
        $('#confirm_delete').data('id', id);
        console.log(id);

    });
    $('#confirm_delete').click(function(event) {    
        var recruiting_id = $('[name="recruiting_id"]').val();
        var id = $('#confirm_delete').data('id');
        console.log(id);
        $.ajax({
            url: '<?php echo $action_delete_candidate;?>'+id,
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                // getEdit(recruiting_id);
                console.log(recruiting_id);
                $('#confirm').modal('hide');
                getCandidates(recruiting_id);
            }
        });
        
    });
    function getEdit(id, typeview=false) {
        $('#edit #recruiting_form').attr('action', '<?php echo $action_edit;?>'+id);
        $('#edit [name="recruiting_id"]').val(id);

        if (typeview==true) {
            $('#edit input,#edit select,#edit textarea').css({
                border: '0',
                background: '#fff'
            });
            $('#add_file').hide();
            $('#profiletable .edit_candidate').hide();
            $('#profiletable [data-target="#confirm"]').hide();
            $('#formaddcandidate').hide();
        }
        $.ajax({
            url: '<?php echo $action_get;?>'+id,
            type: 'POST',
            dataType: 'json',
            success:function(data) {

                console.log(data);

                $.each(data, function(index, val) {
                    if (index=='recruiting_type') {
                        if (val=='committee') {
                            $('#option_members').slideUp(100);
                            $('#option_committee').slideDown('fast');

                        } else if (val=='members') {
                            $('#option_committee').slideUp(100);
                            $('#option_members').slideDown('fast');
                        }
                        $('[name="recruiting_type"]').val(val);
                    }
                    else if (index=='lists') {
                        if (data.recruiting_type=='committee') {
                            var name = 'committee_';
                            var namechbox = 'committee';
                        } else if(data.recruiting_type=='members') {
                            var name = 'member_';
                            var namechbox = 'member_group';
                        }
                        var html = '';
                        $.each(val, function(index2, val2) {
                            $('[name="'+namechbox+'['+index2+']"').prop('checked', true);
                            $('[name="'+name+'receiving['+index2+']"]').val(val2.receiving);
                            $('[name="'+name+'reserve['+index2+']"]').val(val2.reserve);
                            html += '<option value="'+index2+'">'+val2.name+'</option>';
                        });
                        $('[name="type_id"]').html(html);
                    }
                    else if (index=='members') {
                    }
                    else if (index=='recruiting_id') {
                        $('[name="recruiting_id"]').val(val);
                    }
                    else if (index=='candidates') {
                       var html = '';
                       $.each(val, function(index2, val2) {
                            html += '<tr>'+
                            '  <td>'+val2.position+'</td>'+
                            '  <td>'+val2.candidate_no+'</td>'+
                            '  <td>'+val2.name+'</td>'+
                            '  <td>'+val2.member_no+'</td>'+
                            '  <td width="15%">'+
                            '      <div class="form-check form-check-inline">'+
                            '        <input class="form-check-input change_status" data-id="'+val2.id+'" type="radio" name="status'+val2.id+'" id="status_approve'+val2.id+'" value="1" '+(val2.status==1?'checked':'')+'>'+
                            '        <label class="form-check-label" for="status_approve'+val2.id+'">อนุมัติ</label>'+
                            '      </div>'+
                            '      <div class="form-check form-check-inline">'+
                            '        <input class="form-check-input change_status" data-id="'+val2.id+'" type="radio" name="status'+val2.id+'" id="status_unapprove'+val2.id+'" value="0" '+(val2.status==0?'checked':'')+'>'+
                            '        <label class="form-check-label" for="status_unapprove'+val2.id+'">ตัดสิทธิ์</label>'+
                            '      </div>'+
                            '      '+
                            '  </td>'+
                            '  <td width="15%">'+
                            '      <button type="button" data-id="'+val2.id+'" data-recruitingid="'+id+'" class="edit_candidate btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>'+
                            '      <button type="button" data-toggle="modal" data-target="#confirm" class="btn btn-danger btn-sm" data-id="'+val2.id+'"><i class="fas fa-trash-alt text-white"></i></button>'+
                            '  </td>'+
                            '</tr>';
                       });
                       $('#profiletable tbody').html(html);
                       $('#profiletable').dataTable({
                            destroy: true, 
                            columnDefs: [
                                { targets:4, orderable: false },
                                { targets:5, orderable: false }
                            ]
                       })
                    } else {
                        $('[name="'+index+'"]').val(val);
                    }
                });
    
                if (data.candidates.length > 0) {
                    $('#edit #pills-home input').attr('disabled', 'disabled');
                    $('#edit #pills-home textarea').attr('disabled', 'disabled');
                    $('#edit #pills-home select').attr('disabled', 'disabled');
                    $('#edit #pills-home #add_file').addClass('disabled').attr('disabled','disabled');
                }
                $('#next').html('CONTINUE')
                $('#next').removeAttr('disabled');

                if (typeview==true) {
                    console.log(typeview);
                    $('#edit input,#edit select,#edit textarea,#edit [type="checkbox"]').attr('readonly','readonly').attr('disabled','disabled');
                    
                }
            }
        });
    }


    $('#next').click(function(event) {
        // console.log('click');
        var arr = $('#recruiting_form').serializeArray();
        var obj = new Object();
        $.each(arr, function(index, val) {
             obj[val.name] = val.value;
        });
        console.log(obj);
        var action = $('#edit #recruiting_form').attr('action');
        $.ajax({
            url: action,
            type: 'POST',
            dataType: 'json',
            data: obj,
            success: function(data) {
                console.log(data);
            }
        });
        
        $('#pills-profile-tab-tab').tab('show');
    });
    $('[name="recruiting_type"]').change(function(event) {
        console.log($(this).val());
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


<script>
jQuery(document).ready(function($) {
    $('#profiletable').on('click', '.change_status', function(event) {
        if ($(this).is(':checked')) {
            var value = $(this).val();
            var id = $(this).data('id');
            var recruiting_id = $('[name="recruiting_id"]').val();
            $.ajax({
                url: '<?php echo base_url();?>candidate/status/'+recruiting_id+'/'+id+'/'+value,
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                }
            });
        }
    });
});
</script>
<!-- Type Event -->

<script>
// function getMembers() {
//     $('[name="member_id"]').select2({
//         ajax: {
//             url: 'Member/getLists',
//             dataType: 'json'
//             data: {},
//             success:function(data) {
//                 console.log(data);
//             }
//         }
//     });
// }
jQuery(document).ready(function($) {
    // $('.select2').select2({
    //     placeholder: 'กรุณาเลือก',
    //     allowClear: true,
    //     minimumResultsForSearch: 5
    // });

    // $('[name="member_id"]').on('select2:select', function (e) {
    // // $('[name="member_id"]').select(function(event) {
    //     console.log('change');
    //     $.post('<?php echo base_url();?>candidate/getMember', {id: $(this).val()}, function(data, textStatus, xhr) {
    //         $.each(data, function(index, val) {
    //             if (index=='birthday') {
    //                 console.log(val);
    //                 $('[name="'+index+'"]').datepicker('setDate', val);
    //             } else {
    //                 $('#pills-profile [name="'+index+'"]').val(val); 
    //             }
    //         });
    //     },'json');
    // });
});
</script>
<script>
jQuery(document).ready(function($) {
    $('#delete_image').hide();
    $('#edit_image').hide();
    $('[name="image"]').hide();
   function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview_image').show();
            $('#preview_image').attr('src', e.target.result);
            $('#add_image').hide();
            $('#edit_image').show();
            $('#delete_image').show();
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    $('[name="image"]').change(function() {
      readURL(this);
    });

    $('#add_image,#edit_image').click(function(event) {
        $('[name="image"]').trigger('click');
    });

    $('#delete_image').click(function(event) {
        $('[name="image"]').val('');
        $('#preview_image').attr('src','');
        $('#preview_image').hide();
        $('#delete_image').hide();
        $('#edit_image').hide();
        $('#add_image').show();
    });


    $('#add_file').on('shown.bs.modal', function (e) {
        // $('#add_file input[type="checkbox"]').iCheck({
        //     labelHover: false,
        //     cursor: true
        // });
        // $('#edit').modal('hide');
    })
    $('#confirm_file').click(function(event) {
        // $('#edit').modal('show');
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
    $('#add_file,#confirm,#select_members').on('hide.bs.modal', function(event) {
        $('#edit').css({
            'overflow-x': 'hidden',
            'overflow-y': 'auto'
        });
    });
    $('#delete').on('show.bs.modal', function(event) {
        var id = $(event.relatedTarget).data('id');
        var href = $('#delete form').attr('action');
        $('#delete form').attr('action', href+id);
    });
});
</script>