<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $base_url;?>assets/theme/lib/assets/images/favicon.png">
        <title><?php echo $heading_title; ?></title>
        <!-- Custom CSS -->
        <link href="<?php echo $base_url;?>assets/theme/lib/assets/libs/flot/css/float-chart.css?v=1001" rel="stylesheet">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?php echo $base_url;?>assets/theme/lib/dist/css/style.min.css?v=1001">
        <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>assets/theme/lib/assets/extra-libs/multicheck/multicheck.css?v=1001">
        <link rel="stylesheet" href="<?php echo $base_url;?>assets/theme/lib/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css?v=1001">
        <link rel="stylesheet" href="<?php echo $base_url;?>assets/theme/lib/dist/css/style.min.css?v=1001">
        <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>assets/theme/lib/assets/libs/jquery-minicolors/jquery.minicolors.css?v=1001">
        <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>assets/theme/lib/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css?v=1001">

        <link href="<?php echo $base_url;?>assets/theme/lib/dist/css/icons/font-awesome/css/fontawesome.min.css?v=1001" rel="stylesheet">
        <link href="<?php echo $base_url;?>assets/theme/lib/dist/css/custom.css?v=1001" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/jquery/dist/jquery.min.js?v=1001"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/popper.js/dist/umd/popper.min.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/bootstrap/dist/js/bootstrap.min.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/extra-libs/sparkline/sparkline.js?v=1001"></script>

        <!-- <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></scri?v=1001pt> -->
        <!-- <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/jquery-minicolors/jquery.minicolors.min.js"></scri?v=1001pt> -->
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js?v=1001"></script>

        <!--Wave Effects -->
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/dist/js/waves.js?v=1001"></script>
        <!--Menu sidebar -->
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/dist/js/sidebarmenu.js?v=1001"></script>
        <!--Custom JavaScript -->
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/dist/js/custom.min.js?v=1001"></script>
        <!--This page JavaScript -->
        <!-- <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/dist/js/pages/dashboards/dashboard1.js"></scri?v=1001pt> -->
        <!-- Charts js Files -->
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/flot/excanvas.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/flot/jquery.flot.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/flot/jquery.flot.pie.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/flot/jquery.flot.time.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/flot/jquery.flot.stack.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/flot/jquery.flot.crosshair.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/dist/js/pages/chart/chart-page-init.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/extra-libs/multicheck/datatable-checkbox-init.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/extra-libs/multicheck/jquery.multicheck.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/extra-libs/DataTables/datatables.min.js?v=1001"></script>

        <!-- this page js -->
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/chart/matrix.interface.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/chart/jquery.peity.min.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/chart/matrix.charts.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/chart/jquery.flot.pie.min.js?v=1001"></script>
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/chart/turning-series.js?v=1001"></script>

        <link rel="stylesheet" href="<?php echo $base_url;?>assets/theme/lib/assets/libs/toastr/build/toastr.min.css?v=1001">
        <script type="text/javascript" src="<?php echo $base_url;?>assets/theme/lib/assets/libs/toastr/toastr.js?v=1001"></script>

        <link href="<?php echo $base_url;?>assets/select2/select2.min.css?v=1001" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo $base_url;?>assets/select2/select2.min.js?v=1001"></script>


        <link rel="stylesheet" href="<?php echo $base_url;?>assets/icheck-1.x/skins/all.css?v=1001">
        <script type="text/javascript" src="<?php echo $base_url;?>assets/icheck-1.x/icheck.js?v=1001"></script>


        <!-- Keepalive -->
        <script type="text/javascript" src="<?php echo $base_url;?>/assets/keepalive.js"></script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-59803072-12"></script> -->
        <!-- <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-59803072-12');
        </script> -->


        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-640S6RHC2Q"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-640S6RHC2Q');
        </script>


    </head>

    <body>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div> -->