<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			<?php echo lang('users') ?>
			<a href="<?php echo site_url('auth/user/add') ?>" class="btn btn-primary pull-right">
				<i class="fa fa-plus"></i> <?php echo lang('add') ?>
			</a>
		</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<table id="dataTable_user" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th><?php echo lang('first_name'); ?></th>
			<th><?php echo lang('last_name'); ?></th>
			<th><?php echo lang('username'); ?></th>
			<th><?php echo lang('email'); ?></th>
			<th>Role</th>
			<th><?php echo lang('registered'); ?></th>
			<th style="width: 15px;"></th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
<?php $this->load->view('delete-modal'); ?>

<script>
var the_table;

$(window).load(function() {
	the_table = $("#dataTable_user").DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "stateDuration": 0,
            "ajax": {
                "url": "<?php echo site_url('api/user/index'); ?>",
                "type": "POST"
            },
			"columns": [
				{ "data": "first_name" },
				{ "data": "last_name" },
				{ 
					"data": "username",
					"render": function(data, type, row, meta) {
						return '<a href="<?php echo site_url('auth/user/edit/') ?>/' + row.id + '">' + data + '</a>';
					}
				},
				{ "data": "email" },
				{ "data": "role" },
				{ "data": "registered" },
				{ 
					"data": "action",
					"orderable": false,
					"render": function(data, type, row, meta) {
						return '<a href="<?php echo site_url('auth/user/delete/') ?>/' + row.id + '" title="Delete" data-button="delete"><i class="fa fa-trash"></i></a>';
					}
				}
			]
        });

});
</script>