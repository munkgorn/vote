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
                            <div class="col-10">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">ประเภทผู้ใช้ระบบ</label>
                                    <div class="col-sm-9">
                                        <form action="<?php echo $action_change; ?>" method="post" id="member_change">
                                        <select name="member_type_id" class="form-control">
                                            <option></option>
                                            <?php foreach($types as $type) { ?>
                                            <option value="<?php echo $type->id; ?>" <?php echo $member_type_id==$type->id?'selected':''; ?>><?php echo $type->name; ?></option>
                                            <?php } ?>
                                        </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 text-right"><button type="submit" form="permissionform" class="btn btn-success">บันทึก</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php if (!empty($member_type_id)) { ?>
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo $action; ?>" id="permissionform" method="post">
                        <input type="hidden" name="member_type_id">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="10px"><input type="checkbox" id="checkall" checked></th>
                                        <th>ชื่อเมนู</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($permissions)>0) { ?>
                                        <?php foreach ($permissions as $permission) { ?>

                                        <tr>
                                            <td><input type="checkbox" name="permission_id[<?php echo $permission->id; ?>]" value="1" <?php echo (isset($permission_list[$permission->id])&&$permission_list[$permission->id]==1)?'checked':'';?> id="checkpermission<?php echo $permission->id;?>"></td>
                                            <td><label for="checkpermission<?php echo $permission->id; ?>"><?php echo $permission->name; ?></label></td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        </form>

                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- <footer class="footer text-center">
        All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
    </footer> -->
</div>

<script>
jQuery(document).ready(function($) {
    $('[name="member_type_id"]').change(function(event) {
        // window.location.href = '<?php echo $action_change; ?>'+$(this).val();
        $('#member_change').submit();
    });

    $('#checkall').click(function(event) {
        if ($(this).is(':checked')) {
            $('[type="checkbox"]').prop('checked', true);
        } else {
            $('[type="checkbox"]').prop('checked', false);
        }
    });
});
</script>