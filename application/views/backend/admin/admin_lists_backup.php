<!-- Begin Datatable -->
<div class="panel panel-flat mb-10">
	<pre>
	<?php print_r($this->session->userdata()); ?>
	</pre>
	<div class="table-responsive">
		<table class="table table-default table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th width="50" class="nosort text-center pr-10">
						<input type="checkbox" id="selected_all" class="styled">
					</th>
					<th>Email</th>
					<th>Fullname</th>
					<th width="110">Status</th>
					<th width="160">Create Date</th>
					<th>ID</th>
					<th width="100" class="nosort">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($admin_results)) { ?>
					<?php foreach ($admin_results as $row) { ?>
						<tr>
							<td class="text-center"><div><input type="checkbox" class="styled"></div></td>
							<td><div><?php echo $row['email']; ?></div></td>
							<td><div><?php echo $row['name']; ?></div></td>
							<td><div><?php echo $row['status']; ?></div></td>
							<td><div><?php echo $row['created_date']; ?></div></td>
							<td><div><?php echo $row['id']; ?></div></td>
							<td>
								<div class="text-center">
									<a href="<?php echo $row['edit']; ?>" title="Edit" class="label label-primary label-icon"><i class="icon-wrench"></i></a>
									<a href="javascript:;" title="Delete" class="label label-danger label-icon"><i class="icon-bin"></i></a>
								</div>
							</td>
						</tr>
					<?php } ?>
				<?php } else { ?>
					<tr>
						<td colspan="7" class="text-center"><div>No data available in table</div></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="datatable-footer">
	    <div class="dataTables_info">Showing <?php echo $begin_point_result; ?> to <?php echo $end_point_result; ?> of <?php echo $admin_counts; ?> entries</div>
	    <div class="dataTables_paginate">
			<select class="select-pagination-search">
				<?php for ($i = 1; $i <= $total_pages; $i++) { ?>
					<option value="<?php echo $i; ?>" <?php echo ($i == $page ? 'selected="selected"' : ''); ?>><?php echo $i; ?></option>
				<?php } ?>
			</select>
	    </div>
	</div>
</div>
<!-- End Datatable -->

<!-- Begin Footer Control Fixed -->
<div class="navbar navbar-default navbar-fixed-bottom">
	<div class="navbar-collapse no-border-top" id="navbar-second">
		<div class="text-center mt-10 mb-10">
			<a href="<?php echo $btn_add; ?>" id="btn_submit_form" class="btn btn-success"><i class="icon-plus3 position-left"></i> <span>New</span></a>
			<a href="javascript:;" id="btn_delete" class="btn btn-danger"><i class="icon-bin position-left"></i> <span>Delete</span></a>
			<a href="javascript:;" id="btn_cancel" class="btn bg-grey-400"><i class="icon-cross2 position-left"></i> <span>Cancel</span></a>
		</div>
	</div>
</div>
<!-- End Footer Control Fixed -->

<script>
	$(document).ready(function() {
		$('.select-pagination-search').on('select2:selecting', function(e) {
		    console.log('Selecting: ' , e.params.args.data.element.value);

		    var page = e.params.args.data.element.value;
		    location = '<?php echo $backend_url; ?>admin/admin/lists?page=' + page;
		});
	});
</script>