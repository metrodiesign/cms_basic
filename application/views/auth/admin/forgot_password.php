<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Password recovery -->
<form action="javascript:;">
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
            <h5 class="content-group">Password recovery <small class="display-block">We'll send you instructions in email</small></h5>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <input type="email" class="form-control input-lg" placeholder="Your email">
            <div class="form-control-feedback">
                <i class="icon-mail5 text-muted"></i>
            </div>
        </div>

        <button type="submit" class="btn bg-blue btn-lg btn-block">Reset password</button>
        <a href="<?php echo $cancel; ?>" class="btn bg-grey-300 btn-lg btn-block">Cancel</a>
    </div>
</form>
<!-- /password recovery -->