		<h2>Users</h2>
		<div class="row">
			<div class="span4 pagination-height">
				<a href="<?php echo site_url('auth/user/add'); ?>" class="btn"><?php echo lang('add'); ?></a>
			</div>
			<div class="span8">
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
					<th><?php echo lang('registered'); ?></th>
					<th style="width: 36px;"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($users as $user): ?>
				<tr>
					<td><?php echo $user->getFirstName() ?></td>
					<td><?php echo $user->getLastName() ?></td>
					<td><a href="<?php echo site_url('auth/user/edit/' . $user->getId()); ?>"><?php echo $user->getUsername() ?></a></td>
					<td><?php echo $user->getEmail() ?></td>
					<td><?php echo date_format($user->getRegistered(), 'd M Y H:i:s'); ?></td>
					<td><a href="<?php echo site_url('auth/user/delete/' . $user->getId()); ?>" title="<?php echo lang('delete'); ?>" class="btn" data-button="delete"><i class="icon-remove"></i></a></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php $this->load->view('delete-modal'); ?>