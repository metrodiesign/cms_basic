<!-- Begin Datatable -->
<div class="panel panel-flat mb-10">
	<div class="panel-body">
		<?php echo form_open($backend_url . 'admin/admin/add', array('id' => 'form_main')); ?>
			<div class="tabbable">
				<ul class="nav nav-tabs nav-tabs-highlight">
					<li class="active"><a href="#language-general" data-toggle="tab"><i class="icon-cog52 position-left"></i> General</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="language-general">
                        <div class="row">
                            <div class="col-md-12">
                                <legend class="text-primary-800 text-bold">General</legend>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="display-block"><span class="text-bold text-danger mr-5">*</span>Groups</label>
                                    <select id="group_id" name="group_id" class="select">
                                        <?php if (!empty($groups)) { ?>
                                            <?php foreach ($groups as $row) { ?>
                                                <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="display-block"><span class="text-bold text-danger mr-5">*</span>First Name</label>
                                    <input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>" placeholder="" autocomplete="off" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="display-block"><span class="text-bold text-danger mr-5">*</span>Last Name</label>
                                    <input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>" placeholder="" autocomplete="off" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="display-block"><span class="text-bold text-danger mr-5">*</span>Email</label>
                                    <input type="text" id="email" name="email" value="<?php echo $email; ?>" placeholder="" autocomplete="off" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="display-block">Phone</label>
                                    <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" placeholder="" autocomplete="off" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="display-block"><span class="text-bold text-danger mr-5">*</span>Password</label>
                                    <input type="password" id="password" name="password" value="" placeholder="" autocomplete="off" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="display-block"><span class="text-bold text-danger mr-5">*</span>Confirm Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password" value="" placeholder="" autocomplete="off" class="form-control">
                                </div>
                            </div>
                        </div>
                   	</div>
                </div>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>
<!-- End Datatable -->

<!-- Begin Footer Control Fixed -->
<div class="navbar navbar-default navbar-fixed-bottom">
	<div class="navbar-collapse no-border-top" id="navbar-second">
		<div class="text-center mt-10 mb-10">
			<a href="javascript:;" id="btn_submit_form" class="btn btn-success"><i class="icon-checkmark4 position-left"></i> <span>Save</span></a>
			<a href="<?php echo $btn_cancel; ?>" id="btn_cancel" class="btn bg-grey-400"><i class="icon-cross2 position-left"></i> <span>Cancel</span></a>
		</div>
	</div>
</div>
<!-- End Footer Control Fixed -->

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo $theme_url; ?>js/plugins/notifications/sweet_alert.min.js"></script>
<!-- /theme JS files -->

<script>
	$(document).ready(function() {
		<?php if (!empty($message)) { ?>
            var message_title = '<?php echo $message_title; ?>';
            var message_type = '<?php echo $message_type; ?>';
            var message = '<?php echo $message; ?>';
            message = message.substring(1, (message.length - 1));

            swal({
                title: message_title,
                text: message,
                confirmButtonColor: "#1E88E5",
                type: message_type,
                html: true,
            });
        <?php } ?>
	});

    $(document).on("click", "#btn_submit_form",function() {
        $('#form_main').submit();
    });
</script>