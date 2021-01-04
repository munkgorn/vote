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
                        <?php  
                        // echo '<pre>';
                        // print_r($recruitings);
                        // echo '</pre>';
                        ?>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ลงคะแนน</th>
                                        <th>ประเภทที่</th>
                                        <th>วาระการสรรหา</th>
                                        <th>ตำแหน่ง</th>
                                        <th>ชุดที่</th>
                                        <th>ปีบัญชีที่</th>
                                        <th>ครั้งที่</th>
                                        <th>พิมพ์</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recruitings as $value) { ?>

                                    <tr>
                                        <td>
                                            <?php if ($value['canvote']==true) { ?>
                                                <?php if ($value['timevote']==true) { ?>
                                                    <?php if ($value['status']==true) { ?>
                                                        <p><span class="text-danger"><b>ลงคะแนนแล้ว</b></span></p>
                                                    <?php } else { ?>
                                                    
                                                        <a href="<?php echo $base_url;?>Candidate/VoteScore/<?php echo $value['id'];?>" class="btn btn-danger">ลงคะแนน</a>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                <p><?php echo $value['timevote_text']; ?></p>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $value['sort'];?></td>
                                        <td><?php echo $value['recruiting_type'];?></td>
                                        <td><?php echo $value['lists'];?></td>
                                        <td><?php echo $value['set'];?></td>
                                        <td><?php echo $value['year'];?></td>
                                        <td><?php echo $value['no'];?></td>
                                        
                                        <td>
                                            <!-- <?php if ($value['outtimevote']==true) { ?>
                                            <a href="<?php echo $base_url;?>Candidate/exportPrint/<?php echo $value['id'];?>/<?php echo $value['type_id'];?>" target="new" class="btn btn-sm btn-secondary">Print</a></td>
                                            <?php } ?> -->
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th>ลงคะแนน</th>
                                        <th>ลำดับที่</th>
                                        <th>วาระการสรรหา</th>
                                        <th>ตำแหน่ง</th>
                                        <th>ชุดที่</th>
                                        <th>ปีบัญชีที่</th>
                                        <th>ครั้งที่</th>
                                        <th>พิมพ์</th>
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
<script>
// jQuery(document).ready(function($) {
//     $('#zero_config').dataTable({
//         destroy: true, 
//         columnDefs: [
//             { targets:6, orderable: false },
//         ]
//    });
// });
$(document).ready(function() {
    $('#zero_config').dataTable({
        "order": [[ 1, "asc" ]]
    });
});
</script>