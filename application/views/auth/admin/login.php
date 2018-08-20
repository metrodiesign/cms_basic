<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo form_open(base_url('backend/admin/auth/login')); ?>
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
            <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
        </div>
        <div class="form-group has-feedback has-feedback-left">
            <input type="text" id="identity" name="identity" value="<?php echo $identity; ?>" class="form-control input-lg" placeholder="<?php echo $login_identity_label; ?>">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>
        <div class="form-group has-feedback has-feedback-left">
            <input type="password" id="password" name="password" class="form-control input-lg" placeholder="<?php echo $login_password_label; ?>">
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>
        <div class="form-group has-feedback has-feedback-left">
            <label class="checkbox-inline">
                <input type="checkbox" id="remember" name="remember" value="1" class="styled" <?php echo ($remember == 1 ? 'checked="checked"' : ''); ?>>
                <?php echo $login_remember_label; ?>
            </label>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block"><?php echo $login_submit_btn; ?></button>
        </div>
        <div class="text-center">
            <a href="<?php echo base_url('backend/admin/auth/forgot_password'); ?>"><?php echo $login_forgot_password; ?></a>
        </div>
    </div>
<?php echo form_close(); ?>

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo $theme_url; ?>js/plugins/forms/styling/uniform.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>js/plugins/notifications/sweet_alert.min.js"></script>
<!-- /theme JS files -->

<script>
    $(document).ready(function() {
        // Style checkboxes and radios
        $('.styled').uniform();

        <?php if (!empty($message)) { ?>
            var message = '<?php echo $message; ?>';
            message = message.substring(1, (message.length - 1));

            swal({
                title: "Oops...",
                text: message,
                confirmButtonColor: "#EF5350",
                type: "error",
                html: true,
            });
        <?php } ?>
    });
</script>