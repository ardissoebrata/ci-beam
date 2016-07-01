
<?php if (isset($form)) $role = $form->get_default(); ?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			<?php echo lang('role_page_name') ?>
			<?php if($acl->is_allowed('acl/role/add')): ?>
			<a href="<?php echo site_url('acl/role/add') ?>" class="btn btn-primary pull-right" title="<?php echo lang('role_add_title'); ?>">
				<i class="fa fa-plus"></i> <?php echo lang('add'); ?>
			</a>
			<?php endif; ?>
		</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<?php echo messages(); ?>
<div class="row">
	<div class="col-md-5">
		<section class="panel panel-default">
			<div class="panel-body">
				<?php
				function display_tree($tree, $acl, $curr_id = 0)
				{
					foreach($tree as $node) {
						if ($curr_id == $node['id'])
							echo '<li class="active"><strong>';
						else
							echo '<li>';
						echo '<i class="fa-li fa fa-user"></i>';
						if($acl->is_allowed('acl/role/edit')) {
							echo '<a href="' . site_url('acl/role/edit/' . $node['id']) . '" class="users">';
							echo '<span>' . $node['name'] . '</span>';
							echo '</a>';
						} else {
							echo '<span>' . $node['name'] . '</span>';
						}
						if (isset($node['children'])) {
							echo '<ul class="fa-ul">';
							display_tree($node['children'], $acl);
							echo '</ul>';
						}
						if ($curr_id == $node['id'])
							echo '</strong>';
						echo '</li>';
					}
				}
				?>
				<ul class="fa-ul">
					<?php display_tree($role_tree, $acl, (isset($role->id) ? $role->id : 0)); ?>
				</ul>
			</div>
		</section>
	</div>
	<?php if (isset($form)): ?>
	<div class="col-md-7">
		<?php echo form_open_multipart(uri_string(), array('class' => 'form-horizontal form-bordered', 'id' => 'role-form', 'name' => 'role-form')); ?>
			<section class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title"><?php echo lang('role_page_name') ?></h2>
				</div>
				<div class="panel-body">
					<?php echo $form->fields(array('id', 'name')) ?>
					<?php 
					function generate_options($tree, $sep = '')
					{
						$result = array();
						foreach($tree as $node)
						{
							$result[$node['id']] = $sep . $node['name'];
							if (isset($node['children']))
								$result = $result + generate_options($node['children'], $sep . '&nbsp;&nbsp;');
						}
						return $result;
					}
					$parents = array(0 => '(' . lang('none') . ')') + generate_options($role_tree);
					if (isset($role->id) && isset($parents[$role->id]))
						unset($parents[$role->id]);

					$isLabelEchoed = FALSE;
					if (isset($role->parents))
					{
						foreach($role->parents as $index => $parent)
						{
							echo '<div class="form-group">';
							if (! $isLabelEchoed)
							{
								echo form_label(lang('role_parents'), 'parents[' . $index . ']', array('class' => 'col-lg-4 control-label'));
								$isLabelEchoed = TRUE;
							}
							else
								echo form_label('', 'parents[' . $index . ']', array('class' => 'col-lg-4 control-label'));
							echo '<div class="col-lg-8">'; 
							echo form_dropdown('parents[' . $index . ']', 
								$parents,
								set_value('parents[' . $index . ']', $parent->parent),
								'class="form-control"'
							);
							echo '</div></div>';
						}
					}
					echo '<div class="form-group">';
					if (! $isLabelEchoed)
					{
						echo form_label(lang('role_parents'), 'parents[]', array('class' => 'col-lg-4 control-label'));
						$isLabelEchoed = TRUE;
					}
					else
						echo form_label('', 'parents[]', array('class' => 'col-lg-4 control-label'));
					echo '<div class="col-lg-8">';
					echo form_dropdown('parents[]', $parents, 0, 'class="form-control"');
					echo '</div></div>';
					?>
				</div>
				<div class="panel-footer">
					<?php
					if($acl->is_allowed('acl/role/edit')) {
						echo form_button(array(
							'type' => 'submit',
							'name' => 'save-btn',
							'value' => 'save',
							'content' => '<i class="fa fa-check"></i> ' . lang('save'),
							'class' => 'btn btn-primary'
						));
					}
					?>
					<?php
					if (isset($role->id) && $acl->is_allowed('acl/role/delete')) {
						$delete_url = site_url('acl/role/delete/' . $role->id);
						echo form_confirmwindow('delete-confirm', '<i class="fa fa-trash-o"></i> ' . lang('delete'), lang('delete'), lang('role_delete_confirm'), $delete_url, 'btn btn-danger pull-right', 'btn btn-danger');
					}
					?>
					<a href="<?php echo site_url('acl/role'); ?>" class="btn btn-default">
						<i class="fa fa-repeat"></i>
						<?php echo lang('cancel') ?>
					</a>
				</div>
			</section>
		<?php echo form_close(); ?>
	</div>
	<?php endif; ?>
</div>
