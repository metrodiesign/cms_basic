<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $page_title; ?></title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="<?php echo $theme_url; ?>css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $theme_url; ?>css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $theme_url; ?>css/core.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $theme_url; ?>css/components.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $theme_url; ?>css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <script type="text/javascript" src="<?php echo $theme_url; ?>js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="<?php echo $theme_url; ?>js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $theme_url; ?>js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $theme_url; ?>js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="<?php echo $theme_url; ?>js/core/app.js"></script>
    <!-- /theme JS files -->
</head>

<body class="login-container">
    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
            <!-- Main content -->
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="content">
                    <?php echo $content; ?>
                </div>
                <!-- /content area -->
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
    </div>
    <!-- /page container -->
</body>

</html>