<?php defined('BASEPATH') or exit('No direct script access allowed');?>




    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <script>
    $(document).ready(function () {

        var htmltime = $('.timelogout');

        <?php if (isset($_SESSION['expire_date'])): ?>
        var tid = setTimeout(loadTimeout, 1000);
        function loadTimeout() {
            $.get("<?php echo base_url('member/checkTimeout'); ?>", {},
                function (data, textStatus, jqXHR) {
                    console.log(data);
                    htmltime.html(data.now);
                    tid = setTimeout(loadTimeout, 1000);
                    if (data.timeout==true) {
                        // alert('Logout ?');
                        window.location.href = "<?php echo base_url('member/logout'); ?>";
                    }
                },
                "json"
            );
        }
        <?php endif;?>


    });
    </script>

</body>

</html>