
<form id="submit_vote_score" action="<?php echo $action; ?>" method="post" >
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title"><?php echo $heading_title; ?> เลือกได้ <?php echo $lists[0]['max'];?> หมายเลข</h4>
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
                <input type="hidden" name="voteno" class="checkvoteno" value="0">
                <?php foreach ($lists as $list) { ?>
                <?php if (count($list['candidates'])>0): ?>
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" name="vote[<?php echo $list['id'];?>]" class="checkvote" value="">

                        <h3>
                            <?php echo $list['name']; ?> 
                            <?php if ($timevote==1): ?>
                            <span class="shownum num<?php echo $list['id'];?>">0</span>/<?php echo $list['max'];?>
                            <?php endif ?>
                        </h3>
                        <hr>
                        <div class="row">
                            
                            <?php foreach ($list['candidates'] as $candidate) { ?>
                            <div class="col-sm-3">
                                <div class="box">
                                    <div class="box-body">
                                        <?php if (!empty($candidate['image'])) { ?>
                                        <img src="<?php echo $candidate['image']; ?>" alt="" class="img-fluid imgid<?php echo $candidate['candidate_id'];?>">
                                        <?php } else { ?>
                                            <br><br><br><br><br><br>
                                        <?php } ?>
                                        <h3 class="mb-2">เลขที่ผู้สมัคร <span class="candidateno<?php echo $candidate['candidate_id'];?>"><?php echo $candidate['candidate_no']; ?></span></h3>
                                        <h3 class="nameid<?php echo $candidate['candidate_id'];?>">
                                            <?php echo $candidate['name']; ?>    
                                        </h3>
                                    </div>
                                    <div class="box-footer">
                                        <?php if ($timevote==1): ?>
                                        <div class="checkbox" data-id="<?php echo $list['id'];?>" data-candidateid="<?php echo $candidate['candidate_id'];?>" data-max="<?php echo $list['max'];?>"></div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            
                        </div>
                    </div>
                </div>
                <?php endif ?>
                <?php } ?>
                <?php if ($check>0&&$timevote==1): ?>
                <div class="card">
                    <div class="card-body">
                        <h3>Vote No</h3>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="box">
                                    <div class="box-body">
                                        <br><br> <br><br><br><br>
                                        <h3>ไม่ออกเสียง</h3>
                                        <br>
                                    </div>
                                    <div class="box-footer">
                                        <div class="checkbox nocheck"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
    

                <div class="card">
                    <div class="card-body text-right">
                        <?php if ($timevote==1): ?>
                        <button type="button" class="btn btn-success" id="submit">บันทึก</button>
                        <?php else: ?>
                            <h3 class="text-center mb-0">คุณยังไม่สามารถลงคะแนนได้ในขณะนี้</h3>
                            <p class="text-center"><?php echo $timevote_text; ?></p>
                        <?php endif ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="confirmvote">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ยืนยันการลงคะแนน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="mb-3">รายชื่อที่ท่านได้เลือกลงคะแนน</h3>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th width="10%"></th>
                            <th width="25%" class="text-center">เลขที่ผู้สมัคร</th>
                            <th>ชื่อ</th>
                        </tr>
                    </thead>
                    <tbody id="confirmbody">
                        
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-success" >ยืนยันการลงคะแนน</button>
            </div>
        </div>
    </div>
</div>

</form>
<style>
.box {
    border:1px solid #ddd;
    border-radius: 5px;
    padding:10px 15px;
    text-align: center;
    padding-bottom:85px;
    /*height: 400px;*/
    margin-bottom: 5px;
    position:relative;
}
.box img {
    width:100%;
    height:265px;
    margin-bottom: 5px;
}
.box .box-footer { padding-top:15px; }
.box .box-footer .checkbox {
    border:1px solid #ccc;
    border-radius: 2px;
    width:70px;
    height:70px;
    position: relative;
    padding:0;
    /*bottom:15px;*/
    /*right:15px;*/
    float: right;
    /*display: inline-block;*/
    cursor: pointer;
}
.box .box-footer .checkbox i {
    font-size:70px;
    color:red;
}
</style>
<script type="text/javascript">
// $(document).on('click', '#confirm_btn_vote', function(event) {
//     event.preventDefault();
//     $( "#submit_vote_score").submit();   
// });
jQuery(document).ready(function($) {
    // $('#confirm_btn_vote').on('click', function(event) {
    //     event.preventDefault();
    //     // document.getElementById("submit_vote_score").submit();
    // });


    // $('#confirmmodal').click(function(event) {
    //     console.log('click');
    //     // $('#confirmvote').modal('hide');
    //     // console.log($('form#submit_vote_score'));
    //     document.getElementById("submit_vote_score").submit();
    //     // $('#submit_vote_score')[0].submit();
    // });
    $('#submit').click(function(event) {
        var html = '';
        $('#confirmbody').html(html);
        if ($('.checkvoteno').val()==1) {
            html += '<tr>';
            html += '<td><span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i></span></td>';
            html += '<td colspan="2">ไม่ออกเสียง</td>';
            html += '</tr>';
        } else {
            $('.checkvote').each(function(index, el) {
                // console.log(el.value);
                var data = el.value;
                var result = data.split(',');
                var i = 1;
                $.each(result, function(index, val) {
                    var name = $('.nameid'+val).html();
                    var candidateno = $('.candidateno'+val).html();
                    var img = $('.imgid'+val).attr('src');
                    if (typeof name != 'undefined') {
                        html += '<tr>';
                        html += '<td><span class="text-success"><i class="fas fa-check"></i></span></td>';
                        html += '<td class="text-center">'+candidateno+'</td>';
                        html += '<td>'+name+'</td>';
                        html += '</tr>';
                        i++;
                    }
                });
            });
        }
        $('#confirmbody').html(html);
        $('#confirmvote').modal('show');
    });
    $('.checkbox').click(function(event) {
        var status = $(this).hasClass('ischecked');
        var nocheck = $(this).hasClass('nocheck');
        var id = $(this).data('id');
        var max = $(this).data('max');
        var count = $('.checkbox.ischecked[data-id="'+id+'"]').length;
        if (nocheck) {
            $('.checkbox').removeClass('ischecked');
            $('.checkbox').html('');
            $('.checkbox.nocheck').html('<i class="fa fa-times" aria-hidden="true"></i>');   
            $('.shownum').html('0');
            $('[name="voteno"]').val(1);
            $('.checkvote').val('');
        } else {
            $('[name="voteno"]').val(0);
            $('.checkbox.nocheck').html('');   
            if (status==false) {
                if (count<max) {
                    $(this).addClass('ischecked');
                    $(this).html('<i class="fa fa-times" aria-hidden="true"></i>');    
                    $('.num'+id).html(count+1);
                    $('[name="vote['+id+']"]').val(getId(id));
                } else {
                    toastr.error('ท่านได้เลือกครบตามจำนวนที่กำหนดแล้ว', 'ผิดพลาด');
                }
                
            } else {
                $(this).removeClass('ischecked');
                $(this).html('');
                $('.num'+id).html(count-1);
                $('[name="vote['+id+']"]').val(getId(id));
            } 
        }
    });

    function getId(id)
    {
        var arr = new Array();
        $('.checkbox.ischecked[data-id="'+id+'"]').each(function(index, el) {
            arr.push($(this).data('candidateid'));
        });
        var str = arr.join(',');
        return str;
    }
});
</script>