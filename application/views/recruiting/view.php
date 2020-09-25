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
                        <h4 class="card-title text-danger">ดูวาระการสรรหา STEP 1 OF 2</h4>
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-pills mb-3 w-100" id="pills-tab" role="tablist">
                                    <li class="nav-item w-50">
                                        <a class="nav-link active p-3" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><h3 class="mb-0">1 ดูวาระการสรรหา</h3></a>
                                    </li>
                                    <li class="nav-item w-50">
                                        <a class="nav-link p-3 disabled" id="#" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" ><h3 class="mb-0">2 ดูข้อมูลผู้สรรหา</h3></a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">


                                        <div class="row">
                                            <div class="col-12">
                                                <p>รายละเอียดวาระ</p>
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td>ชุดที่</td>
                                                            <td><?php echo $set; ?></td>
                                                            <td>ปีบัญชีที่</td>
                                                            <td><?php echo $year; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>ครั้งที่สรรหา</td>
                                                            <td><?php echo $no; ?></td>
                                                            <td>ประเภทการสรรหา</td>
                                                            <td>
                                                                <?php echo $recruiting_type=='committee' ? 'สรรหาคณะกรรมการดำเนินการ' : 'สรรหาผู้แทนสมาชิก'; ?>
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
                                                                <td class="text-center"><?php echo isset($committee[$value->id])&&$committee[$value->id]==1 ? '<i class="fa fa-check" style="color:#1ba39c;" aria-hidden="true"></i>' : '' ?></td>
                                                                <td><?php echo $value->name; ?></td>
                                                                <td><?php echo isset($committee_receiving[$value->id])&&$committee_receiving[$value->id]>0 ? $committee_receiving[$value->id] : '' ?></td>
                                                                <td><?php echo isset($committee_reserve[$value->id])&&$committee_reserve[$value->id]>0 ? $committee_reserve[$value->id] : '' ?></td>
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
                                                                            <?php foreach ($region->member_groups as $value) { ?>
                                                                            <tr>
                                                                                <td><?php echo isset($member_group[$value->id])&&$member_group[$value->id]==1 ? '<i class="fa fa-check" style="color:#1ba39c;" aria-hidden="true"></i>' : '' ?></td>
                                                                                <td><?php echo $value->name; ?></td>
                                                                                <td><?php echo isset($member_group_receiving[$value->id])&&$member_group_receiving[$value->id]>0 ? $member_group_receiving[$value->id] : '' ?></td>
                                                                                <td><?php echo isset($member_group_reserve   [$value->id])&&$member_group_reserve   [$value->id]>0 ? $member_group_reserve [$value->id] : '' ?></td>

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
                                                            <td colspan="3"><?php echo $detail; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>วันที่เปิดรับสมัคร</td>
                                                            <td>
                                                                <?php echo $date_register_start;?>
                                                            </td>
                                                            <td>ถึงวันที่</td>
                                                            <td>
                                                                <?php echo $date_register_end;?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>กำหนดวันลงคะแนน</td>
                                                            <td>
                                                                <?php echo $date_score_start;?>
                                                            </td>
                                                            <td>ปิดลงคะแนน</td>
                                                            <td>
                                                                <?php echo $date_score_end;?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6"><h4>เอกสารการสมัคร</h4></div>
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
                                                        <?php foreach ($file as $value) { ?>
                                                        <tr>
                                                            <td><?php echo $value; ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-12 text-center">
                                                <a href="<?php echo $action_back;?>" class="btn btn-secondary" >ย้อนกลับ</a>
                                                <a href="<?php echo $action_view_candidate;?>" class="btn btn-primary">ดูผู้สรรหา</a>
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
    <!-- <footer class="footer text-center">
        All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
    </footer> -->
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
        
    <style>
    #preview_image { width:300px; }
    span.select2.select2-container { width: 100% !important; height: 35px !important; }
    .select2-container--default .select2-selection--single { border: 1px solid #eef1f3 !important; height: 35px; padding: 5px; }
    [class^='select2'] { border-radius: 2px !important; }
    </style>

    <script>
    jQuery(document).ready(function($) {
        
        <?php if ($recruiting_type=='committee') { ?>
            $('#option_members').slideUp(100);
            $('#option_committee').slideDown('fast');
        <?php } ?>
        <?php if ($recruiting_type=='members') { ?>
            $('#option_committee').slideUp(100);
            $('#option_members').slideDown('fast');
        <?php } ?>
    });
    </script>
