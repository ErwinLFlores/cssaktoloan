<?php
    $cakeDescription = 'Online Balibago Portal';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <meta name="csrf_token" content="<?=$this->request->getParam('_csrfToken');?>">

    <link rel="stylesheet" type="text/css" href="/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" type="text/css" href="/vendors/google-code-prettify/bin/prettify.min.css">
    <link rel="stylesheet" type="text/css" href="/vendors/animate.css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/build/css/custom.min.css">

    <!-- jQuery -->
    <script src="/vendors/jquery/dist/jquery.min.js"></script>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php if (!empty($this->request->session()->read('Auth.User'))) { ?>
                <?php if ($this->request->params['action'] != "prints") { ?>
                    <?php echo $this->element('sidebar'); ?>
                    <?php echo $this->element('top_bar'); ?>
            <?php }else { ?>
                <?php echo $this->element('sidebar_back'); ?>
            <?php }} ?>

            <?php echo $this->element('content'); ?>

            <?php if (!empty($this->request->session()->read('Auth.User'))) { ?>
                <?php if ($this->request->params['action'] != "prints") { ?>
                    <?php echo $this->element('footer'); ?>
            <?php }} ?>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/vendors/nprogress/nprogress.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <!-- Chart.js -->
    <script src="/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="/vendors/Flot/jquery.flot.js"></script>
    <script src="/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="/vendors/Flot/jquery.flot.time.js"></script>
    <script src="/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="/vendors/moment/min/moment.min.js"></script>
    <script src="/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/build/js/custom.min.js"></script>
</body>
</html>
