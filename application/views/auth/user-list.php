		<h2>Users</h2>
		<div class="row">
			<div class="col-md-4 pagination-height">
				<a href="<?php echo site_url('auth/user/add'); ?>" class="btn btn-default"><?php echo lang('add'); ?></a>
			</div>
			<div class="col-md-8">
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th><?php echo lang('first_name'); ?></th>
					<th><?php echo lang('last_name'); ?></th>
					<th><?php echo lang('username'); ?></th>
					<th><?php echo lang('email'); ?></th>
					<th>Role</th>
					<th><?php echo lang('registered'); ?></th>
					<th style="width: 36px;"></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$this->load->model('acl/role_model');
				?>
				<?php foreach($users as $user): ?>
				<tr>
					<td><?php echo $user->first_name ?></td>
					<td><?php echo $user->last_name ?></td>
					<td><a href="<?php echo site_url('auth/user/edit/' . $user->id); ?>"><?php echo $user->username ?></a></td>
					<td><?php echo $user->email ?></td>
					<td>
						<?php
						$role = $this->role_model->get_by_id($user->role_id);
						if ($role)
							echo $role->name;
						else
							echo '-';
						?>
					</td>
					<td><?php echo date('d M Y H:i:s', strtotime($user->registered)); ?></td>
					<td><a href="<?php echo site_url('auth/user/delete/' . $user->id); ?>" title="<?php echo lang('delete'); ?>" class="btn" data-button="delete"><i class="icon-remove"></i></a></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php $this->load->view('delete-modal'); ?>