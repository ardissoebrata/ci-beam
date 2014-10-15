<?php if (!$isAjax): ?>
<h1>
	<?php echo lang('role_page_name'); ?>
	<?php if($acl->is_allowed('acl/role/add')){ ?>
	<a href="<?php echo site_url('acl/role/add') ?>?redirect=<?php echo urlencode(current_url_params()); ?>" class="btn" title="<?php echo lang('role_add_title'); ?>">
		<i class="icon-plus"></i>
	</a>
	<?php } ?>
</h1>
<?php echo messages(); ?>
<div class="row">
	<div class="col-md-6">
		<?php
			function display_tree($tree, $acl)
			{
				foreach($tree as $node)
				{
					echo '<li>';
					if (isset($node['children']))
						echo '<span class="toggle"></span>';
						if($acl->is_allowed('acl/role/edit')){
							echo '<a href="' . site_url('acl/role/edit') . '/' . $node['id'] . '?redirect=' . urlencode(current_url_params()) . '" class="users">';
							echo '<span>' . $node['name'] . '</span>';
							echo '</a>';
						}else{
							echo '<span>' . $node['name'] . '</span>';
						}
					if (isset($node['children']))
					{
						echo '<ul>';
						display_tree($node['children'], $acl);
						echo '</ul>';
					}
					echo '</li>';
				}
			}
		?>
		<ul class="arbo">
			<?php display_tree($role_tree, $acl); ?>
		</ul>
	</div>
	
	<!-- Right column -->
	<div class="col-md-6">
<?php endif; ?>
		<?php echo form_open_multipart(uri_string(), array('class' => 'form-horizontal', 'id' => 'role-form', 'name' => 'role-form')); ?>
			<?php if (validation_errors()): ?>
			<ul class="message error no-margin">
				<?php echo validation_errors(); ?>
			</ul>
			<?php endif; ?>
			<?php 
			echo form_hidden(array('id' => set_value('id', isset($role->id) ? $role->id : '')));
			if (isset($redirect))
				echo form_hidden(array('redirect' => $redirect));
			?>
			<fieldset>
				<legend><?php echo lang('role_page_name'); ?></legend>
				<div class="form-group">
					<?php echo form_label(lang('role_name'), 'name', array('class' => 'col-sm-2 control-label required')); ?>
					<div class="col-sm-10">
						<?php echo form_input(array(
							'name'		=> 'name',
							'id'		=> 'name',
							'value'		=> set_value('name', isset($role->name) ? $role->name : ''),
							'maxlength'	=> '255',
							'class'		=> 'form-control' . (form_error('name') ? ' error' : '')
						)); ?>
					</div>
				</div>
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
							echo form_label(lang('role_parents'), 'parents[' . $index . ']', array('class' => 'col-sm-2 control-label'));
							$isLabelEchoed = TRUE;
						}
						else
							echo form_label('', 'parents[' . $index . ']', array('class' => 'col-sm-2 control-label'));
						echo '<div class="col-sm-10">'; 
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
					echo form_label(lang('role_parents'), 'parents[]', array('class' => 'col-sm-2 control-label'));
					$isLabelEchoed = TRUE;
				}
				else
					echo form_label('', 'parents[]', array('class' => 'col-sm-2 control-label'));
				echo '<div class="col-sm-10">';
				echo form_dropdown('parents[]', $parents, 0, 'class="form-control"');
				echo '</div></div>';
				?>
			</fieldset>
			<?php if (!$isAjax): ?>
			<div class="form-actions">
				<?php
				if($acl->is_allowed('acl/role/edit'))
				{
					echo form_button(array(
						'type' => 'submit',
						'name' => 'save-btn',
						'value' => 'save',
						'content' => lang('save'),
						'class' => 'btn btn-primary'
					));
				}
				?>
				<?php
				if (isset($role->id) && $acl->is_allowed('acl/role/delete'))
				{
					$delete_url = site_url('acl/role/delete/' . $role->id) . '?redirect=' . urlencode($redirect);
					echo form_confirmwindow('delete-confirm', lang('delete'), lang('delete'), lang('role_delete_confirm'), $delete_url);
				}
				?>
				<a href="<?php echo site_url('acl/role'); ?>" class="btn btn-default"><?php echo lang('cancel') ?></a>
			</div>
			<?php endif; ?>
		<?php echo form_close(); ?>
<?php if (!$isAjax): ?>
	</div>
</div>
<?php endif; ?>
