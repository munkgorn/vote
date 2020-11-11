<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<?php  
    $resultUser = json_decode(base64_decode($_SESSION['token']));
    $nameUser = $resultUser->prefix_name." ".$resultUser->firstname." ".$resultUser->lastname;
?>
<!-- TEST -->
<div id="main-wrapper">
<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="#">
                <!-- Logo icon -->
                <b class="logo-icon p-l-10">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <!-- <img src="assets/theme/assets/images/logo-icon.png" alt="homepage" class="light-logo" /> -->

                </b>
                <!--End Logo icon -->
                 <!-- Logo text -->
                <span class="logo-text">
                    Vote
                    <i class="ti-alarm-clock"></i> <i class="timelogout"></i>
                     <!-- dark Logo text -->
                     <!-- <img src="assets/theme/assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                </span>
                <!-- Logo icon -->
                <!-- <b class="logo-icon"> -->
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <!-- <img src="assets/theme/assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                <!-- </b> -->
                <!--End Logo icon -->
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                <!-- ============================================================== -->
                <!-- create new -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <!-- <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                    <form class="app-search position-absolute">
                        <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                    </form>
                </li> -->
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
                    </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li> -->
                <li class="nav-item"><a href="" class="nav-link"><i class="ti-user"></i> <?php echo $nameUser; ?> <i class="ti-alarm-clock"></i> <i class="timelogout"></i></a></li>
                <li class="nav-item dropdown">
                    <a href="<?php echo $base_url; ?>member/logout" class="nav-link"><i class="ti-lock"></i> Logout</a>
                    <!-- <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $base_url; ?>assets/theme/lib/assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo $base_url; ?>member/logout"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                        <div class="dropdown-divider"></div>
                        <div class="p-l-30 p-10"><a href="#" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
                    </div> -->
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url; ?>home" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">หน้าหลัก</span></a></li> -->
                <?php if (in_array('S01_NEWS', $_SESSION['permission'])) {?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url; ?>news" aria-expanded="false"><i class="fa fa-newspaper"></i><span class="hide-menu">จัดการข่าวสาร</span></a></li>
                <?php }?>
                <?php if (in_array('S02_USER', $_SESSION['permission'])) {?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url; ?>member/all" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">จัดการสมาชิก</span></a></li>
                <?php }?>
                <?php if (in_array('S03_CREATE_CONTEST', $_SESSION['permission'])) {?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url; ?>recruiting/add" aria-expanded="false"><i class="fa fa-list"></i><span class="hide-menu">สร้างวาระสรรหา</span></a></li>
                <?php }?>
                <?php if (in_array('S04_MANAGE_CONTEST', $_SESSION['permission'])) {?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url; ?>recruiting" aria-expanded="false"><i class="fa fa-list"></i><span class="hide-menu">จัดการวาระการสรรหา</span></a></li>
                <?php }?>
                <?php if (in_array('S05_CANDIDATE', $_SESSION['permission'])) {?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url; ?>Candidate/all" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">ข้อมูลผู้สมัคร</span></a></li>
                <?php }?>
                <?php if (in_array('S06_CHECK_CONTEST_RESULT', $_SESSION['permission'])) {?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url; ?>Candidate/result" aria-expanded="false"><i class="fa fa-check-square"></i><span class="hide-menu">ตรวจสอบผลการสรรหา</span></a></li>
                <?php }?>
                <?php if (in_array('S07_MANAGE_CONTEST_RESULT', $_SESSION['permission'])) {?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url; ?>Candidate/manageoutcome" aria-expanded="false"><i class="fa fa-certificate"></i><span class="hide-menu">จัดการผลการสรรหา</span></a></li>
                <?php }?>
                <?php if (in_array('S08_VOTE', $_SESSION['permission'])) {?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url; ?>Candidate/vote" aria-expanded="false"><i class="fa fa-hand-pointer"></i><span class="hide-menu">ลงคะแนน</span></a></li>
                <?php }?>
                <?php if (in_array('S09_CHANGE_PASSWORD', $_SESSION['permission'])) {?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url; ?>member/password" aria-expanded="false"><i class="fa fa-unlock-alt"></i><span class="hide-menu">เปลี่ยนรหัสผ่าน</span></a></li>
                <?php }?>
                <?php if (in_array('S13_REPORT', $_SESSION['permission'])) {?>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">รายงาน</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <?php if (in_array('S14_REPORT', $_SESSION['permission'])) {?>
                        <li class="sidebar-item"><a href="<?php echo $base_url; ?>report" class="sidebar-link"><i class="mdi mdi-receipt"></i><span class="hide-menu">แยกตามวาระ</span></a></li>
                        <?php }?>
                        <?php if (in_array('S15_REPORT', $_SESSION['permission'])) {?>
                        <li class="sidebar-item"><a href="<?php echo $base_url; ?>report/date" class="sidebar-link"><i class="mdi mdi-receipt"></i><span class="hide-menu">ผู้มาลงคะแนนตามวันที่</span></a></li>
                        <?php }?>
                        <li class="sidebar-item"><a href="<?php echo $base_url; ?>report/type" class="sidebar-link"><i class="mdi mdi-receipt"></i><span class="hide-menu">ผู้มาลงคะแนนตามประเภท</span></a></li>
                        <li class="sidebar-item"><a href="<?php echo $base_url; ?>report/time" class="sidebar-link"><i class="mdi mdi-receipt"></i><span class="hide-menu">ผู้มาลงคะแนนตามเวลา</span></a></li>
                    </ul>
                </li>
                <?php }?>
                <?php if (in_array('S10_ROLE', $_SESSION['permission'])) {?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url; ?>member/type" aria-expanded="false"><i class="fa fa-graduation-cap"></i><span class="hide-menu">ตั้งค่าประเภทผู้ใช้ระบบ</span></a></li>
                <?php }?>
                <?php if (in_array('S11_ROLE_PERMISSION', $_SESSION['permission'])) {?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url; ?>permission" aria-expanded="false"><i class="fa fa-lock"></i><span class="hide-menu">ตั้งค่าสิทธิ์การใช้งาน</span></a></li>
                <?php }?>
                <?php if (in_array('S12_DOMAIN_CONTEXT', $_SESSION['permission'])) {?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $base_url; ?>setting" aria-expanded="false"><!-- <i class="mdi mdi-border-inside"></i> --> <i class="fa fa-cog"></i><span class="hide-menu">ตั้งค่าระบบ</span></a></li>
                <?php }?>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
